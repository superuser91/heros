<?php

use Illuminate\Support\Facades\Route;
use Vgplay\Heros\Controllers\ClanController;
use Vgplay\Heros\Controllers\HeroController;

Route::middleware('web')->group(function () {
    Route::group([
        'prefix' => config('vgplay.prefix'),
        'middleware' => config('vgplay.middleware')
    ], function () {
        Route::resource('heros', HeroController::class)->except('show');
        Route::resource('clans', ClanController::class)->except('show');
    });
});
