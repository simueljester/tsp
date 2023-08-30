@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-list"></i> Choose Us </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"> <a href="{{route('admin.pages.choose-us.index')}}"> List </a> </li>
                    <li class="breadcrumb-item active" aria-current="page"> <strong> {{$choose_us->name}} </strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card mt-3 fadeIn">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2 p-5 border-custom background-orange" style="position: relative;">
                    <div style="width: 50px;height: 50px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" class="choose-item">
                         <i class="{{$choose_us->icon}} text-white fa-2x "></i>
                    </div>
                </div>
                <div class="col-sm-8 text-left p-3">
                    <b> {{$choose_us->name}}  </b>
                    <div>
                        {!! $choose_us->description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{route('admin.pages.choose-us.index')}}" class="btn btn-sm btn-outline-secondary"> Back to list </a>
        </div>
    </div>



</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

</script>
@endsection
