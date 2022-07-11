@extends('dashboard')
@section('title', 'Songs')
@section('content')
    @foreach($albums as $album)
        @if(count($album->songs) > 0)
        <div class="mt-5">
            <h2>{{$album->name}} - {{$album->artist->name}}</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col" class="col-2">#</th>
                    <th scope="col" class="col-4">Name</th>
                    <th scope="col" class="col-2">Costo</th>
                    <th scope="col" class="col-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($album->songs as $song)
                    <tr>
                        <th scope="row">{{$song->id}}</th>
                        <td>{{$song->name}}</td>
                        <td>$ {{$song->cost}}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    @endforeach
@stop
