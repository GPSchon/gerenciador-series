<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    protected $table = 'series.episodes';

    use HasFactory;
    protected $fillable = ['number'];
    public $timestamps = false;
    protected $casts = [
        'watched' => 'boolean'
    ];

    public function Season(){
        return $this->belongsTo(Season::class);
    }

    public static function booted(){
        return self::addGlobalScope('ordered', function (Builder $query) {
            $query->orderBy('number');
        });
    }
}
