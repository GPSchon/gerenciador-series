<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\DTO\SeriesData;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;


class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository){

    }

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
        $data = new SeriesData($request->validated());
        $series = $this->repository->add($data);


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
