<?php

namespace ArifBudimanAr\ZincUi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ArifBudimanAr\ZincUi\Commands\ZincUiCommand;

class ZincUiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('zinc-ui')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_zinc_ui_table')
            ->hasCommand(ZincUiCommand::class);
    }
}
