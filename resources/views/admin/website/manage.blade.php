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
        <div class="square_box box_three"></div>
        <div class="square_box box_four"></div>

        <div class="card m-5 border-custom shadow" style="background:transparent">
            <div class="card-body">
                <a href="{{route('admin.my-website.index')}}">Back</a>
                <br>
                <h4 class="mt-3"> <i class="fa-solid fa-globe"></i> {{$my_website->name}} </h4>
                <div>
                    Manage contents of this current template
                </div>
                <div class="mt-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="{{route('admin.my-website.manage-content.intro',$my_website)}}" class="nav-link  {{Route::current()->getName() == 'admin.my-website.manage-content.intro' ? 'active' : '' }}" data-toggle="tab" role="tab"> Introduction </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.my-website.manage-content.services',$my_website)}}" class="nav-link  {{Route::current()->getName() == 'admin.my-website.manage-content.services' ? 'active' : '' }}" data-toggle="tab" role="tab"> Services </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.my-website.manage-content.articles',$my_website)}}" class="nav-link  {{Route::current()->getName() == 'admin.my-website.manage-content.articles' ? 'active' : '' }}" data-toggle="tab" role="tab"> Articles </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.my-website.manage-content.about',$my_website)}}" class="nav-link  {{Route::current()->getName() == 'admin.my-website.manage-content.about' ? 'active' : '' }}" data-toggle="tab" role="tab"> About </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.my-website.manage-content.news',$my_website)}}" class="nav-link  {{Route::current()->getName() == 'admin.my-website.manage-content.news' ? 'active' : '' }}" data-toggle="tab" role="tab"> News </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.my-website.manage-content.choose-us',$my_website)}}" class="nav-link  {{Route::current()->getName() == 'admin.my-website.manage-content.choose-us' ? 'active' : '' }}" data-toggle="tab" role="tab"> Choose Us </a>
                        </li>
                    </ul>
                    <div class="tab-content" style="background:transparent">
                        <div class="tab-pane active"  role="tabpanel">
                            <div class="p-3">
                                <div style="position: absolute; top:20; right:0;" class="text-right">
                                    @if(session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show fadeInDown close-alert" role="alert" style="z-index:1">
                                            <i class="fa-solid fa-circle-check fa-lg text-dark fa-beat-fade"></i>
                                            <span class="alert-text text-dark"><strong>Success!</strong> {{ session()->get('success') }} </span>
                                            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="closeAlert()">
                                                <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
                                            </button>
                                        </div>
                                    @endif
                                    @if(session()->has('error'))
                                        <div class="alert alert-warning alert-dismissible fade show fadeInDown close-alert" role="alert" style="z-index:1">
                                            <i class="fa-solid fa-triangle-exclamation fa-lg text-dark fa-beat-fade"></i>
                                            <span class="alert-text text-dark"><strong>Notice!</strong>  {{session()->get('error') }} </span>
                                            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="closeAlert()">
                                                <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
                                            </button>
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-warning alert-dismissible fade show fadeInDown close-alert" role="alert" style="z-index:1">
                                                <i class="fa-solid fa-triangle-exclamation fa-lg text-dark fa-beat-fade"></i>
                                                <span class="alert-text text-dark"><strong>Notice!</strong> {{$error}} </span>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="closeAlert()">
                                                    <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @yield('subcontent')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
function closeAlert(){
    $('.close-alert').hide()
}
</script>
