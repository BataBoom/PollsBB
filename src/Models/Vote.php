<?php

namespace BataBoom\PollsBB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use BataBoom\PollsBB\Models\Choice;
use BataBoom\PollsBB\Models\Poll;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'poll_results';

    protected $fillable = ['*'];

    protected $casts = [];

    public $timestamps = false;

    public function user()
    {
        $userModel = Config::get('pollsbb.user_model');
        return $this->belongsToMany($userModel, 'user_id');
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class, 'poll_id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class, 'poll_option_id');
    }

    public function scopeMostForPoll($query, $pollId)
    {
        return $query->where('poll_id', $pollId)
            ->select('selection', DB::raw('count(*) as total'))
            ->groupBy('selection')
            ->orderByDesc('total');
    }

}
