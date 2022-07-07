@extends('dashboard')
@section('title', "Albums bought by $user->name")
@section('content')
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" class="col-2">#</th>
                <th scope="col" class="col-4">Name</th>
                <th scope="col" class="col-3">Artist</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->albumsales as $album)
                <tr>
                    <th scope="row">{{$album->id}}</th>
                    <td>{{$album->name}}</td>
                    <td>{{$album->artist->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
@stop
