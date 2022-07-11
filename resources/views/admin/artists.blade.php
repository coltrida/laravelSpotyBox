@extends('dashboard')
@section('title', 'Artists')
@section('content')
    <form class="row g-3" method="post" action="{{route('insertArtist')}}">
        @csrf
        <div class="col-6">
            <label for="name" class="visually-hidden">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
        </div>
        <div class="col-2">
            <label for="cost" class="visually-hidden">Cost</label>
            <input type="number" step="0.1" class="form-control" placeholder="Cost Discos $" id="cost" name="cost">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Insert Artist</button>
        </div>
    </form>

    <table class="table table-striped mt-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Nr. Albums</th>
            <th scope="col">Cost Discography</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($artists as $artist)
            <tr>
                <th scope="row">{{$artist->id}}</th>
                <td>{{$artist->name}}</td>
                <td>{{$artist->albums_count}}</td>
                <td>$ {{$artist->cost}}</td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
