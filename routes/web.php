<?php

use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

Route::group(['middleware' => ['auth','verifyIsAdmin']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/artists', [AdminController::class, 'artists'])->name('artists');
    Route::post('/artists', [AdminController::class, 'insertArtist'])->name('insertArtist');
    Route::get('/albums', [AdminController::class, 'albums'])->name('albums');
    Route::post('/albums', [AdminController::class, 'insertAlbum'])->name('insertAlbum');
    Route::get('/songs/{idAlbum?}', [AdminController::class, 'songs'])->name('songs');
    Route::post('/songs', [AdminController::class, 'insertSong'])->name('insertSong');
    Route::delete('/songs/{idSong}', [AdminController::class, 'deleteSong'])->name('deleteSong');
    Route::delete('/albums/{idAlbum}', [AdminController::class, 'deleteAlbum'])->name('deleteAlbum');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/songsPreferitesByUser/{idUser}', [AdminController::class, 'songsPreferitesByUser'])->name('songsPreferitesByUser');
    Route::get('/songsBoughtByUser/{idUser}', [AdminController::class, 'songsBoughtByUser'])->name('songsBoughtByUser');
    Route::get('/albumsBoughtByUser/{idUser}', [AdminController::class, 'albumsBoughtByUser'])->name('albumsBoughtByUser');
});

require __DIR__.'/auth.php';
