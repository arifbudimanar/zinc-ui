<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'zinc:version';

    public $description = 'Show the Zinc UI version';

    public function handle(): int
    {
        $this->comment('Zinc UI v0.1-alpha.1');

        return self::SUCCESS;
    }
}