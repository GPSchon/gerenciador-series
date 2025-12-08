<?php

namespace App\Providers;

use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ElequentSeriesRepository;

class RepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        SeriesRepository::class => ElequentSeriesRepository::class,
    ];
}
