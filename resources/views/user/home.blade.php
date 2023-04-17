@extends('layouts.style2')
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
    <div class="row">
        <div class="col">
            <h2>Find</h2>
            <form action="{{route('user.findMyArtist')}}" method="post">
                @csrf
                <div class="d-flex mb-3">
                    <div style="width: 70%">
                        <input type="text" class="form-control" placeholder="Artist Name" name="name">
                    </div>
                    <div style="width: 130px; margin-left: 5px">
                        <button type="submit" style="width: 120px" class="btn btn-primary">Find</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <h2>My Artist</h2>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($myArtists as $item)
                <div class="swiper-slide">
                    <h4 class="text-center bg-warning">{{$item->name}}</h4>
                    <a href="{{route('user.albumsArtist', $item->id)}}">
                        <img src="{{asset('/images/disco.jpg')}}" />
                    </a>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <hr class="my-5">

    <div class="row">
        <div class="col col-lg-9">
            <h2>Category</h2>
            <div class="d-flex mb-3">
                <div style="width: 130px">
                    <a class="btn btn-primary" style="width: 120px"  href="{{route('user.home')}}">All</a>
                </div>
                <div style="width: 130px">
                    <a class="btn btn-primary" style="width: 120px"  href="{{route('user.home', ['category' => 'Havy Metal'])}}">Havy Metal</a>
                </div>
                <div style="width: 130px">
                    <a class="btn btn-primary" style="width: 120px" href="{{route('user.home', ['category' => 'Pop'])}}">Pop</a>
                </div>
                <div style="width: 130px">
                    <a class="btn btn-primary" style="width: 120px" href="{{route('user.home', ['category' => 'Classic'])}}">Classic</a>
                </div>
                <div style="width: 130px">
                    <a class="btn btn-primary" style="width: 120px" href="{{route('user.home', ['category' => 'Jazz'])}}">Jazz</a>
                </div>
                <div style="width: 130px">
                    <a class="btn btn-primary" style="width: 120px" href="{{route('user.home', ['category' => 'Latino'])}}">Latino</a>
                </div>
                <div style="width: 130px">
                    <a class="btn btn-primary" style="width: 120px" href="{{route('user.home', ['category' => 'Rock'])}}">Rock</a>
                </div>
            </div>
        </div>
        <div class="col col-lg-3">
            <h2>Find</h2>
            <form action="{{route('user.findArtist')}}" method="post">
                @csrf
                <div class="d-flex mb-3">
                    <div style="width: 70%">
                        <input type="text" class="form-control" placeholder="Artist Name" name="name">
                    </div>
                    <div style="width: 130px; margin-left: 5px">
                        <button type="submit" style="width: 120px" class="btn btn-primary">Find</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <h2>Artist</h2>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($artists as $item)
                <div class="swiper-slide">
                    <h4 class="text-center bg-warning">{{$item->name}}  <span class="badge text-bg-primary">$ {{$item->cost}}</span></h4>
                    <a href="{{route('paymentAlbum', $item->id)}}">
                        <img src="{{asset('/images/disco.jpg')}}" />
                    </a>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
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
