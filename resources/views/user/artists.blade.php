@extends('layouts.style2')

@section('content')
    <h2>Artists</h2>
    <ul class="list-group">
        @foreach($artists as $item)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-6">
                            <a class="nav-link" href="{{route('user.albums', $item->id)}}">
                                {{$item->name}}
                            </a>
                        </div>
                        <div class="col-6">
                            @if(auth()->user()->artistsales->contains($item->id) )
                                <a class="btn btn-success" href="{{route('user.songs', $item->id)}}">
                                    songs
                                </a>
                            @else
                                <a class="btn btn-success" href="{{route('paymentDiscography', $item->id)}}">
                                    Discography: $ {{$item->cost}}
                                </a>
                            @endif

                        </div>
                    </div>
                </li>
        @endforeach
    </ul>
    <div class="mt-3">
        {{$artists->links()}}
    </div>
@stop
