@extends('dashboard')
@section('title', "Songs bought by $user->name")
@section('content')
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" class="col-2">#</th>
                <th scope="col" class="col-4">Name</th>
                <th scope="col" class="col-3">Album</th>
                <th scope="col" class="col-3">Artist</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->songsales as $song)
                <tr>
                    <th scope="row">{{$song->id}}</th>
                    <td>{{$song->name}}</td>
                    <td>{{$song->album->name}}</td>
                    <td>{{$song->album->artist->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
@stop
