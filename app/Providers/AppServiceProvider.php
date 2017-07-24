<?php

// rdehnhardt
// whera

namespace App\Providers;

use App\Domain\Contracts\AdvertisementsContract;
use App\Domain\Contracts\PicturesContract;
use App\Domain\Contracts\UsersContract;
use App\Domain\Repository\Eloquent\AdvertisementsRepository;
use App\Domain\Repository\Eloquent\PicturesRepository;
use App\Domain\Repository\Eloquent\UsersRepository;
use App\Models\Advertisement;
use App\Models\User;
use App\Observer\AdvertisementObserver;
use App\Observer\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerObservers();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
    }

    /**
     * Model Observers
     */
    private function registerObservers()
    {
        User::observe(UserObserver::class);
        Advertisement::observe(AdvertisementObserver::class);
    }

    /**
     * Repositories
     */
    private function registerRepositories()
    {
        $this->app->bind(UsersContract::class, UsersRepository::class);
        $this->app->bind(AdvertisementsContract::class, AdvertisementsRepository::class);
        $this->app->bind(PicturesContract::class, PicturesRepository::class);
    }
}
