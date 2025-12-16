<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    protected $table = 'series.series';

    use HasFactory;
    protected $fillable = ['name', 'cover'];

    public function Seasons(){
        return $this->hasMany(Season::class, 'series_id');
    }

    public function numberEpisodesPerSeason() : int {
        $season = $this->Seasons()->first();

        return $season ? $season->Episodes()->count() : 0;
    }


    public static function booted(){
        return self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }
}


