<?php

namespace App\Repositories;

use App\Models\Series;
use App\DTO\SeriesData;

interface SeriesRepository{
    public function add(SeriesData $data): Series;
}
