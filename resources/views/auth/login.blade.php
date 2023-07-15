<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TSP Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}""/>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}""/>
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login"  method="POST" action="{{ route('login') }}">
                    @csrf
                    <img class="fadeIn" width="120" src="{{ asset('images') }}/tsp3.png"> 
                    <div class="login__field fadeIn">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" id="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="login__field fadeIn">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" id="password" name="password" placeholder="Password">
                    </div>
                    <button class="button login__submit fadeIn" type="submit">
                        <span class="button__text">Log In</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>				
                </form>
            
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>		
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>		
        </div>
    </div>
</body>
</html>
