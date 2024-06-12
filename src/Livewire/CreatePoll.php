<?php

namespace BataBoom\PollsBB\Livewire;

use BataBoom\PollsBB\Models\Choice;
use BataBoom\PollsBB\Models\Poll;
use BataBoom\PollsBB\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class CreatePoll extends Component
{
    public $user;
    private $pid = '';
    public bool $created = false;
    public $expires = '1 Hour';
    public $question = '';
    public $ends;
    public $choices = ['',''];
    public $poll;
    public $rules = [
        'choices' => 'required|array',
        'question' => 'required|string',
        'expires' => 'required|string',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->ends = $this->setExpires();
    }

    public function addChoice()
    {
        $this->choices[] = '';
    }

    public function resetChoice()
    {
        $this->choices = ['',''];
    }

    public function setExpires()
    {

        for ($i = 2; $i <= 48; $i++) {
            $ends[] = $i .  ' Hours';
        }
        array_unshift($ends, '1 Hour');

        return $ends;

    }

    public function submit()
    {
        $this->validate();
        $p = new Poll;
        $p->question = $this->question;
        $p->status = 1;
        $p->owner_id = $this->user->id;
        $p->expires_at = date('Y-m-d H:i:s', strtotime("+ $this->expires"));


        if ($p->save()) {
            $this->pid = $p->id;
            foreach ($this->choices as $c) {
                Choice::Create([
                    'poll_id' => $p->id,
                    'option_text' => $c,
                ]);
            }
        } else {
            //cant create poll
            session()->flash('createpollerror', 'ERROR!');
        }

        $locate = Poll::Find($p->id);
        if ($locate->choices->count() >= 2){
            session()->flash('success', 'Successfully created poll!');
            $this->created = true;
            $this->poll = $locate;
            $this->emit('pollCreated', ['poll' => $this->poll]);

        } else {
            $this->created = false;
            session()->flash('choiceserror', 'No Choices Found!! Deleting Poll.. ');
            // we could potentially recover the poll from here, or we could just delete said poll and start over TBD
        }
    }

    public function render()
    {
        return view('livewire.pollsbb.create-poll');
    }
}
