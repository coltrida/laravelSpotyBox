<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home($category=null)
    {
        $artists = $category ? Artist::where('category', $category)->get() : Artist::get();
        return view('user.home', compact('artists'));
    }

    public function findArtist(Request $request)
    {
        $artists = Artist::where('name', 'like', '%'.$request->name.'%')->get();
        return view('user.home', compact('artists'));
    }

    public function artists()
    {
        return view('user.artists', [
            'artists' => Artist::orderBy('name')->paginate(10)
        ]);
    }

    public function albums($idArtist=null)
    {
        if ($idArtist){
            return view('user.albums', [
                'albums' => Artist::with('albums')->find($idArtist)->albums
            ]);
        }
        return view('user.albums',[
            'albums' => Album::all()
        ]);
    }

    public function songs($idAlbum = null)
    {
        if ($idAlbum){
            return view('user.songs', [
                'albums' => Album::with('songs', 'artist')->where('id', $idAlbum)->get()
            ]);
        } else {
            return view('user.songs', [
                'albums' => Album::with('songs', 'artist')->get()
            ]);
        }
    }

    public function paymentDiscography(Artist $artist)
    {
        return view('user.payment', [
            'item' => $artist,
            'tipologia' => 'discography'
        ]);
    }

    public function paymentAlbum(Album $album)
    {
        return view('user.payment', [
            'item' => $album,
            'tipologia' => 'album'
        ]);
    }

    public function paymentSong(Song $song)
    {
        return view('user.payment', [
            'item' => $song,
            'tipologia' => 'song'
        ]);
    }

    public function purchase(Request $request)
    {
        if ($request->input('tipologia') === 'album'){
            $item = Album::find($request->input('idItem'));
        } elseif ($request->input('tipologia') === 'discography'){
            $item = Artist::with('albums')->find($request->input('idItem'));
        } else {
            $item = Song::find($request->input('idItem'));
        }

        \Stripe\Stripe::setApiKey('sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26');

        $customer = null;
        if (auth()->user()->stripe_id) {
            $customer = \Stripe\Customer::all([
                "email" => auth()->user()->email
            ])->first();
        }

        if (!$customer) {
            $customer = \Stripe\Customer::create(array(
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'source' => $request->input('stripeToken'),
            ));
            auth()->user()->stripe_id = $customer["id"];
            auth()->user()->save();
        }


        try {
            $stripe = new \Stripe\StripeClient(
                'sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26'
            );
            $idPrice = $stripe->prices->all(['product' => $item->stripe_id])->data[0]->id;
            auth()->user()->invoicePrice($idPrice, 1);

            if ($request->input('tipologia') === 'album'){
                auth()->user()->albumsales()->attach($item->id);
                auth()->user()->artistsales()->syncWithoutDetaching($item->artist->id);
            } elseif ($request->input('tipologia') === 'discography'){
                auth()->user()->artistsales()->attach($item->id);
                auth()->user()->albumsales()->syncWithoutDetaching($item->albums);
            } else {
                auth()->user()->songsales()->attach($item->id);
            }

            \Session::flash ( 'success-message', 'Payment done successfully !' );

            return view ( 'user.payment', [
                'item' => $item,
                'tipologia' => $request->input('tipologia')
            ]);
        } catch ( \Stripe\Error\Card $e ) {
            \Session::flash ( 'fail-message', $e->get_message() );
            return view ( 'payment' );
        }
    }
}
