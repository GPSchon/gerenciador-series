<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EpisodesController extends Controller
{
    public function index(Season $season){
        return view('episodes.index')->with('episodes', $season->episodes);
    }

    public function update(Season $season, Request $request){
        $marcados = $request->input('episodes', []);

        Episode::where('seasons_id', $season->id)->update(['watched' => false]);

        Episode::whereIn('id', $marcados)->update(['watched' => true]);

        return to_route('seasons.index', $season->series_id)->with('mensagemSucesso', 'Episódios atualizados com sucesso!');
    }
}
