<?php

namespace App\Models;

use App\Models\Series;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Season extends Model
{
    protected $table = 'series.seasons';

    use HasFactory;
    protected $fillable = ['number'];

    public function Series() {
        return $this->belongsTo(Series::class);
    }

    public function Episodes(){
        return $this->hasMany(Episode::class, 'seasons_id');
    }
}
