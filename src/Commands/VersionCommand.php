<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;

class VersionCommand extends Command
{
    public $signature = 'zinc:version';

    public $description = 'Show the Zinc UI version';

    public function handle(): int
    {
        $this->comment('Zinc UI v0.1-alpha.79');

        return self::SUCCESS;
    }
}
