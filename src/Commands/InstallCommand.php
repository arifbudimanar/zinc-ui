<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'zinc:install';

    public $description = 'Install the Zinc UI components';

    public function handle(): int
    {
        $this->comment('Installing Zinc UI ...');

        /*
        Install the Composer dependencies
            - Install Livewire 3.x
            - Install Livewire Toaster

        Install the NPM dependencies
            - Install Tailwind CSS
            - Install Autosize (Alpine JS plugin)

        Configure
            - Make sure app.js is use Livewire and Alpine JS from ESM Module
            - Make sure livewire-toaster.js is imported
            - Make sure alpine-autosize.js is imported

        Publish the assets
            - Publish all files from the `view` directory
                - components
                - layouts
            - Publish all files from the `css` directory
                - app.css - scrollbar settings, etc
        */

        $this->comment('Zinc UI is installed! Make something awesome!');

        return self::SUCCESS;
    }
}
