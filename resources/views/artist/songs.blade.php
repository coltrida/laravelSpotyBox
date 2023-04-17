@extends('layouts.styleArtist')
@section('header')
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />

    <style>
        html,
        body {
            position: relative;
            height: 100%;
        }

        .swiper {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 300px;
            height: 350px;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
        }
    </style>
@stop

@section('content')
    <div class="row mb-5 align-items-center">
        <div class="col text-center" style="vertical-align: middle">
            <img src="{{$albums[0]->pathaws}}" width="200" alt="">
        </div>
        <div class="col text-center">
            <h2>{{$albums[0]->name}}</h2>
        </div>
    </div>


    <form class="row g-3" method="post" action="{{route('artist.album.insertSong')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="album_id" value="{{$albums[0]->id}}">
        <div class="col-3">
            <input type="text" class="form-control" id="name" placeholder="Name Song" name="name">
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
        <div class="col">
            <div class="float-end">
                <a style="width: 120px" href="{{route('user.home')}}" class="btn btn-warning">Back</a>
            </div>

        </div>
    </form>

    @foreach($albums as $album)
        @if(count($album->songs) > 0)
        <div class="mt-5">
            <h2>{{$album->name}} - {{$album->artist->name}}</h2>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($album->songs as $item)
                        <div class="swiper-slide">
                            <h4 class="text-center bg-warning">{{$item->name}}  <span class="badge text-bg-primary">$ {{$item->cost}}</span></h4>
                                <img src="{{asset('/images/disco.jpg')}}" />
                            <audio
                                controls
                                src="{{$item->play}}">
                            </audio>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        @endif
    @endforeach
@stop

@section('footer')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            keyboard: {
                enabled: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@stop
