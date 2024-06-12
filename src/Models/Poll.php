<?php

namespace BataBoom\PollsBB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BataBoom\PollsBB\Models\Vote;
use Illuminate\Support\Facades\Config;
use BataBoom\PollsBB\Models\Choice;

class Poll extends Model
{
    use HasFactory;

    protected $table = 'polls';

    protected $fillable = ['owner_id', 'question', 'status', 'created_at', 'expires_at'];

    protected $casts = [];

    public $timestamps = false;

    public function creator()
    {
        $userModel = Config::get('pollsbb.user_model');
        return $this->belongsTo($userModel, 'owner_id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class, 'poll_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'poll_id');
    }

    public function getMostVotedChoice()
    {
        $votes = $this->votes()->mostForPoll($this->id)->get();
        return array($votes->first()->selection, $votes->second()->selection);
    }

    public function voted($id)
    {
        return $this->votes()->where('user_id', $id);
    }

    public function results()
    {

        // Assuming $pollResults and $pollChoices contain the given data
        $pollChoices = $this->choices()->get();
        $pollVotes = $this->votes()->mostForPoll($this->id)->get();

        // Map the Poll Choices to a new collection with total votes for each choice
        $combinedResults = $pollChoices->map(function ($choice) use ($pollVotes) {
            // Search for the corresponding vote in the poll votes
            $vote = $pollVotes->firstWhere('selection', $choice->option_text);

            // If the vote is found, return the vote, otherwise create a new object with total 0
            if ($vote) {
                return $vote;
            } else {
                return (object) [
                    'selection' => $choice->option_text,
                    'total' => 0,
                ];
            }
        });

        // Sort the combined results by the total votes in descending order
        $sortedResults = $combinedResults->sortByDesc('total');

        // Map the sorted results to remove unnecessary keys and reset the keys of the collection
        return $sortedResults->map(function ($result) {
            return (object) [
                'selection' => $result->selection,
                'total' => $result->total,
            ];
        })->values();

    }



    public function resultsInPercents()
    {

        $results = $this->results();

        // Calculate the total number of votes in the poll
        $totalVotes = $results->sum('total');

        // If there are no votes, return an empty collection
        if ($totalVotes == 0) {
            return collect([]);
        }

        // Calculate the percentages for each choice
        $percentages = $results->map(function ($result) use ($totalVotes) {
            return [
                'selection' => $result->selection,
                'total' => $result->total,
                'percentage' => round(($result->total / $totalVotes) * 100, 2),
            ];
        });


        return $percentages;

    }


}
