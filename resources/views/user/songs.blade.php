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
    @foreach($albums as $album)
        @if(count($album->songs) > 0)
        <div class="mt-5">
            <h2>{{$album->name}} - {{$album->artist->name}}</h2>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($album->songs as $item)
                        <div class="swiper-slide">
                            <h4 class="text-center bg-warning">{{$item->name}}</h4>
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
            {{--<table class="table table-striped">
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
            </table>--}}
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
