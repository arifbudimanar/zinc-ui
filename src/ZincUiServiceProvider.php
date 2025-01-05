<?php

namespace ArifBudimanAr\ZincUi;

use ArifBudimanAr\ZincUi\Commands\InstallCommand;
use ArifBudimanAr\ZincUi\Commands\PublishCommand;
use ArifBudimanAr\ZincUi\Commands\VersionCommand;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ZincUiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('zinc-ui')
            // ->hasConfigFile()
            // ->hasViews()
            // ->hasMigration('create_zinc_ui_table')
            ->hasCommands([
                InstallCommand::class,
                PublishCommand::class,
                VersionCommand::class,
            ]);

        $this->bootComponentPath();
    }

    public function bootComponentPath()
    {
        if (file_exists(resource_path('views'))) {
            Blade::anonymousComponentPath(resource_path('views'));
        }

        Blade::anonymousComponentPath(__DIR__.'/../resources/views/components');
    }
}
