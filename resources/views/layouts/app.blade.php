<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TSP Administration</title>
     {{-- Tab icon --}}
    <link rel="icon" href="{!! asset('images/symbol2.png') !!}"/>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
        .text-custom{
            color: #F59732
        }
        .border-custom{
            border-radius: 12px;
        }
        
    </style>
</head>
<body class="bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="text-custom"> TSP - Technology Solutions Provider & Consultancy </span> 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                     
                            <a class="float-right text-dark" style="text-decoration: none;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-circle-user"></i> {{ Auth::user()->name }}
                            </a>
                            <a href="{{ route('logout') }}" style="text-decoration: none;"  class="float-right text-muted ml-3" 
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                       
                      
                        
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                 @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text"><strong>Success!</strong> {{ session()->get('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <strong>Notice!</strong>  {{session()->get('error') }}
                    </div>
                 @endif
                  @if ($errors->any())
                    @foreach ($errors->all() as $error)
                         <div class="alert alert-danger" role="alert">{{$error}}</div>
                    @endforeach
                @endif

                <div class="card shadow-sm border-custom">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{route('home')}}" style="text-decoration: none;" class="text-muted"> <i class="fa-solid fa-gauge"></i> Dashboard </a> 
                            <a href="{{route('page-admin.index')}}" style="text-decoration: none;" class="ml-2 text-muted"> <i class="fa-solid fa-globe"></i> Page </a> 
                            <a href="{{route('inquiry.index')}}" style="text-decoration: none;" class="ml-2 text-muted"> <i class="fa-solid fa-envelope-open-text"></i> Socials & Inquiries </a>
                            <a href="{{route('users.index')}}" style="text-decoration: none;" class="ml-2 text-muted"> <i class="fa-solid fa-users-gear"></i> Users </a> 
                        </div>
                        <hr>
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
