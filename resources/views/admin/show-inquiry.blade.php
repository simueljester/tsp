@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-inbox"></i> Inquiry </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('admin.inquiry.index')}}"> List </a> </li>
                    <li class="breadcrumb-item active"> <strong> View Inquiry </strong> </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card fadeIn mt-3">
        <div class="card-header">
            <strong> View Inquiry </strong>
            <br>
            <small> Inquiries are created from front end website </small>
        </div>
        <div class="card-body">
            {{$inquiry->description}}

            @if ($inquiry->service)
                <div class="mt-3">
                    <a href="{{route('admin.pages.services.show', $inquiry->service->slug)}}" class="text-primary"> {{$inquiry->service->name}} </a>
                </div>
            @endif

            <div class="mt-3">
                <i class="fa-solid fa-user"></i> {{$inquiry->name}}
            </div>
            <div>
                <i class="fa-solid fa-phone"></i>  {{$inquiry->contact}}
            </div>
            <div>
                <i class="fa-regular fa-envelope"></i> {{$inquiry->email}}
            </div>
        </div>
    </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>


</script>
@endsection
