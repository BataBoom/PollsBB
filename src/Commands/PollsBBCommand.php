<?php

namespace BataBoom\PollsBB\Commands;

use Illuminate\Console\Command;

class PollsBBCommand extends Command
{
    public $signature = 'pollsbb';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
