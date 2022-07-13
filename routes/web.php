<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    echo ini_get('upload_max_filesize'), ", " , ini_get('post_max_size');

    die();

    return view('layouts.style2');
})->name('welcomePage');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

Route::group(
    [
        'middleware' => ['auth','verifyIsAdmin'],
        'prefix' => 'admin'
    ],
    function () {
        Route::get('/dashboard', [AdminController::class, 'home'])->name('dashboard');
        Route::get('/artists', [AdminController::class, 'artists'])->name('admin.artists');
        Route::post('/artists', [AdminController::class, 'insertArtist'])->name('insertArtist');
        Route::get('/albums', [AdminController::class, 'albums'])->name('admin.albums');
        Route::post('/albums', [AdminController::class, 'insertAlbum'])->name('insertAlbum');
        Route::get('/songs/{idAlbum?}', [AdminController::class, 'songs'])->name('admin.songs');
        Route::post('/songs', [AdminController::class, 'insertSong'])->name('insertSong');
        Route::delete('/songs/{idSong}', [AdminController::class, 'deleteSong'])->name('deleteSong');
        Route::delete('/albums/{idAlbum}', [AdminController::class, 'deleteAlbum'])->name('deleteAlbum');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/songsPreferitesByUser/{idUser}', [AdminController::class, 'songsPreferitesByUser'])->name('songsPreferitesByUser');
        Route::get('/songsBoughtByUser/{idUser}', [AdminController::class, 'songsBoughtByUser'])->name('songsBoughtByUser');
        Route::get('/albumsBoughtByUser/{idUser}', [AdminController::class, 'albumsBoughtByUser'])->name('albumsBoughtByUser');
        Route::get('/infoFatture/{idUser}', [AdminController::class, 'infoFatture'])->name('infoFatture');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/paymentDiscography/{artist}', [UserController::class, 'paymentDiscography'])->name('paymentDiscography');
    Route::get('/paymentAlbum/{album}', [UserController::class, 'paymentAlbum'])->name('paymentAlbum');
    Route::get('/paymentSong/{song}', [UserController::class, 'paymentSong'])->name('paymentSong');
    Route::post('/purchase', [UserController::class, 'purchase'])->name('purchase');
    Route::get('/artists', [UserController::class, 'artists'])->name('user.artists');
    Route::get('/albums/{idArtist?}', [UserController::class, 'albums'])->name('user.albums');
    Route::get('/songs/{idAlbum?}', [UserController::class, 'songs'])->name('user.songs');
});

Route::get('/webHook', [AdminController::class, 'webHook']);

require __DIR__.'/auth.php';
