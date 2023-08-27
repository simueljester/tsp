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
<body>
    <div>
        <div class="card fadeIn m-5 border-custom shadow">
            <div class="card-body">
                <div>
                    <h4 class="mt-3"> <i class="fa-solid fa-globe"></i> My Website </h4>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.my-website.index')}}">List</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> <strong> Manage {{$my_website->name}} </strong></li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="#" method="POST">
            @csrf
            <div class="card fadeIn m-5 border-custom shadow">
                <div class="card-body">


                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">First Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Second Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Third Panel</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <p>First Panel</p>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <p>Second Panel</p>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <p>Third Panel</p>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-9">
                            <div class="container-fluid bg-light p-5 mb-5">
                                <div class="row ml-3">
                                    <div class="col-sm-5 text-right mt-5">
                                        <div>
                                            <small> Logo Here </small>
                                        </div>
                                        <img class="zoomIn" src="{{ asset('images') }}/symbol2.png" width="280">
                                    </div>
                                    <div class="col-sm-5 text-left mt-5">
                                        <h1 class="mt-5 fadeIn">
                                            <b> Title Here </b>
                                            <p class="text-new-warning" style=" font-family: cursive;font-style: oblique;font-size:22px;"> Slogan here </p>
                                        </h1>
                                        <p class="text-muted fadeIn">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat. Sed porttitor lectus nibh. Sed porttitor lectus nibh.
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid p-4 bg-info text-center mt-5" style="background: rgb(247,172,32);
                            background: linear-gradient(90deg, rgba(247,172,32,1) 0%, rgba(247,136,32,1) 94%);">
                                <strong> Breaker Here </strong>
                            </div>

                        </div>
                        <div class="col-sm-3">

                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</body>
</html>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-ck-editor')
<script>

</script>
