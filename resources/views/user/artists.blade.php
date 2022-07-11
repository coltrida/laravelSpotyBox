@extends('layouts.style2')

@section('content')
    <h2>Artists</h2>
    <ul class="list-group">
        @foreach($artists as $item)
            <a class="nav-link" href="{{route('user.albums', $item->id)}}">
                <li class="list-group-item">{{$item->name}}</li>
            </a>
        @endforeach
    </ul>
    <div class="mt-3">
        {{$artists->links()}}
    </div>
@stop
