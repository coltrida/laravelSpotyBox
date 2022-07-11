@extends('dashboard')
@section('title', 'Users')
@section('content')

    <table class="table table-striped mt-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">email</th>
            <th scope="col">Subscibe</th>
            <th scope="col" >Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at->format('d/m/Y')}}</td>
                <td >
                    <a class="btn btn-success" href="{{route('songsPreferitesByUser', $user->id)}}" title="preferite songs">
                        <i class="fa-solid fa-heart"></i> {{$user->preferites_count}}
                    </a>
                    <a class="btn btn-success" href="{{route('songsBoughtByUser', $user->id)}}" title="songs purchased">
                        <i class="fa-solid fa-music"></i> {{$user->songsales_count}} <i class="fa-solid fa-sack-dollar"></i>
                    </a>
                    <a class="btn btn-success" href="{{route('albumsBoughtByUser', $user->id)}}" title="album purchased">
                        <i class="fa-solid fa-compact-disc"></i> {{$user->albumsales_count}} <i class="fa-solid fa-sack-dollar"></i>
                    </a>
                    @if($user->stripe_id)
                        <a class="btn btn-success" href="{{route('infoFatture', $user->id)}}" title="info invoices">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="7">
                <div class="row">
                    <div class="col-md-8 offset-md-2 d-flex justify-content-center">
                        {{$users->links()}}
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
@stop
