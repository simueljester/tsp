@extends('layouts.app-soft-ui')
@section('content')

<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-earth-asia"></i> News </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.news.index')}}"> List</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><strong> {{$news->name}} </strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card mt-3 fadeIn">
        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
            <a href="javascript:;" class="d-block mb-3">
                <img id="outputImage" src="{{asset('images/icons').'/'.$news->thumbnail}}" class="border-custom" style="width: 180px;height:150px;object-fit:contain" />
            </a>
            <h2>
                @if ($news->is_featured == 1)
                    <i class="fa-solid fa-star text-primary"></i>
                @endif
                {{$news->name}}
            </h2>
            <p class="card-description mb-4">
                {{$news->headline}}
            </p>
            <div>
                @if ($news->published_at)
                    <span class="badge badge-pill bg-gradient-success">Published</span>
                @endif
                @if ($news->is_featured == 1)
                    <span class="badge badge-pill bg-gradient-primary">Featured</span>
                @endif
                <strong> {{$news->created_at->format('M d, Y')}} </strong>
            </div>
        </div>
        <div class="card-body pt-2">
            {!! $news->description !!}

        </div>
        <div class="card-footer bg-light">
            <a href="{{route('admin.pages.news.edit',$news)}}" class="btn btn-info btn-sm">
                Edit
            </a>
            <a href="{{route('admin.pages.news.index')}}" class="btn btn-outline-secondary btn-sm">
                Back to list
            </a>
        </div>
      </div>

</div>

<style>

</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

</script>

@endsection

