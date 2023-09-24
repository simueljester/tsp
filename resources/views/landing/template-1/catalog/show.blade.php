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
                <span class="float-right" >
                    <span class="ml-2"> <a href="/" class="text-dark" style="text-decoration: none;"> <i class="fa-solid fa-house"></i> Home </a>  </span>
                </span>
            </div>
        </div>
    </div>


    <div id="mySidebar" class="sidebar shadow">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <strong class="p-3"> Categories </strong>
        @foreach ($categories as $category)
        <a href="{{'/service-list#'.$category->name.'Container' }}">{{$category->name}}</a>
        @endforeach
    </div>


    <div class="container mt-3 fadeIn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('list-catalog')}}">Services</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$service->name}}</li>
            </ol>
          </nav>
    </div>

    <div class="container mt-3 fadeIn">
        <div class="row">
            <div class="col-sm-9">
                <div class="card fadeIn border-custom " style="background: transparent;border:none;">
                    <div class="card-body">
                        <span class="h3"> <i class="{{$service->icon}}"></i> <strong> {{$service->name}} </strong>  </span>
                        @if ($service->type == 'service')
                            <span class="badge badge-pill badge-primary">Service</span>
                        @else
                            <span class="badge badge-pill badge-warning">For Sale</span>
                        @endif
                        @if ($averageReview > 0)
                            @for ($i = 1; $i <= $averageReview; $i++)
                                <i class="fa-solid fa-star text-warning"></i>
                            @endfor
                        @endif
                        <div class="p-2" >
                            <a href="#inquiryForm" style="color:rgba(247,136,32,1);text-decoration:none;" > <i class="fa-solid fa-pen-to-square"></i> Inquire </a> &nbsp
                            <a href="#reviewForm" style="color:rgba(247,136,32,1);text-decoration:none" > <i class="fa-solid fa-star-half-stroke"></i> Write a review </a>
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
                        <div class="row">
                            <div class="col-sm-6">
                                <form action="{{route('save-review')}}" method="post">
                                    @csrf
                                    <div class="mt-3 p-4 bg-light border-custom" id="reviewForm">
                                        <strong> Add Review </strong>
                                        <hr>
                                        <div class="form-group">
                                            <textarea required class="form-control border-custom bg-white" id="comment" name="comment" rows="5" style="background: transparent;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label> Name (optional) </label>
                                            <input type="text" name="commented_by" id="commented_by" class="form-control border-custom">
                                        </div>
                                        <div class="form-group">
                                            <label> Raring </label>
                                            <div class="rating">
                                                <span class="rating__result"></span>
                                                <i class="rating__star far fa-star"></i>
                                                <i class="rating__star far fa-star"></i>
                                                <i class="rating__star far fa-star"></i>
                                                <i class="rating__star far fa-star"></i>
                                                <i class="rating__star far fa-star"></i>
                                            </div>
                                        </div>

                                        <br>
                                        <input type="hidden" name="rating" id="rating">
                                        <input type="hidden" name="service_id" id="service_id" value="{{$service->id}}">
                                        <button class="btn btn-primary btn-sm"> Add Review </button>
                                    </div>
                                </form>

                                <form action="{{route('save-inquiry')}}" method="POST">
                                    @csrf
                                    <div class="mt-3 p-4 bg-light border-custom" id="inquiryForm">
                                        <strong> Inquire to this service </strong>
                                        <hr>
                                        <div class="form-group">
                                            <small class="text-muted"> Name: </small> <strong class="text-danger"> * </strong>
                                            <input type="text" name="name" id="name" class="form-control" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <small class="text-muted"> Email Address: </small> <strong class="text-danger"> * </strong>
                                                    <input type="email" name="email" id="email" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <small class="text-muted"> Contact #: </small> <strong class="text-danger"> * </strong>
                                                    <input type="text" name="contact" id="contact" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <small class="text-muted"> Inquiry: </small> <strong class="text-danger"> * </strong>
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                        <div>
                                            <input type="hidden" name="service_id" id="service_id" value="{{$service->id}}">
                                            <button class="btn btn-primary"> Send Inquiry </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-6">
                                @if ($service->reviews)
                                <div class="mt-3">
                                    <strong> Client's reviews about this service </strong>
                                    <hr>
                                </div>
                                @endif
                                @forelse ($service->reviews as $review)
                                    <div class="d-flex row">
                                        <div class="d-flex flex-column comment-section">
                                            <div class="bg-white p-2">
                                                <div class="d-flex flex-row user-info">
                                                    <img class="rounded-circle" src="{{ asset('images') }}/user.png" width="45" height="45">
                                                    <div class="d-flex flex-column justify-content-start ml-2">
                                                    <span class="d-block font-weight-bold name"> {{$review->commented_by}}
                                                        @for ($i = 1; $i <= (int)$review->rating; $i++)
                                                            <i class="fa-solid fa-star text-warning"></i>
                                                        @endfor
                                                    </span>
                                                    <span class="date text-black-50"><i class="fa-solid fa-earth-asia"></i> {{$review->created_at->format('M d, Y')}}</span>
                                                </div>
                                                </div>
                                                <div class="mt-2">
                                                    <p class="comment-text">{{$review->comment}}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <span class="text-muted"> No review yet </span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 p-3">
                @if ($service->articles->count() != 0)
                    <strong> Related Articles </strong>
                    <div class="p-3 bg-light border-custom mt-3">
                        @foreach ($service->articles as $article)
                            <div class="card fadeIn mt-3" style="background:transparent;border:none;">
                                <img src="{{asset('images/icons').'/'.$article->thumbnail}}" class="" style="width: 100%;height: 120px;object-fit:cover;border-radius:12px;">
                                <div class="card-body">
                                    <a href="{{route('page-landing-show-article',$article)}}" style="color: rgb(255, 145, 0)"> {{$article->name}} </a>
                                    <div class="text-muted char-article-limit">
                                        {!! substr(strip_tags($article->description),0,110) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
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

    .rating {
        position: relative;
        width: 180px;
        background: transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: .3em;
        padding: 5px;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 0 2px #b3acac;
    }

    .rating__result {
        position: absolute;
        top: 0;
        left: 0;
        transform: translateY(-10px) translateX(-5px);
        z-index: -9;
        font: 3em Arial, Helvetica, sans-serif;
        color: #ebebeb8e;
        pointer-events: none;
    }

    .rating__star {
        font-size: 1.3em;
        cursor: pointer;
        color: #dabd18b2;
        transition: filter linear .3s;
    }

    .rating__star:hover {
        filter: drop-shadow(1px 1px 4px gold);
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

    // Rating

    const ratingStars = [...document.getElementsByClassName("rating__star")];
    const ratingResult = document.querySelector(".rating__result");

    printRatingResult(ratingResult);

    function executeRating(stars, result) {
        const starClassActive = "rating__star fas fa-star";
        const starClassUnactive = "rating__star far fa-star";
        const starsLength = stars.length;
        let i;
        stars.map((star) => {
            star.onclick = () => {
                i = stars.indexOf(star);

                if (star.className.indexOf(starClassUnactive) !== -1) {
                    printRatingResult(result, i + 1);
                    for (i; i >= 0; --i) stars[i].className = starClassActive;
                } else {
                    printRatingResult(result, i);
                    for (i; i < starsLength; ++i) stars[i].className = starClassUnactive;
                }
            };
        });
    }

    function printRatingResult(result, num = 0) {
        // console.log(num);
        $('#rating').val(num)
    }

    executeRating(ratingStars, ratingResult);

    </script>

</body>
</html>
