<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('layouts.style2');
//    return view('layouts.style3');
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
        Route::get('/', [AdminController::class, 'home'])->name('admin.home');
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
    Route::get('/home/{category?}', [UserController::class, 'home'])->name('user.home');

    Route::group(
        [
            'middleware' => ['auth','verifyIsUte'],
            'prefix' => 'user'
        ],
        function () {
        Route::post('/findArtist', [UserController::class, 'findArtist'])->name('user.findArtist');
        Route::post('/findMyArtist', [UserController::class, 'findMyArtist'])->name('user.findMyArtist');
        Route::get('/paymentDiscography/{artist}', [UserController::class, 'paymentDiscography'])->name('paymentDiscography');
        Route::get('/paymentAlbum/{album}', [UserController::class, 'paymentAlbum'])->name('paymentAlbum');
        Route::get('/paymentSong/{song}', [UserController::class, 'paymentSong'])->name('paymentSong');
        Route::post('/purchase', [UserController::class, 'purchase'])->name('purchase');
        Route::get('/myArtists', [UserController::class, 'artists'])->name('user.artists');
        Route::get('/myAlbums', [UserController::class, 'albums'])->name('user.albums');
        Route::get('/myAlbums/{idArtist}', [UserController::class, 'albumsArtist'])->name('user.albumsArtist');
        Route::get('/songs/{idAlbum?}', [UserController::class, 'songs'])->name('user.songs');
    });

    Route::group(
        [
            'middleware' => ['auth','verifyIsArtist'],
            'prefix' => 'artist'
        ],
        function () {
        Route::post('/myAlbums/insert', [ArtistController::class, 'insertAlbum'])->name('artist.insertAlbum');
        Route::get('/songs/{idAlbum}', [ArtistController::class, 'songsOfAlbum'])->name('artist.album.songs');
        Route::post('/songs', [ArtistController::class, 'insertSong'])->name('artist.album.insertSong');
    });
});



Route::get('/webHook', [AdminController::class, 'webHook']);

require __DIR__.'/auth.php';
