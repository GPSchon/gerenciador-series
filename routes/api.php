<?php

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SeriesController;

Route::name('api.')->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('login', function(Request $request){
        $credentials = $request->only('email','password');
        if(!Auth::attempt($credentials)){
            return response()->json('Verifique o usuário e a senha!', 401);
        }

        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('token');
        return $token->plainTextToken();
    });

    Route::middleware('auth:sanctum')->group(function (){
        Route::apiResource('series', SeriesController::class);

        Route::get('series/{id}/seasons', function (int $id){
            $series = Series::find($id);
            if($series === null){
                return response()->json(['message' => 'Serie não encontrada'], 404);
            }
            return response()->json($series->Seasons, 200);
        })->name('series.seasons');

        Route::get('series/{id}/episodes', function (int $id){
            $series = Series::find($id);
            if($series === null){
                return response()->json(['message' => 'Serie não encontrada'], 404);
            }
            return response()->json($series->Episodes, 200);
        })->name('series.episodes');

        Route::patch('episodes/{episode}/watch', function (Episode $episode, Request $request){
            $episode->watched = $request->watched;
            $episode->save();

            return response()->json($episode, 200);
        })->name('episode.watch');

        Route::patch('season/{season}/episodes/watch', function (Season $season, Request $request){
            $episodes = $season->episodes()
                ->whereIn('number', $request->number)
                ->get();

            $toTrue = $episodes
                ->where('watched', false)
                ->pluck('id')
                ->toArray();

            Episode::whereIn('id', $episodes->pluck('id'))
                ->update(['watched' => false]);

            if (!empty($toTrue)) {
                Episode::whereIn('id', $toTrue)
                    ->update(['watched' => true]);
            }

            return response()->json([
                'updated' => $episodes->pluck('number'),
            ], 200);
        })->name('season.episode.watch');
    });
});
