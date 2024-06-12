<?php

namespace BataBoom\PollsBB\Traits;

use BataBoom\PollsBB\Models\Vote;
use BataBoom\PollsBB\Models\Poll;

trait HasPolls
{
    // Relationship With Polls
    public function polls() {
        return $this->hasMany(Poll::class, 'owner_id');
    }

    // Relationship With Votes
    public function votes() {
        return $this->hasMany(Vote::class, 'user_id');
    }
}
