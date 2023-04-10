<?php

namespace App\Http\Controllers;

use App\Services\AlbumService;
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
}
