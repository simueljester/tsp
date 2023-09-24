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
<body class="bg-light">
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
        <div class="container p-5">
            <div>
                <a href="/" style="text-decoration: none;">
                    <strong> <img class="zoomIn" src="{{ asset('images') }}/symbol2.png" width="30"> <b class="text-muted">TSP</b> </strong>
                </a>
                <button id="openNv" class="btn float-right" style="background: transparent; border:none;color:rgba(247,136,32,1);" onclick="toggleNav()"><i class="fa-solid fa-bars"></i></button>
                <span class="float-right" id="nav-content-desktop">
                    <span class="ml-2"> <a href="{{route('list-catalog')}}" class="text-dark" style="text-decoration: none;"> Services </a>  </span>
                    <span class="ml-2"> <a href="#containerArticles" class="text-dark" style="text-decoration: none;"> Articles </a> </span>
                    <span class="ml-2"> <a href="#containerAboutEvents" class="text-dark" style="text-decoration: none;"> About </a> </span>
                    <span class="ml-2"> <a href="#containerAboutEvents" class="text-dark" style="text-decoration: none;"> News & Events </a> </span>
                    <span class="ml-2"> <a href="#containerChooseUs" class="text-dark" style="text-decoration: none;"> Why Choose Us </a> </span>
                    <span class="ml-2"> <a href="#containerContact" class="text-dark" style="text-decoration: none;"> Contact </a> </span>
                </span>
            </div>
        </div>
    </div>

    <div id="mySidebar" class="sidebar shadow">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <span class="ml-2"> <a href="{{route('list-catalog')}}" class="text-white" style="text-decoration: none;"> Services </a>  </span>
        <span class="ml-2"> <a href="#containerArticles" class="text-white" style="text-decoration: none;"> Articles </a> </span>
        <span class="ml-2"> <a href="#containerAboutEvents" class="text-white" style="text-decoration: none;"> About </a> </span>
        <span class="ml-2"> <a href="#containerAboutEvents" class="text-white" style="text-decoration: none;"> News & Events </a> </span>
        <span class="ml-2"> <a href="#containerChooseUs" class="text-white" style="text-decoration: none;"> Why Choose Us </a> </span>
        <span class="ml-2"> <a href="#containerContact" class="text-white" style="text-decoration: none;"> Contact </a> </span>
    </div>

    @include('landing.template-1.intro')
    @include('landing.template-1.service')
    @include('landing.template-1.articles')
    @include('landing.template-1.about-events')
    @include('landing.template-1.choose-us')
    @include('landing.template-1.contact')
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
    $(document).ready(function(){
        // Slick Start
        $('.single-item').slick({
            autoplay:true,
            arrows:true,
            fade:true,
            adaptiveHeight: true,
            dots: true,
            nextArrow:'<button type="button" class="btn btn-lg mt-3" style="background:transparent"> Next <i class="fa-solid fa-circle-chevron-right" style="color: #ff9100;"></i> </button>',
        });

        $('.slick-center').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 3,
            dots: true,
            arrows:true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.slider-single').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: false,
            adaptiveHeight: true,
            infinite: false,
            useTransform: true,
            speed: 400,
            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        });

    $('.slider-nav')
 	.on('init', function(event, slick) {
 		$('.slider-nav .slick-slide.slick-current').addClass('is-active');
 	})
 	.slick({
 		slidesToShow: 7,
 		slidesToScroll: 7,
 		dots: false,
 		focusOnSelect: false,
 		infinite: false,
 		responsive: [{
 			breakpoint: 1024,
 			settings: {
 				slidesToShow: 5,
 				slidesToScroll: 5,
 			}
 		}, {
 			breakpoint: 640,
 			settings: {
 				slidesToShow: 4,
 				slidesToScroll: 4,
			}
 		}, {
 			breakpoint: 420,
 			settings: {
 				slidesToShow: 3,
 				slidesToScroll: 3,
		    }
 		}]
 	});

    $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
        $('.slider-nav').slick('slickGoTo', currentSlide);
        var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
        $('.slider-nav .slick-slide.is-active').removeClass('is-active');
        $(currrentNavSlideElem).addClass('is-active');
    });

    $('.slider-nav').on('click', '.slick-slide', function(event) {
        event.preventDefault();
        var goToSingleSlide = $(this).data('slick-index');

        $('.slider-single').slick('slickGoTo', goToSingleSlide);
    });
        // Slick End


    });

    $(window).on('scroll', function (e) {
        var top = $(window).scrollTop() + $(window).height(),
        isVisibleArticles = top > $('.articles').offset().top;
        $('.articles').toggleClass('fadeIn', isVisibleArticles);
    });

    $(window).on('scroll', function (e) {
        var top = $(window).scrollTop() + $(window).height(),
        isVisibleChoose = top > $('.choose-item').offset().top;
        $('.choose-item').toggleClass('zoomIn', isVisibleChoose);
    });


    $(window).on('scroll', function (e) {
        var top = $(window).scrollTop() + $(window).height(),
        isVisibleChoose = top > $('.about-image').offset().top;
        $('.about-image').toggleClass('fadeIn', isVisibleChoose);
    });

    $(window).on('scroll', function (e) {
        var top = $(window).scrollTop() + $(window).height(),
        isVisibleChoose = top > $('.contact').offset().top;
        $('.contact').toggleClass('fadeIn', isVisibleChoose);
    });


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


</script>
</body>
</html>
