<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use App\DTO\SeriesData;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Events\SeriesCreated;
use App\Services\UploadService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository, private UploadService $uploadService){

    }

    public function index()
    {
        $series = Series::all();

        return $series;
    }

    public function show(int $id){
        $series = Series::with('Seasons.Episodes')->find($id);
        if($series === null){
            return response()-json(['message' => 'Serie não encontrada'], 404);
        }
        return response()->json($series,200);
    }

    public function store(SeriesFormRequest $request, UploadService $uploadService)
    {
        //dd($request->validated());
        try {
            $validated = $request->validated();

            if ($request->hasFile('cover')) {

                $coverPath = $uploadService->handle($request->file('cover'),'series-cover');
                $validated['cover'] = $coverPath;
            }

            $data = new SeriesData($validated);
            $series = $this->repository->add($data);

            SeriesCreated::dispatch(
                $request->name,
                $request->season,
                $request->episode,
                $series->id,
            );
            return response()->json($series, 201);
        } catch (\Throwable $e) {
            Log::error('Erro ao criar série: '.$e->getMessage());

            return response()->json([
                'error' => 'Erro interno ao criar série',
                'message' => $e->getMessage()
            ], 500);
        }

    }

    public function update(SeriesFormRequest $request, Series $series)
    {
        $series->fill($request->all());
        if ($request->hasFile('cover')) {
                $oldPath = $series->cover ? $series->cover : null;
                $coverPath = $this->uploadService->handle($request->file('cover'),'series-cover', $oldPath);

                $series->cover = $coverPath;
            }
        $series->save();

        return response()->json($series,200);
    }

    public function destroy(Series $series)
    {
        if($series->cover){
            $this->uploadService->delete($series->cover);
        }

        $series->delete();
        return response()->noContent();
    }
}
