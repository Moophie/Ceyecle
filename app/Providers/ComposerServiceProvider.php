<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['friends/list', 'friends/leaderboards', 'rooms/invite'], \App\Http\ViewComposers\FriendsComposer::class);
        view()->composer(['friends/list', 'friends/index', 'components/navbar'], \App\Http\ViewComposers\RequestComposer::class);
        view()->composer(['index'], \App\Http\ViewComposers\RoomRequestComposer::class);
    }
}
