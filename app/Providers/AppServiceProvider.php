<?php

namespace App\Providers;

use App\Classes\GameHandler;
use App\Classes\GamePlayer;
use App\Classes\GameRound;
use App\Classes\GameStatistics;
use App\Interfaces\GameInterface;
use App\Interfaces\PlayerInterface;
use App\Interfaces\RoundInterface;
use App\Interfaces\StatisticsInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        PlayerInterface::class => GamePlayer::class,
        RoundInterface::class => GameRound::class,
        StatisticsInterface::class => GameStatistics::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
