@extends('dashboard')
@section('title', 'Songs')
@section('content')
    <form class="row g-3" method="post" action="{{route('insertSong')}}" enctype="multipart/form-data">
        @csrf
        <div class="col-3">
            <input type="text" class="form-control" id="name" placeholder="Name Song" name="name">
        </div>
        <div class="col-2">
            <select class="form-select" aria-label="Default select example" name="album_id" id="album_id" >
                <option value="">album</option>
                @foreach($albums as $album)
                    <option value="{{$album->id}}" {{count($albums) == 1 ? 'selected' : '' }}>{{$album->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-1">
            <input type="number" step="0.1" class="form-control" id="cost" placeholder="cost" name="cost">
        </div>
        <div class="col-3">
            <div class="input-group mb-3">
                <label class="input-group-text" for="music">music</label>
                <input type="file" class="form-control" id="music" name="music" accept="audio/*">
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" id="button" class="btn btn-primary">Insert</button>
        </div>
    </form>

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
                            <form action="{{route('deleteSong', $song->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="delete song">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    @endforeach
@stop
