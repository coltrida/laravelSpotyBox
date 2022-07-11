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

    public function lastAlbums()
    {
        return Album::latest()->with(['artist', 'songs' => function($p){
            $p->with('album', 'preferites:id');
        }])->take(3)->get();
    }

    public function albumsBestSeller()
    {
        return Album::
            with(['artist', 'songs' => function($q){
                $q->with(['album', 'preferites:id']);
        }])
                ->withCount('albumsales')
                ->orderBy('albumsales_count', 'DESC')
                ->take(3)
                ->get();
    }

    public function albumsBought($userId)
    {
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

    public function purchase(Request $request)
    {
        /*$stripeCharge = $request->user()->charge(
            10000, $request->paymentMethodId
        );*/

        $album = Album::with('artist')->find($request->input('idAlbum'));

        \Stripe\Stripe::setApiKey('sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26');

        $user = User::find($request->input('userId'));

        $customer = null;
        if ($user->stripe_id) {
            $customer = \Stripe\Customer::all([
                "email" => $user->email
            ])->first();
        }

        if (!$customer) {
            $customer = \Stripe\Customer::create(array(
                'name' => $user->name,
                'email' => $user->email,
                'source' => $request->input('stripeToken'),
            ));
            $user->stripe_id = $customer["id"];
            $user->save();
        }

        try {
            /*\Stripe\Charge::create ( array (
                "amount" => $request->input('costo'),
                "currency" => "usd",
                "customer" =>  $customer["id"],
                "description" => $request->input('description')
            ) );*/

            $stripe = new \Stripe\StripeClient(
                'sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26'
            );
            $idPrice = $stripe->prices->all(['product' => $album->stripe_id])->data[0]->id;
            $stripe->invoiceItems->create([
                'customer' => $user->stripe_id,
                'price' => $idPrice,
            ]);
            $invoice = $stripe->invoices->create([
                'customer' => $user->stripe_id,
            ]);
            $stripe->invoices->pay(
                $invoice->id,
                []
            );
          //  return $stripe->customers->retrieve($user->stripe_id);
          //  $user->invoicePrice($idPrice, 1,);
          //  return $stripe->customers->all();
            $user->albumsales()->attach($album->id);
            $user->artistsales()->attach($album->artist->id);
            return [
                'message' => ['Payment done successfully !'],
                'stato' => 'ok'
            ];
        } catch ( \Stripe\Error\Card $e ) {
//            \Session::flash ( 'fail-message', $e->get_message() );
            return [
                'message' => [$e->get_message()],
                'stato' => 'error'
            ];
        }
    }
}
