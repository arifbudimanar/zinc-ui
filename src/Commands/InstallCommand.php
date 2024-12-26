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
            - Add avatar url and first name attribute to the User model
                - getAvatarUrlAttribute()
                - getFirstNameAttribute()
            - Add app.css configuration
                - scrollbar settings
                - grid settings
                - etc.

        Publish the assets
            - Publish all files from the `view` directory
                - components
                - layouts
            - Publish all files from the `css` directory

        */

        $this->comment('Zinc UI is installed! Make something awesome!');

        return self::SUCCESS;
    }
}
