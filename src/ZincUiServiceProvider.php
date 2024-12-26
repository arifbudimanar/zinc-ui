<?php

namespace ArifBudimanAr\ZincUi;

use ArifBudimanAr\ZincUi\Commands\InstallCommand;
use ArifBudimanAr\ZincUi\Commands\VersionCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            // ->hasConfigFile()
            // ->hasViews()
            // ->hasMigration('create_zinc_ui_table')
            ->hasCommands([
                InstallCommand::class,
                VersionCommand::class,
            ]);
    }
}
