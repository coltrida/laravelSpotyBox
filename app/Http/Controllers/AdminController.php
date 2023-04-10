<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use App\Services\AlbumService;
use App\Services\ArtistServices;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Cashier;
use Stripe\Product;

class AdminController extends Controller
{
    public function home()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26'
        );
        $balance = $stripe->balance->retrieve();
        return view('admin.home', compact('balance'));
    }

    public function artists(ArtistServices $artistServices)
    {
        return view('admin.artists', [
            'artists' => $artistServices->lista()
        ]);
    }

    public function insertArtist(Request $request)
    {

        return Redirect::back();
    }



    public function albums(ArtistServices $artistServices)
    {
        return view('admin.albums', [
            'artists' => $artistServices->listaConAlbum()
        ]);
    }

    public function insertAlbum(Request $request, AlbumService $albumService)
    {
        $albumService->insert($request);
        return Redirect::back();
    }

    public function songs(AlbumService $albumService, $idAlbum = null)
    {
        if ($idAlbum){
            return view('admin.songs', [
                'albums' => $albumService->albumConSongs($idAlbum)
            ]);
        } else {
            return view('admin.songs', [
                'albums' => $albumService->albumsConSongs()
            ]);
        }
    }

    public function insertSong(Request $request, SongService $songService)
    {
        $songService->save($request);
        return Redirect::back();
    }



    public function deleteSong($idSong)
    {
        Storage::disk('public')->delete("/songs/$idSong.mp3");
        Song::destroy($idSong);
        return Redirect::back();
    }

    public function deleteAlbum($idAlbum, AlbumService $albumService)
    {
        $albumService->delete($idAlbum);
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
                ->paginate(10)
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

    public function infoFatture($idUser)
    {
        $user = User::find($idUser);
        if (!$user->stripe_id){
            return Redirect::back();
        }

        \Stripe\Stripe::setApiKey('sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26');
        $stripe = new \Stripe\StripeClient(
            'sk_test_tqFIGSA54WEaXkE4LXrZGTtX00gRqA2x26'
        );

        $invoices = $stripe->invoices->all(['customer' => $user->stripe_id])->data;

       return view('admin.infoFatture', compact('invoices'));
    }

    public function webHook()
    {

// webhook.php
//
// Use this sample code to handle webhook events in your integration.
//
// 1) Paste this code into a new file (webhook.php)
//
// 2) Install dependencies
//   composer require stripe/stripe-php
//
// 3) Run the server on http://localhost:4242
//   php -S localhost:4242

  //      require 'vendor/autoload.php';

// This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_3b75d147856871463260b0d1f0a7b47933a66dce99e883930c7d9a15a02d4470';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

// Handle the event
        switch ($event->type) {
            case 'account.updated':
                $account = $event->data->object;
                break;
            case 'account.external_account.created':
                $externalAccount = $event->data->object;
                break;
            case 'account.external_account.deleted':
                $externalAccount = $event->data->object;
                break;
            case 'account.external_account.updated':
                $externalAccount = $event->data->object;
                break;
            case 'balance.available':
                $balance = $event->data->object;
                break;
            case 'charge.captured':
                $charge = $event->data->object;
                break;
            case 'charge.expired':
                $charge = $event->data->object;
                break;
            case 'charge.failed':
                $charge = $event->data->object;
                break;
            case 'charge.pending':
                $charge = $event->data->object;
                break;
            case 'charge.refunded':
                $charge = $event->data->object;
                break;
            case 'charge.succeeded':
                $charge = $event->data->object;
                break;
            case 'charge.updated':
                $charge = $event->data->object;
                break;
            case 'charge.dispute.closed':
                $dispute = $event->data->object;
                break;
            case 'charge.dispute.created':
                $dispute = $event->data->object;
                break;
            case 'charge.dispute.funds_reinstated':
                $dispute = $event->data->object;
                break;
            case 'charge.dispute.funds_withdrawn':
                $dispute = $event->data->object;
                break;
            case 'charge.dispute.updated':
                $dispute = $event->data->object;
                break;
            case 'charge.refund.updated':
                $refund = $event->data->object;
                break;
            case 'checkout.session.async_payment_failed':
                $session = $event->data->object;
                break;
            case 'checkout.session.async_payment_succeeded':
                $session = $event->data->object;
                break;
            case 'checkout.session.completed':
                $session = $event->data->object;
                break;
            case 'checkout.session.expired':
                $session = $event->data->object;
                break;
            case 'payout.canceled':
                $payout = $event->data->object;
                break;
            case 'payout.created':
                $payout = $event->data->object;
                break;
            case 'payout.failed':
                $payout = $event->data->object;
                break;
            case 'payout.paid':
                $payout = $event->data->object;
                break;
            case 'payout.updated':
                $payout = $event->data->object;
                break;
            case 'person.created':
                $person = $event->data->object;
                break;
            case 'person.deleted':
                $person = $event->data->object;
                break;
            case 'person.updated':
                $person = $event->data->object;
                break;
            case 'transfer.created':
                $transfer = $event->data->object;
                break;
            case 'transfer.failed':
                $transfer = $event->data->object;
                break;
            case 'transfer.paid':
                $transfer = $event->data->object;
                break;
            case 'transfer.reversed':
                $transfer = $event->data->object;
                break;
            case 'transfer.updated':
                $transfer = $event->data->object;
                break;
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }

}
