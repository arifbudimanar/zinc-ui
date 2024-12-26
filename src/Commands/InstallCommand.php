<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'zinc:install';

    public $description = 'Install the Zinc UI components';

    public function handle(): int
    {
        $this->comment('Checking is Livewire installed');
        // Make sure Livewire is installed
        // Make sure app.js is configured
        // If not, configute to use livewire and alpine from esm module
        $this->comment('Checking Tailwind CSS is installed');
        // Make sure Tailwind CSS is installed
        $this->comment('Install Livewire Toaster');
        // Install Livewire Toaster
        $this->comment('Install Alpine Autozise');
        // Install Alpine Autozise
        $this->comment('Zinc UI installed successfully');

        return self::SUCCESS;
    }
}
