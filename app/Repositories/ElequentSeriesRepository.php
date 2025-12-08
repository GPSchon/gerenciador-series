<?php

namespace App\Repositories;

use App\Models\Season;
use App\Models\Series;
use App\DTO\SeriesData;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use App\Repositories\SeriesRepository;



class ElequentSeriesRepository implements SeriesRepository
{
    public function add(SeriesData $data): Series
    {
        return DB::transaction(function () use ($data) {
            $series = Series::create(['name' => $data->name]);

            $seasons = [];
            for ($i = 1; $i <= $data->seasonQty; $i++) {
                $seasons[] = [
                    'series_id' => $series->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons);

            $episodes = [];
            foreach ($series->seasons as $season) {
                for ($i = 1; $i <= $data->episodeQty; $i++) {
                    $episodes[] = [
                        'seasons_id' => $season->id,
                        'number' => $i,
                    ];
                }
            }
            Episode::insert($episodes);

            return $series;
        });
    }
}

