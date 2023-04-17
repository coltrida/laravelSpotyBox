<?php

namespace App\Services;

use App\Models\Song;
use Illuminate\Support\Facades\Storage;

class SongService
{
    public function save($request)
    {
        $productStripe = $this->saveSongStripe($request);
        $song = Song::create([
            'name' => $request->name,
            'cost' => (float)$request->cost,
            'stripe_id' => isset($productStripe->id) ? $productStripe->id : null,
            'album_id' => $request->album_id
        ]);

        if ($request->hasFile('music')) {
            $file = $request->file('music');
            $filename = $song->id . '.mp3';
            Storage::disk('public')->putFileAs('/songs', $file, $filename);
          //  $file->storeAs('songs',$filename, 's3');
        }
    }

    public function saveSongStripe($request)
    {
        ini_set("memory_limit", "-1");
        $stripe = new \Stripe\StripeClient('sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26');

        try {
            return $stripe->products->create(
                [
                    'name' => 'Song '.$request->name,
                    'description' => 'Song',
                    'metadata' => [
                        'tipo' => 'song'
                    ],
                    'default_price_data' => [
                        'unit_amount' => (float)$request->cost * 100,
                        'currency' => 'usd',
                    ],
                    'expand' => ['default_price'],
                ]
            );
        } catch (\Exception $exception) {
            print_r($exception);
        }

    }
}
