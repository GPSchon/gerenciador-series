<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\DTO\SeriesData;
use Illuminate\Http\Request;
use App\Events\SeriesCreated;
use App\Services\UploadService;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SeriesFormRequest;


class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository,private UploadService $uploadService){

    }

    public function index(Request $request){
        $series = Series::all();
        $mensagem = session('successMessage');

        return view('series.index')
            ->with('series', $series)
            ->with('successMessage', $mensagem);
    }

    public function create(){
        return view('series.create');
    }

    public function store(SeriesFormRequest $request){
        $coverPath = null;

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $coverPath = $this->uploadService->handle($request->file('cover'), 'path_cover');
        }

        $validated = $request->validated();
        $validated['cover'] = $coverPath;

        $data = new SeriesData($validated);
        $series = $this->repository->add($data);

        SeriesCreated::dispatch(
            $request->name,
            $request->season,
            $request->episode,
            $series->id,
        );

        return to_route('series.index')->with('successMessage', "A série '$series->name' foi adicionada com sucesso!!");
    }

    public function destroy(Series $series, Request $request){
        if ($series->cover) {
            $this->uploadService->delete($series->cover);
        }
        $series->delete();

        return to_route('series.index')->with('successMessage', "A série '$series->name' foi removida com sucesso!!");
    }

    public function edit(Series $series){
        return view('series.edit')->with('series', $series);
    }
    public function update(SeriesFormRequest $request, Series $series){
        $data = $request->validated();
        if ($request->hasFile('cover')) {
            $oldPath = $series->cover ? $series->cover : null;

            $data['cover'] = $this->uploadService->handle($request->file('cover'), 'path_cover', $oldPath);
        }

        $series->update($data);


        return to_route('series.index')->with('successMessage', "A série '$series->name' foi atualizada com sucesso!!");
    }
}
