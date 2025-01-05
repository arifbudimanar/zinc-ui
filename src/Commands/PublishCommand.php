<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PublishCommand extends Command
{
    public $signature = 'zinc:publish';

    public $description = 'Publish the Zinc UI components';

    public function handle(): int
    {
        $this->comment('Publishing Zinc UI components ...');
        (new Filesystem)->ensureDirectoryExists(resource_path('views/components'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../resources/views/components', resource_path('views/components'));
        $this->info('Zinc UI components published successfully.');
        $this->line('Navigate to the following directory to view the components:');
        $this->line('<info>'.resource_path('views/components').'</info>'); // Highlighted clickable path

        return self::SUCCESS;
    }
}
