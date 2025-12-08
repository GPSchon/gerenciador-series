<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;

Route::get('/', function () {
    return to_route('series.index');
});

Route::resource('/series', SeriesController::class)->except('show');

Route::get('/series/{series}/season', [SeasonsController::class, 'index'])->name('seasons.index');
