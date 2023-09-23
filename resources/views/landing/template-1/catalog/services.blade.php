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
        {{-- <div class="square_box box_three"></div>
        <div class="square_box box_four"></div> --}}
        <nav aria-label="breadcrumb" style="z-index: 9999;">
            <ol class="breadcrumb">
              <li class="breadcrumb-item" aria-current="page">Catalog</li>
            </ol>
        </nav>
        <form action="">
            <div class="row">
                <div class="col-sm-10">
                    <div class="input-group mb-3 mt-3">
                        <input type="text" style="border-top-left-radius: 12px; border-bottom-left-radius:12px;" value="{{$keyword}}" class="form-control form-control-lg" name="keyword" id="keyword" placeholder="Search service">
                        <div class="input-group-append">
                            <button class="btn btn-success" style="border-top-right-radius: 12px; border-bottom-right-radius:12px;"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    @if ($keyword)
                        <div class="input-group-append mt-4">
                            <a href="{{route('list-catalog')}}" class="btn btn-outline-secondary border-custom"> Clear Keyword </a>
                        </div>
                    @endif
                </div>
            </div>
        </form>

        @forelse ($grouped as $key => $group)
            <div class="mt-5">
                <h3> <strong class="text-muted"> {{$categories[$key]->name}} </strong> </h3>
                <hr>
                <div class="row" id="dataRow">
                    @foreach ($group as $service)
                        <div class="col-sm-6 mt-3">
                            <a href="{{route('page-landing-show-service',$service)}}" style="text-decoration: none;">
                                <div class="d-flex m-1 h-100 border-custom serviceCard" >
                                    <div class="d-flex flex-column">
                                        <div class=" p-3">
                                            <div class="d-flex flex-row user-info">
                                                <h1> <i class="{{$service->icon}}" style="color:rgba(247,136,32,1)" id="showicon"></i> </h1>
                                                <div class="d-flex flex-column justify-content-start ml-2">
                                                <span class="d-block font-weight-bold name text-dark"> {{$service->name}} </span>
                                                <span class="date text-black-50">
                                                    @if ($service->type == 'service')
                                                        <span class="badge badge-pill badge-primary">Service</span>
                                                    @else
                                                        <span class="badge badge-pill badge-warning">For Sale</span>
                                                    @endif
                                                </span>
                                            </div>
                                            </div>
                                            <div class="text-muted char-limit text-left">
                                                <small> {!! $service->description_clean !!} </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    @endforeach
                </div>
            </div>
            @empty

            <div class="flex-container">
                <div class="inner-element" style="margin: 180px;">


                    <center>
                        <i class="fa-solid fa-magnifying-glass fa-10x text-muted"></i>
                        <h2 class="text-muted"> No services found </h2>
                    </center>
                </div>
            </div>

        @endforelse
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

.flex-container{
  display: -webkit-box;  /* OLD - iOS 6-, Safari 3.1-6, BB7 */
  display: -ms-flexbox;  /* TWEENER - IE 10 */
  display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
  display: flex;         /* NEW, Spec - Firefox, Chrome, Opera */

  justify-content: center;
  align-items: center;

  width: 100%;
  height: 100%;
}

</style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript">



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




    </script>

</body>
</html>
