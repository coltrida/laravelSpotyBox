@extends('dashboard')
@section('title', 'Albums')
@section('content')
    <form class="row g-3" method="post" action="{{route('insertAlbum')}}" enctype="multipart/form-data">
        @csrf
        <div class="col-3">
            <input type="text" class="form-control" id="name" placeholder="Name Album" name="name">
        </div>
        <div class="col-2">
            <select class="form-select" aria-label="Default select example" name="artist_id">
                <option value="">Artist</option>
                @foreach($artists as $artist)
                    <option value="{{$artist->id}}">{{$artist->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-1">
            <input type="number" step="0.1" class="form-control" id="cost" placeholder="cost" name="cost">
        </div>
        <div class="col-4">
            <div class="input-group mb-3">
                <label class="input-group-text" for="cover">Cover</label>
                <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Insert Album</button>
        </div>
    </form>

    @foreach($artists as $artist)
        @if(count($artist->albums) > 0)
        <div class="mt-5">
            <h2>{{$artist->name}}</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col" class="col-1">#</th>
                    <th scope="col" class="col-3">Name</th>
                    <th scope="col" class="col-2">Cost</th>
                    <th scope="col" class="col-2">Cover</th>
                    <th scope="col" class="col-2 text-center">Nr. Songs</th>
                    <th scope="col" class="col-2 text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($artist->albums as $album)
                    <tr>
                        <th style="vertical-align: middle" scope="row">{{$album->id}}</th>
                        <td style="vertical-align: middle">{{$album->name}}</td>
                        <td style="vertical-align: middle">$ {{$album->cost}}</td>
                        <td style="vertical-align: middle"><img src="{{$album->pathaws}}" width="100" alt=""></td>
                        <td style="vertical-align: middle" class="text-center">{{$album->songs_count}}</td>
                        <td style="vertical-align: middle">
                            <div class="d-flex justify-content-around">
                                <div>
                                    <a class="btn btn-success" href="{{route('admin.songs', $album->id)}}" title="view songs">
                                        <i class="fa-solid fa-music"></i>
                                    </a>
                                </div>

                                <div>
                                    <form action="{{route('deleteAlbum', $album->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="delete album and songs">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    @endforeach
@stop
