<?php

namespace BataBoom\PollsBB;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use BataBoom\PollsBB\Commands\PollsBBCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Livewire\Livewire;

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
                    ->askToStarRepoOnGitHub('https://github.com/BataBoom/PollsBB');
            });
    }

    public function boot()
    {
        // Register Livewire components
       // Livewire::component('poll', \BataBoom\PollsBB\Livewire\Poll::class);
        //Livewire::component('create-poll', \BataBoom\PollsBB\Livewire\CreatePoll::class);

        // Publish views
        $this->loadViewsFrom(__DIR__.'/../resources/views/livewire/pollsbb', 'pollsbb');
    }
}
