@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-star-half-stroke"></i> Reviews </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('admin.pages.reviews.index')}}"> List </a> </li>
                    <li class="breadcrumb-item active"> <strong> View Review </strong> </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card fadeIn mt-3">
        <div class="card-header">
            <strong> Reviews </strong>
            <br>
            <small> Reviews are created from front end website </small>
        </div>
        <div class="card-body">
            <div class="p-3 border-custom bg-light">
                {{ $review->comment }}
                <div class="mt-3">
                    @for ($i = 1; $i <= $review->rating; $i++)
                        <i class="fa-solid fa-star text-warning"></i>
                    @endfor
                </div>
            </div>

            @if ($review->service)
                <div class="mt-3">
                    <a href="{{route('admin.pages.services.show', $review->service->slug)}}" class="text-primary"> <strong>  {{$review->service->name}}  </strong> </a>
                </div>
            @endif
            <div class="mt-3">
                <i class="fa-solid fa-user"></i> &nbsp {{$review->commented_by}}
            </div>
        </div>
        <div class="card-footer">
            <a href="{{route('admin.pages.reviews.index')}}" class="btn btn-sm btn-outline-secondary"> Back to list </a>
        </div>
    </div>



</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>


</script>
@endsection
