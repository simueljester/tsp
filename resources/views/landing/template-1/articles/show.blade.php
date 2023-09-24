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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('list-article')}}">Articles</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$article->name}}</li>
            </ol>
        </nav>
        <div class="row mt-2">
            <div class="col-sm-8">
                <div class="mt-3">
                    <img class="card-img-top border-custom" src="{{asset('images/icons').'/'.$article->thumbnail}}" style="max-height:500px;width:100%;object-fit: cover;">
                </div>
                <div class="mt-3">
                    <h2> <strong> {{$article->name}} </strong> </h2>
                </div>
                <div>
                    <i class="fa-solid fa-earth-asia"></i> Publication Date: {{$article->published_at->format('M d, Y')}}
                </div>
                <div class="mt-3 p-3 bg-light border-custom">
                    {!! $article->description !!}
                </div>
            </div>
            @if ($article->service)
                <div class="col-sm-4 ">
                    <div class="sticky-service">
                        <br>
                        <strong> Related Service </strong>
                        <div class="p-4 bg-white border-custom mt-3">
                            <a href="{{route('page-landing-show-service',$article->service)}}" style="text-decoration: none;">
                                <div class="d-flex m-1 h-100 border-custom serviceCard" >
                                    <div class="d-flex flex-column">
                                        <div class=" p-3">
                                            <div class="d-flex flex-row user-info">
                                                <h1> <i class="{{$article->service->icon}}" style="color:rgba(247,136,32,1)" id="showicon"></i> </h1>
                                                <div class="d-flex flex-column justify-content-start ml-2">
                                                    <span class="d-block font-weight-bold name" style="color:rgba(247,136,32,1)"> {{$article->service->name}} </span>
                                                </div>
                                            </div>
                                            <div class="text-muted char-limit text-left">
                                                <small> {!! $article->service->description_clean !!} </small>
                                            </div>
                                            <div class="mt-3">
                                                @if ($averageReview > 0)
                                                    @for ($i = 1; $i <= $averageReview; $i++)
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
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
