<?php

namespace BataBoom\PollsBB\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BataBoom\PollsBB\PollsBB
 */
class PollsBB extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \BataBoom\PollsBB\PollsBB::class;
    }
}
