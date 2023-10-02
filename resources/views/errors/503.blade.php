<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TSP - Under Maintenance </title>
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
    <div class="flex-container">
        <div class="inner-element p-5">
            <center>
                <h1>
                    <i class="fa-regular fa-face-sad-cry fa-fade fa-2xl"></i>
                    <div class="mt-3"> Service Unavailable </div>
                </h1>
            </center>

            <br>
            <p>Oops! We're sorry, but the service you're trying to access is temporarily unavailable due to
                <strong> maintenance </strong> or <strong> high traffic </strong>. Please try again later.
            </p>
            <p>Our team is working hard to restore it as quickly as possible. We apologize for any inconvenience this may have caused.</p>
            <p>If you need immediate assistance, please contact our support team at <strong>tsp.consult2021@gmail.com</strong>.</p>
        </div>
      </div>

</body>

<style>
    .flex-container{
        display: -webkit-box;  /* OLD - iOS 6-, Safari 3.1-6, BB7 */
        display: -ms-flexbox;  /* TWEENER - IE 10 */
        display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
        display: flex;         /* NEW, Spec - Firefox, Chrome, Opera */
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 800px;
        background: rgb(247,172,32);
        background: linear-gradient(90deg, rgba(247,172,32,1) 0%, rgba(247,136,32,1) 94%);
        color: rgb(52, 52, 52);
    }

</style>
</html>
