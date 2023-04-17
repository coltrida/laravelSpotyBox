@extends('layouts.styleArtist')

@section('content')
    <h2>Artist Home</h2>

    <form class="row g-3" method="post" action="{{route('artist.insertAlbum')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="artist_id" value="{{$artist->id}}">
        <input type="hidden" name="cost" value="4.99">
        <div class="col-3">
            <input type="text" class="form-control" id="name" placeholder="Name Album" name="name">
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

        <div class="col text-end">
            <span class="badge p-3 text-bg-secondary">
                Tot Sales: {{($artist->albums->sum('albumsales_count'))}}
            </span>

        </div>
    </form>


            <div class="mt-5">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" class="col-4">Name</th>
                        <th scope="col" class="col-2">Cost</th>
                        <th scope="col" class="col-2">Cover</th>
                        <th scope="col" class="col-2 text-center">Nr. Songs</th>
                        <th scope="col" class="col-2 text-center">Sales</th>
                        <th scope="col" class="col-2 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($artist->albums as $album)
                        <tr>
                            <td style="vertical-align: middle">{{$album->name}}</td>
                            <td style="vertical-align: middle">$ {{$album->cost}}</td>
                            <td style="vertical-align: middle"><img src="{{$album->pathaws}}" width="100" alt=""></td>
                            <td style="vertical-align: middle" class="text-center">{{$album->songs_count}}</td>
                            <td style="vertical-align: middle" class="text-center">{{$album->albumsales_count}}</td>
                            <td style="vertical-align: middle">
                                <div class="d-flex justify-content-around">
                                    <div>
                                        <a class="btn btn-success" href="{{route('artist.album.songs', $album->id)}}" title="view songs">
                                            <i class="fa-solid fa-music"></i>
                                        </a>
                                    </div>

                                    {{--<div>
                                        <form action="{{route('artist.deleteAlbum', $album->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="delete album and songs">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>--}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

@endsection
