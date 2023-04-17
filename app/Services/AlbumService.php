<?php

namespace App\Services;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Support\Facades\Storage;

class AlbumService
{
    public function insert($request)
    {
        $productStripe = $this->saveAlbumStripe($request);
        $album = Album::create([
            'name' => $request->name,
            'artist_id' => $request->artist_id,
            'cost' => (float)$request->cost,
            'stripe_id' => isset($productStripe->id) ? $productStripe->id : null,
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $album->id . '.' . $file->extension();
            Storage::disk('public')->putFileAs('/covers', $file, $filename);
        }
        return $album;
    }

    public function saveAlbumStripe($request)
    {
        ini_set("memory_limit", "-1");
        $stripe = new \Stripe\StripeClient('sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26');

        try {
            return $stripe->products->create(
                [
                    'name' => 'Album '.$request->name,
                    'description' => 'Album',
                    'metadata' => [
                        'tipo' => 'album'
                    ],
                    'default_price_data' => [
                        'unit_amount' => (float)$request->cost * 100,
                        'currency' => 'usd',
                    ],
                    'expand' => ['default_price'],
                ]
            );
        } catch (\Exception $exception){
            print_r($exception);
        }

    }

    public function delete($idAlbum)
    {
        $album = Album::with('songs')->find($idAlbum);
        if (count($album->songs) > 0){
            foreach ($album->songs as $song){
                Storage::disk('public')->delete("/songs/$song->id.mp3");
            }
        }
        Storage::disk('public')->delete("/covers/$idAlbum.jpg");
        Album::destroy($idAlbum);
    }

    public function albumConSongs($idAlbum)
    {
        return Album::with('songs', 'artist')->where('id', $idAlbum)->get();
    }

    public function albumsConSongs()
    {
        return Album::with('songs', 'artist')->get();
    }

    public function myAlbums()
    {
        return \Auth::user()->albumsales;
    }

    public function albumsOfArtist($idArtist)
    {
        return Artist::with('albums')->find($idArtist)->albums;
    }
}
