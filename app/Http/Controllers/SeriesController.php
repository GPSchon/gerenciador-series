<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function index(Request $request){
        $series = Series::all();
        $mensagem = session('mensagemSucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagem);
    }

    public function create(){
        return view('series.create');
    }

    public function store(SeriesFormRequest $request){
        $series = Series::create($request->validated());
        $seasons = [];
        for($i = 1; $i <= $request->season; $i++){
            $seasons[] = [
                'series_id' => $series->id,
                'number' => $i
            ];
        }

        Season::insert($seasons);

        $episodes = [];
        foreach($series->seasons as $season){
            for($i = 1; $i <= $request->episode; $i++){
                $episodes[] = [
                    'seasons_id' => $season->id,
                    'number' => $i
                ];
            }
        }

        Episode::insert($episodes);

        return to_route('series.index')->with('mensagemSucesso', "A série '$series->name' foi adicionada com sucesso!!");
    }

    public function destroy(Series $series, Request $request){
        $series->delete();

        return to_route('series.index')->with('mensagemSucesso', "A série '$series->name' foi removida com sucesso!!");
    }

    public function edit(Series $series){
        return view('series.edit')->with('series', $series);
    }
    public function update(SeriesFormRequest $request, Series $series){
        $series->update($request->all());

        return to_route('series.index')->with('mensagemSucesso', "A série '$series->name' foi atualizada com sucesso!!");

    }
}
