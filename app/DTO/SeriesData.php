<?php

namespace App\DTO;

class SeriesData
{
    public string $name;
    public int $seasonQty;
    public int $episodeQty;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->seasonQty = $data['season'];
        $this->episodeQty = $data['episode'];
    }
}

