<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'zinc:version')]
class VersionCommand extends Command
{
    public $signature = 'zinc:version';

    public $description = 'Show the Zinc UI version';

    public function handle(): int
    {
        $this->comment('Zinc UI v0.1-alpha.91');

        return self::SUCCESS;
    }
}
