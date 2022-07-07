<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        return Album::with(['artist', 'songs' => function($p){
            $p->with('album', 'preferites:id');
        }])->get();
    }

    public function albumsBought($userId)
    {
       // return Album::with('songs', 'artist')->get();
        return User::with(['albumsales' => function($q){
            $q->with(['artist', 'songs' => function($p){
                $p->with('album', 'preferites:id');
            }]);
        }])->find($userId)->albumsales;
    }

    public function artistBought($userId)
    {
        return User::with(['artistsales' => function($q) use($userId){
            $q->with(['albums' => function($d) use($userId){
                $d->albumbought($userId)->with(['artist', 'songs' => function($f){
                    $f->with('album', 'preferites:id');
                }]);
            }]);
        }])->find($userId)->artistsales;
    }

    public function songs($albumId)
    {
        return Album::with(['songs' => function($q){
            $q->with('album');
        }])->find($albumId);
    }

    public function allSongs()
    {
        return Song::with('album')->whereHas('album', function ($q){
            $q->whereHas('artist', function ($p){
                $p->where('id', 1);
            });
        })->get();
    }

    public function allSongsBought($userId)
    {
        return User::with(['songsales' => function($p){
            $p->with('album', 'preferites:id');
        }])->find($userId)->songsales;
    }

    public function prefSw($songId, $userId)
    {
        $user = User::find($userId);
        $user->preferites()->toggle($songId);
    }

    public function prefs($userId)
    {
        return User::with(['preferites' => function($q){
            $q->with('album', 'preferites:id');
        }])->find($userId)->preferites;
//        return Song::with('album')->where('pref', 1)->get();
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->mail)->first();

        /*if($user->ruolo_id === 1){
            $user->password = Hash::make($password);
            $user->cleanpassword = $password;
            $user->save();
        }*/

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return [
                'message' => ['Le Credenziali non corrispondono'],
                'stato' => 'errore'
            ];
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
            'stato' => 'successo'
        ];
    }
}
