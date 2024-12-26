<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'zinc:install';

    public $description = 'Install the Zinc UI component.';

    public function handle(): int
    {
        $this->comment('Install Zinc UI...');
        $this->comment('Install Livewire');
        $this->comment('Install Livewire Toaster');
        $this->comment('Install Alpine Autozise');

        return self::SUCCESS;
    }
}
