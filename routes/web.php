<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodesController;

Route::get('/', function () {
    return to_route('series.index');
});

Route::resource('/series', SeriesController::class)->except('show');

Route::get('/series/{series}/season', [SeasonsController::class, 'index'])->name('seasons.index');

Route::get('/season/{season}/episode', [EpisodesController::class, 'index'])->name('episode.index');
Route::patch('/season/{season}/episode', [EpisodesController::class, 'update'])->name('episode.update');
