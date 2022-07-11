<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;

class UserController extends Controller
{
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

    public function paymentAlbum(Album $album)
    {
        return view('user.payment', ['item' => $album]);
    }

    public function paymentSong(Song $song)
    {
        return view('user.payment', ['item' => $song]);
    }

    public function purchase(Request $request)
    {
        /*$stripeCharge = $request->user()->charge(
            10000, $request->paymentMethodId
        );*/

        $album = Album::find($request->input('idAlbum'));

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

//        $concert = Concert::find($request->idConcert);

        try {
            /*\Stripe\Charge::create ( array (
                "amount" => $album->cost * 100,
                "currency" => "usd",
                "customer" =>  $customer["id"],
                "description" => 'album '. $album->name
            ) );*/
            $stripe = new \Stripe\StripeClient(
                'sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26'
            );
            $idPrice = $stripe->prices->all(['product' => $album->stripe_id])->data[0]->id;
            auth()->user()->invoicePrice($idPrice, 1);

            \Session::flash ( 'success-message', 'Payment done successfully !' );

            return view ( 'user.payment', ['item' => $album]);
        } catch ( \Stripe\Error\Card $e ) {
            \Session::flash ( 'fail-message', $e->get_message() );
            return view ( 'payment' );
        }
    }
}
