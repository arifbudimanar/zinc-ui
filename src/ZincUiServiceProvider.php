<?php

namespace ArifBudimanAr\ZincUi;

use ArifBudimanAr\ZincUi\Commands;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ZincUiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('zinc-ui')
            ->hasCommands([
                Commands\InstallCommand::class,
                Commands\PublishCommand::class,
                Commands\VersionCommand::class,
            ]);

        $this->app->singleton('zincui', function () {
            return new ClassBuilder;
        });

        if (file_exists(resource_path('views'))) {
            Blade::anonymousComponentPath(resource_path('views'));
        }

        Blade::anonymousComponentPath(__DIR__.'/../resources/views/components');
    }

    public static function classes()
    {
        return app('zincui');
    }
}
