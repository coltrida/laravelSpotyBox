<?php

namespace App\Http\Controllers;

use App\Services\AlbumService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArtistController extends Controller
{
    public function insertAlbum(Request $request, AlbumService $albumService)
    {
        $albumService->insert($request);
        return Redirect::route('user.home');
    }

    public function deleteAlbum($idAlbum, AlbumService $albumService)
    {
        $albumService->delete($idAlbum);
        return Redirect::back();
    }

    public function songsOfAlbum($idAlbum, AlbumService $albumService)
    {
        return view('artist.songs', [
            'albums' => $albumService->albumConSongs($idAlbum)
        ]);
    }

    public function insertSong(Request $request, SongService $songService)
    {
        $songService->save($request);
        return Redirect::back();
    }
}
