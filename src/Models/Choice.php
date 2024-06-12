<?php

namespace BataBoom\PollsBB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BataBoom\PollsBB\Models\Poll;

class Choice extends Model
{
    use HasFactory;

    protected $table = 'poll_options';

    protected $fillable = ['poll_id', 'option_text'];

    protected $casts = [];

    public $timestamps = false;

    public function poll()
    {
        return $this->belongsTo(Poll::class, 'poll_id');
    }

    public function choices()
    {
        return $this->hasMany(Poll::class, 'option_text', 'question');
    }


}
