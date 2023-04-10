<?php

namespace App\Services;

use App\Models\Artist;

class ArtistServices
{
    public function lista()
    {
        return Artist::withCount('albums')->orderBy('name')->get();
    }

    public function listaConAlbum()
    {
        return Artist::with(['albums' => function($q){
            $q->withCount('songs');
        }])->orderBy('name')->get();
    }

    public function artistConAlbum($idArtist)
    {
        return Artist::with(['albums' => function($q){
            $q->withCount('songs');
        }])->orderBy('name')->find($idArtist);
    }

    public function insert($request)
    {
        $productStripe = $this->saveArtistStripe($request);
        Artist::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'cost' => (float)$request->cost,
            'stripe_id' => isset($productStripe->id) ? $productStripe->id : null,
        ]);
    }

    public function saveArtistStripe($request)
    {
        $stripe = new \Stripe\StripeClient('sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26');
        return $stripe->products->create(
            [
                'name' => 'Discography of '.$request->name,
                'description' => 'Discography',
                'metadata' => [
                    'tipo' => 'discography'
                ],
                'default_price_data' => [
                    'unit_amount' => (float)$request->cost * 100,
                    'currency' => 'usd',
                ],
                'expand' => ['default_price'],
            ]
        );
    }
}
