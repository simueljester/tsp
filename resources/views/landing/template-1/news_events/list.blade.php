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
              <li class="breadcrumb-item" aria-current="page">News & Events</li>
            </ol>
        </nav>
        <h2> News & Events </h2>
        @if ($newsEvents->count() == 1) <!-- Layout if only 1 data-->
            <div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $newsEvents[0]->thumbnail) }}');
                                background-size: cover;height:400px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">
                                    <h6 class="card-title"> <strong> <a href="" style="text-decoration: none;" class="text-white"> {{$newsEvents[0]->headline}} </a> </strong> </h6>
                                    <p style="color: rgb(255, 145, 0)"> {{$newsEvents[0]->name}} </p>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $newsEvents[0]->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($newsEvents->count() == 2) <!-- Layout if only 2 data-->
            <div>
                <div class="row mt-3">
                    <div class="col-sm-6">
                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $newsEvents[0]->thumbnail) }}');
                                background-size: cover;height:400px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">
                                    <h6 class="card-title"> <strong> <a href="" style="text-decoration: none;" class="text-white"> {{$newsEvents[0]->headline}} </a> </strong> </h6>
                                    <p style="color: rgb(255, 145, 0)"> {{$newsEvents[0]->name}} </p>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $newsEvents[0]->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $newsEvents[1]->thumbnail) }}');
                                background-size: cover;height:400px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">
                                    <h6 class="card-title"> <strong> <a href="" style="text-decoration: none;" class="text-white"> {{$newsEvents[1]->headline}} </a> </strong> </h6>
                                    <p style="color: rgb(255, 145, 0)"> {{$newsEvents[1]->name}} </p>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $newsEvents[1]->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @elseif($newsEvents->count() == 3) <!-- Layout if only 3 data-->
            <div>
                <div class="row mt-3">
                    <div class="col-sm-6">
                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $newsEvents[0]->thumbnail) }}');
                                background-size: cover;height:500px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">
                                    <h6 class="card-title"> <strong> <a href="" style="text-decoration: none;" class="text-white"> {{$newsEvents[0]->headline}} </a> </strong> </h6>
                                    <p style="color: rgb(255, 145, 0)"> {{$newsEvents[0]->name}} </p>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $newsEvents[0]->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $newsEvents[1]->thumbnail) }}');
                                background-size: cover;height:250px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">
                                    <h6 class="card-title"> <strong> <a href="" style="text-decoration: none;" class="text-white"> {{$newsEvents[1]->headline}} </a> </strong> </h6>
                                    <p style="color: rgb(255, 145, 0)"> {{$newsEvents[1]->name}} </p>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $newsEvents[1]->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $newsEvents[2]->thumbnail) }}');
                                background-size: cover;height:250px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">
                                    <h6 class="card-title"> <strong> <a href="" style="text-decoration: none;" class="text-white"> {{$newsEvents[2]->headline}} </a> </strong> </h6>
                                    <p style="color: rgb(255, 145, 0)"> {{$newsEvents[2]->name}} </p>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $newsEvents[2]->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($newsEvents->count() > 3) <!-- Layout if more than 3 data-->
            <div>
                <div class="row mt-3">
                    <div class="col-sm-6">
                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $newsEvents[0]->thumbnail) }}');
                                background-size: cover;height:500px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">
                                    <h6 class="card-title"> <strong> <a href="" style="text-decoration: none;" class="text-white"> {{$newsEvents[0]->headline}} </a> </strong> </h6>
                                    <p style="color: rgb(255, 145, 0)"> {{$newsEvents[0]->name}} </p>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $newsEvents[0]->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $newsEvents[1]->thumbnail) }}');
                                background-size: cover;height:250px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">
                                    <h6 class="card-title"> <strong> <a href="" style="text-decoration: none;" class="text-white"> {{$newsEvents[1]->headline}} </a> </strong> </h6>
                                    <p style="color: rgb(255, 145, 0)"> {{$newsEvents[1]->name}} </p>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $newsEvents[1]->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $newsEvents[2]->thumbnail) }}');
                                background-size: cover;height:250px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">
                                    <h6 class="card-title"> <strong> <a href="" style="text-decoration: none;" class="text-white"> {{$newsEvents[2]->headline}} </a> </strong> </h6>
                                    <p style="color: rgb(255, 145, 0)"> {{$newsEvents[2]->name}} </p>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $newsEvents[2]->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-light border-custom">
                    @foreach ($newsEvents as $index => $news)
                        @switch($index)
                            @case(0)
                            @break
                            @case(1)
                            @break
                            @case(2)
                            @break
                            @default
                            <div class="card articles " style="border:none;cursor:pointer;background:transparent">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="card-hover-scale">
                                                <img src="{{asset('images/icons').'/'.$news->thumbnail}}" class="" style="width: 100%;height: 150px;object-fit:cover;border-radius:12px;">
                                            </div>
                                        </div>
                                        <div class="col-sm-9 text-left">
                                            <h6>
                                                <b>
                                                    <a href="#" style="color: rgb(255, 145, 0)"> {{$news->name}} </a>
                                                </b>
                                            </h6>
                                            <div>
                                                <i class="fa-solid fa-earth-asia"></i> Publication Date: {{$news->published_at->format('M d, Y')}}
                                            </div>
                                            <div class="text-muted char-article-limit">
                                                {{ substr(strip_tags($news->description),0,110) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endswitch
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-2">
            {!! $newsEvents->links() !!}
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
