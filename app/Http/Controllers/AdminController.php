<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function artists()
    {
        return view('admin.artists', [
            'artists' => Artist::withCount('albums')->orderBy('name')->get()
        ]);
    }

    public function insertArtist(Request $request)
    {
        Artist::create($request->all());
        return Redirect::back();
    }

    public function albums()
    {
        return view('admin.albums', [
            'artists' => Artist::with(['albums' => function($q){
                $q->withCount('songs');
            }])->orderBy('name')->get()
        ]);
    }

    public function insertAlbum(Request $request)
    {
        $album = Album::create([
            'name' => $request->name,
            'artist_id' => $request->artist_id
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $album->id . '.' . $file->extension();
          //  $file->storeAs('public/covers', $filename);
            Storage::disk('public')->putFileAs('/covers', $file, $filename);
        }

        return Redirect::back();
    }

    public function songs($idAlbum = null)
    {
        if ($idAlbum){
            return view('admin.songs', [
                'albums' => Album::with('songs', 'artist')->where('id', $idAlbum)->get()
            ]);
        } else {
            return view('admin.songs', [
                'albums' => Album::with('songs', 'artist')->get()
            ]);
        }
    }

    public function insertSong(Request $request)
    {
        $song = Song::create([
            'name' => $request->name,
            'album_id' => $request->album_id
        ]);

        if ($request->hasFile('music')) {
            $file = $request->file('music');
            $filename = $song->id . '.' . $file->extension();
        //    $file->storeAs('public/songs', $filename);
            Storage::disk('public')->putFileAs('/songs', $file, $filename);
        }

        return Redirect::back();
    }

    public function deleteSong($idSong)
    {
        Storage::disk('public')->delete("/songs/$idSong.mp3");
        Song::destroy($idSong);
        return Redirect::back();
    }

    public function deleteAlbum($idAlbum)
    {
        $album = Album::with('songs')->find($idAlbum);
        if (count($album->songs) > 0){
            foreach ($album->songs as $song){
                Storage::disk('public')->delete("/songs/$song->id.mp3");
            }
        }
        Storage::disk('public')->delete("/covers/$idAlbum.jpg");
        Album::destroy($idAlbum);
        return Redirect::back();
    }

    public function users()
    {
        return view('admin.users', [
            'users' => User::ute()
                ->withCount('preferites')
                ->withCount('songsales')
                ->withCount('albumsales')
                ->orderBy('name')
                ->get()
        ]);
    }

    public function songsPreferitesByUser($idUser)
    {
        return view('admin.preferiteSongs', [
            'user' => User::with('preferites')->find($idUser)
        ]);
    }

    public function songsBoughtByUser($idUser)
    {
        return view('admin.songSales', [
            'user' => User::with('songsales')->find($idUser)
        ]);
    }

    public function albumsBoughtByUser($idUser)
    {
        return view('admin.albumSales', [
            'user' => User::with('albumsales')->find($idUser)
        ]);
    }
}
