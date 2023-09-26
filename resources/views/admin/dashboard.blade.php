@extends('layouts.app-soft-ui')

@section('content')
<div>
  <div class="card">
    <div class="card-body">
        <div>
            <h4 class="mt-3"> <i class="fa-solid fa-gauge"></i> Dashboard </h4>
        </div>
    </div>
  </div>


    <div class="row mt-3 mb-5">
        <div class="col-sm-9">
            @if ($activeWebsite && $activeIntro)
                <div class="card bg-gradient-primary" style="">
                    <div class="card-body">
                        <div>
                            <strong class="text-white"> {{$activeWebsite->name}} </strong> <i class="fa-solid fa-circle text-success fa-sm"></i>
                        </div>
                        <center>
                            <div>
                                <img style="top:50%" class="zoomIn" src=" {{ $activeIntro ? asset('images/icons').'/'.$activeIntro->logo : asset('images').'/symbol2.png'}}" width="150" id="logo">
                            </div>
                            <div>
                                <strong class="text-white"> {{$activeIntro->title}} </strong>
                            </div>
                            <a href="{{route('admin.my-website.index')}}" class="text-info"> Manage </a>
                        </center>

                    </div>
                </div>
            @else
            <div class="card">
                <div class="card-body">
                    <div>
                        no active website
                    </div>
                </div>
            </div>
            @endif

            <div class="row mt-3">
                <div class="col-sm-4">
                    <a href="{{route('admin.inquiry.index')}}">
                        <div class="card text-center">
                            <div class="card-body">
                                <strong> <i class="fa-solid fa-envelope"></i> Unread Inquiries </strong>
                                <h3> <strong> {{$unreadInquiry}} </strong> </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.inquiry.index')}}">
                        <div class="card text-center">
                            <div class="card-body">
                                <strong> <i class="fa-solid fa-star-half-stroke"></i> Unread Reviews </strong>
                                <h3> <strong> {{$unreadInquiry}} </strong> </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('admin.pages.articles.index')}}">
                        <div class="card text-center">
                            <div class="card-body">
                                <strong> <i class="fa-regular fa-newspaper"></i> Articles </strong>
                                <h3 class="float-right"> <strong> {{$articles}} </strong> </h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        test
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
