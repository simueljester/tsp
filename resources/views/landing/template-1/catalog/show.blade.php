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
                <button id="openNv" class="btn" style="background: transparent; border:none;color:rgba(247,136,32,1);" onclick="toggleNav()"><i class="fa-solid fa-bars"></i></button>
                <span class="float-right">
                    <span> Home </span>
                    <span class="ml-2"> Services </span>
                    <span class="ml-2"> About </span>
                    <span class="ml-2"> Gallery </span>
                    <span class="ml-2"> Contact </span>
                </span>
            </div>
        </div>
    </div>


    <div id="mySidebar" class="sidebar shadow">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <strong class="p-3"> Categories </strong>
        @foreach ($categories as $category)
            <a href="#">{{$category->name}}</a>
        @endforeach
    </div>

    <div class="container mt-3 fadeIn">
        <div class="square_box box_three"></div>
        <div class="square_box box_four"></div>
        <div class="input-group mb-3 mt-3">
            <input type="text" style="border-top-left-radius: 12px; border-bottom-left-radius:12px;" class="form-control form-control-lg" placeholder="Search service" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-success" style="border-top-right-radius: 12px; border-bottom-right-radius:12px;" type="button"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
            </div>
        </div>
    </div>

    <div class="m-5">
        <div class="row">
            <div class="col-sm-3 p-3">
                <strong> Client's reviews about this service </strong>
            </div>
            <div class="col-sm-6">
                <div class="card fadeIn border-custom " style="background: transparent;border:none;">
                    <div class="card-body">
                        <span class="h3"> <i class="{{$service->icon}}"></i> <strong> {{$service->name}} </strong>  </span>
                        @if ($service->type == 'service')
                            <span class="badge badge-pill badge-primary">Service</span>
                        @else
                            <span class="badge badge-pill badge-warning">For Sale</span>
                        @endif

                        <div class="p-2" >
                            <a href="#" style="color:rgba(247,136,32,1);text-decoration:none;" > <i class="fa-solid fa-pen-to-square"></i> Inquire </a> &nbsp
                            <a href="#" style="color:rgba(247,136,32,1);text-decoration:none" > <i class="fa-solid fa-star-half-stroke"></i> Write a review </a>
                        </div>
                        @if ($service->multimedia)
                        <div>
                            <div class="mt-2">
                                <div class="single-item">
                                    @foreach (json_decode($service->multimedia,true) as $media)
                                    <div class="card-hover-scale" style="cursor: pointer;" onclick="viewGallery({{json_encode($media)}})">
                                        <img class="card-img-top border-custom" src="{{asset('/images/dropzone').'/'.$media}}" style="max-height:500px;width:100%;object-fit: cover;">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <div>
                            @foreach ($service->tags as $tag)
                            <span class="badge badge-pill badge-light p-2">{{$tag}}</span>
                            @endforeach
                        </div>
                        <div class="mt-5">
                            {!! $service->description !!}
                        </div>
                        <hr>

                    </div>
                </div>
            </div>
            @if ($service->articles->count() != 0)
                <div class="col-sm-3 p-3">
                    <strong> Related Articles </strong>
                    <div class="p-3 bg-light border-custom mt-3">
                        @foreach ($service->articles as $article)
                        <div class="card articles " style="border:none;cursor:pointer;background:transparent">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card-hover-scale">
                                            <img src="{{asset('images/icons').'/'.$article->thumbnail}}" class="" style="width: 100%;height: 150px;object-fit:cover;border-radius:12px;">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-left">
                                        <h6>
                                            <b>
                                                <a href="#" target="_blank" style="color: rgb(255, 145, 0)"> {{$article->name}} </a>
                                            </b>
                                        </h6>
                                        <div class="text-muted char-article-limit">
                                            {!! substr(strip_tags($article->description),0,110) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

    @include('landing.template-1.footer')

<style>
    .sidebar {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background: rgb(247,172,32);
        background: linear-gradient(90deg, rgba(247,172,32,1) 0%, rgba(247,136,32,1) 94%);
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        border-top-right-radius:12px;
        border-bottom-right-radius:12px;
    }

    .sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        color: #222020;
        display: block;
        transition: 0.3s;
    }

    .sidebar a:hover {
        color: #f1f1f1;
    }

    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    .serviceCard{
        transition: transform 500ms;
        cursor: pointer;
    }
    .serviceCard:hover {
        transform: scale(1.1);
    }


/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript">

    var data = {!! $categories->toJson() !!}; // from controller

    // Toogle
    var toogleVal = 1;


    function toggleNav(){

        if(toogleVal == 1){
            document.getElementById("mySidebar").style.width = "250px";
            toogleVal = 0
        }else{
            document.getElementById("mySidebar").style.width = "0";
            toogleVal = 1
        }
    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        toogleVal = 1
    }

    function getData(){

    }

    // Slick

    $('.single-item').slick({
        autoplay:true,
        arrows:true,
        fade:true,
        adaptiveHeight: true,
        dots: true,
        nextArrow:'<button type="button" class="btn btn-lg mt-3" style="background:transparent"> Next <i class="fa-solid fa-circle-chevron-right" style="color: #ff9100;"></i> </button>',
    });

    </script>

</body>
</html>
