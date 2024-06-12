<?php

namespace BataBoom\PollsBB;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use BataBoom\PollsBB\Commands\PollsBBCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

class PollsBBServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pollsbb')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_pollsbb_table')
            ->hasCommand(PollsBBCommand::class)
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    //->publishAssets()
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub();
            });
    }
}
