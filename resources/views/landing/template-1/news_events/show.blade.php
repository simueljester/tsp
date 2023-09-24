<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TSP - Technology Solutions Provider & Consultancy</title>

    {{-- Tab icon --}}
    <link rel="icon" href="{!! asset('images/symbol2.png') !!}"/>

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sen&display=swap" rel="stylesheet">

    {{-- Styles and Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    {{-- Slick --}}
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>

</head>

<body class="bg-white">

    <div class="bg-light sticky">
        @if(session()->has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="container p-4 ">
            <div>
                <a href="/" style="text-decoration: none;">
                    <strong> <img class="zoomIn" src="{{ asset('images') }}/symbol2.png" width="30"> <b class="text-muted">TSP</b> </strong>
                </a>
                <span class="float-right" >
                    <span class="ml-2"> <a href="/" class="text-dark" style="text-decoration: none;"> <i class="fa-solid fa-house"></i> Home </a>  </span>
                </span>
            </div>
        </div>
    </div>


    <div class="container mt-3 fadeIn">
        <nav aria-label="breadcrumb" style="z-index: 9999;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('list-news')}}">News & Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$news->name}}</li>
            </ol>
        </nav>
        <div class="mt-3">
            <img class="card-img-top border-custom" src="{{asset('images/icons').'/'.$news->thumbnail}}" style="max-height:500px;width:100%;object-fit: cover;">
        </div>
        <div class="mt-3">
            <h2> <strong style="color: rgb(255, 145, 0)"> {{$news->name}} </strong> </h2>
        </div>
        <div class="mt-3">
            <h6> <strong> {{$news->headline}} </strong> </h6>
        </div>
        <div>
            <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $news->published_at)->format('M d, Y')}} </small>
        </div>
        <div class="mt-3 mb-3" id="youtube-container">
            {!! $news->youtube_embed !!}
        </div>
        <div class="mt-3 p-3 bg-light border-custom news-description">
            {!! $news->description !!}
        </div>

    </div>
    @include('landing.template-1.footer')

    <style>

    </style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript">
    </script>

</body>
</html>
