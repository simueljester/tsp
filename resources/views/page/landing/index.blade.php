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
 <link rel="stylesheet" href="{{ asset('css/main.css') }}""/>

</head>
<body class="bg-light">
    <div class="bg-light sticky">
        <div class="container p-4 ">
            <div>
                <a href="/homepage" style="text-decoration: none;">
                    <strong> <img class="zoomIn" src="{{ asset('images') }}/symbol2.png" width="30"> <b class="text-muted">TSP</b> </strong>
                </a>
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


    @include('page.landing.intro')
    @include('page.landing.service')
    @include('page.landing.articles')
    {{-- @include('page.landing.brands') --}}
    @include('page.landing.about')
    @include('page.landing.choose-us')
    @include('page.landing.contact')
    @include('page.landing.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.single-item').slick({
            autoplay:true,
            arrows:false,
            fade:true,
            adaptiveHeight: true,
            dots: true,
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
     

        $('.single-item').slick({
            autoplay:true,
            fade:true,
            adaptiveHeight: true,
            dots: true,
        });
    });

    $(window).on('scroll', function (e) {
        var top = $(window).scrollTop() + $(window).height(),
        isVisibleArticles = top > $('.articles').offset().top;
        $('.articles').toggleClass('fadeInDown', isVisibleArticles);
    });

    $(window).on('scroll', function (e) {
        var top = $(window).scrollTop() + $(window).height(),
        isVisibleChoose = top > $('.choose-item').offset().top;
        $('.choose-item').toggleClass('zoomIn', isVisibleChoose);
    });

</script>
</body>
</html>