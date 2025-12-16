<?php

namespace App\DTO;

class SeriesData
{
    public string $name;
    public int $seasonQty;
    public int $episodeQty;
    public ?string $cover;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->seasonQty = $data['season'];
        $this->episodeQty = $data['episode'];
        $this->cover = $data['cover'] ?? null;
    }
}

