<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;

class ZincUiCommand extends Command
{
    public $signature = 'zinc-ui';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
