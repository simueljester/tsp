@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-regular fa-newspaper"></i> Articles </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.pages.articles.index')}}">List</a></li>
                    <li class="breadcrumb-item active"> <strong> Show </strong> </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card fadeIn mt-3">
        <div class="card-header">
            <img id="outputImage" src="{{asset('images/icons').'/'.$article->thumbnail}}" class="border-custom " style="width: 180px;height:150px;object-fit:contain" />
            <h2 class="mt-3"> {{$article->name}} </h2>
            <div>

                @if ($article->published_at)
                    <span class="badge badge-pill bg-gradient-success">Published</span>
                @endif
                @if ($article->is_featured == 1)
                    <span class="badge badge-pill bg-gradient-primary">Featured</span>
                @endif
                <strong> {{$article->created_at->format('M d, Y')}} </strong>
            </div>
        </div>
        <div class="card-body">
            {!! $article->description !!}
        </div>
        <div class="card-footer bg-light">
            <a href="{{route('admin.pages.articles.edit',$article)}}" class="btn btn-info btn-sm">
                Edit
            </a>
            <a href="{{route('admin.pages.articles.index')}}" class="btn btn-outline-secondary btn-sm">
                Back to list
            </a>
        </div>
    </div>


</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>


</script>
@endsection
