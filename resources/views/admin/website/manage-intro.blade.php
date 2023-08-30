@extends('admin.website.manage')

@section('subcontent')
<p class="m-3 text-muted">
   Select in the list of created introduction template. The selected list will be the introduction / front page of your website.
</p>
<div class="card p-3" style="border: none;background:transparent">
    <strong class="text-muted"> Available Resources ({{$introductions->count()}}) <small> <a href="{{route('admin.pages.introduction.create')}}"> Add New </a> </small> </strong>
    <div class="row">
        @forelse ($introductions as $intro)
            <div class="col-sm-3">
                <div class="card " style="border: none;background:transparent">
                    <div class="card-body">
                        <h4> <strong> <i class="fa-solid fa-cube"></i> {{$intro->title}} </strong> </h4>
                        <div class="mt-1">
                            <a style="color: #d20abe" href="javascript:;" onclick="previewIntro({{$intro}})"> Preview </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-sm-12">
                No records found.
            </div>
        @endforelse
    </div>
</div>

<div class="container-fluid mt-3 bg-white">
    <div class="row ml-3">
        <div class="col-sm-5 text-right mt-5">
            <div>
                <small> Logo Here </small>
            </div>
            <img style="top:50%" class="zoomIn" src=" {{ $activeIntro ? asset('images/icons').'/'.$activeIntro->logo : asset('images').'/symbol2.png'}}" width="280" id="logo">
        </div>
        <div class="col-sm-5 text-left mt-5">
            <h1 class="mt-5 fadeIn">
                <b id="title"> {{ $activeIntro ? $activeIntro->title : 'Title Here' }} </b>
                <p class="text-new-warning" style=" font-family: cursive;font-style: oblique;font-size:22px;" id="slogan"> {{ $activeIntro ? $activeIntro->slogan : 'Slogan Here' }} </p>
            </h1>
            <div class="text-muted fadeIn" id="description">
                @if ($activeIntro)
                    {!! $activeIntro->description !!}
                @else
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat. Sed porttitor lectus nibh. Sed porttitor lectus nibh.
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container-fluid p-4 bg-info text-center mt-3" style="background: rgb(247,172,32); background: linear-gradient(90deg, rgba(247,172,32,1) 0%, rgba(247,136,32,1) 94%);">
    <strong id="breaker"> {{ $activeIntro ? $activeIntro->breaker : 'Breaker Here' }} </strong>
</div>

<form action="{{route('admin.my-website.manage-content.save')}}" method="POST">
    @CSRF
    <div class="mt-3">
        <input type="hidden" name="website_id" id="website_id" value="{{$my_website->id}}">
        <input type="hidden" name="content_code" id="content_code" value="introduction">
        <input type="hidden" id="previewData" name="data" id="data" cols="30" rows="10" />
        <button id="saveIntro" class="btn btn-success btn-sm fadeIn"> Save Introduction </button>
    </div>
</form>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    $( document ).ready(function() {
      $('#saveIntro').hide()
    });

    function previewIntro(intro){
        $("#logo").attr("src", '/images/icons/' + intro.logo);
        $('#title').html(intro.title)
        $('#slogan').html(intro.slogan)
        $('#description').html(intro.description)
        $('#breaker').html(intro.breaker)
        $('#previewData').val(JSON.stringify(intro))
        $('#saveIntro').show()

    }

</script>

@endsection
