<?php

namespace BataBoom\PollsBB\Livewire;

use BataBoom\PollsBB\Models\Choice;
use BataBoom\PollsBB\Models\Poll;
use BataBoom\PollsBB\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class ViewPoll extends Component
{

    protected $listeners = ['pollCreated' => 'render'];
    public Poll $poll;
    public $pollId;
    public $user;
    public $votes;
    public $choice;
    public $rules = [
        //'choice' => 'integer|in:' . implode(',', array_column($this->poll->choices->toArray(), 'id')),
        'choice' => 'required|integer',
    ];
    public $results;

    public function mount()
    {
        $this->user = Auth::user();

        $this->votes = Vote::mostForPoll($this->poll->id)->get();

        $this->results = $this->poll->resultsInPercents();
    }

    public function submit()
    {
        $this->validate();

        $answer = $this->poll->choices->where('id',  $this->choice)->pluck('option_text')->flatten()->toArray();

        $v = new Vote;
        $v->poll_id = $this->poll->id;
        $v->poll_option_id = $this->choice;
        $v->user_id = $this->user->id;
        $v->selection = $answer[0];
        if ($v->save()) {
            session()->flash('voted', 'Vote successfully inserted.');
        } else {
            session()->flash('voteerror', 'Vote unsuccessful');
        }


    }

    public function hasVoted()
    {
        return $this->poll->voted($this->user->id)->exists();
    }

    public function render()
    {

        if($this->hasVoted()){
            sleep(1);
            $this->results = $this->poll->resultsInPercents();

            return view('pollsbb::livewire.pollsbb.voted', [
                'Question' => $this->poll->question,
                'Votes' => $this->results,
            ]);

        } else {

            return view('pollsbb::livewire.pollsbb.view-poll', [
                'Question' =>$this->poll->question,
                'Votes' => $this->votes,
                'Choices' => $this->poll->choices->toArray(),
            ]);
        }
    }
}
