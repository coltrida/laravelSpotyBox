<?php

use App\Http\Controllers\api\AlbumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('migrate', function (){
    Artisan::call('migrate:fresh --seed');
});

Route::get('albums', [AlbumController::class, 'index']);
Route::get('lastAlbums', [AlbumController::class, 'lastAlbums']);
Route::get('albumsBestSeller', [AlbumController::class, 'albumsBestSeller']);
Route::get('albumsBought/{userId}', [AlbumController::class, 'albumsBought']);
Route::get('artistBought/{userId}', [AlbumController::class, 'artistBought']);
Route::get('songs/{albumId}', [AlbumController::class, 'songs']);
Route::get('allSongs', [AlbumController::class, 'allSongs']);
Route::get('allSongsBought/{userId}', [AlbumController::class, 'allSongsBought']);
Route::get('prefSw/{songId}/{userId}', [AlbumController::class, 'prefSw']);
Route::get('prefs/{userId}', [AlbumController::class, 'prefs']);
Route::post('login', [AlbumController::class, 'login']);
Route::post('/purchase', [AlbumController::class, 'purchase']);
