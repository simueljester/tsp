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
              <li class="breadcrumb-item" aria-current="page">Articles</li>
            </ol>
        </nav>
        <form action="">
            <div class="row">
                <div class="col-sm-10">
                    <div class="input-group mb-3 mt-3">
                        <input type="text" style="border-top-left-radius: 12px; border-bottom-left-radius:12px;" value="{{$keyword}}" class="form-control form-control-lg" name="keyword" id="keyword" placeholder="Search article">
                        <div class="input-group-append">
                            <button class="btn btn-success" style="border-top-right-radius: 12px; border-bottom-right-radius:12px;"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    @if ($keyword)
                        <div class="input-group-append mt-4">
                            <a href="{{route('list-article')}}" class="btn btn-outline-secondary border-custom"> Clear Keyword </a>
                        </div>
                    @endif
                </div>
            </div>
        </form>
        <h2> Articles </h2>
        <div class="row mt-3">
            @forelse ($articles as $article)
                <div class="col-sm-12">
                    <div class="card articles " style="border:none;background:transparent">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card-hover-scale">
                                        <a href="{{route('page-landing-show-article', $article)}}">
                                            <img src="{{asset('images/icons').'/'.$article->thumbnail}}" class="" style="width: 100%;height: 150px;object-fit:cover;border-radius:12px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-9 text-left">
                                    <h6>
                                        <b>
                                            <a href="{{route('page-landing-show-article', $article)}}" style="color: rgb(255, 145, 0)"> {{$article->name}} </a>
                                        </b>
                                    </h6>
                                    <div>
                                        <i class="fa-solid fa-earth-asia"></i> Publication Date: {{$article->created_at->format('M d, Y')}}
                                    </div>

                                    <div class="text-muted char-article-limit">
                                        {{ substr(strip_tags($article->description),0,110) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-sm-12">
                    <span class="text-muted"> No article found </span>
                </div>
            @endforelse
            <div class="mt-2">
                {!! $articles->links() !!}
            </div>

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
