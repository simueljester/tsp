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
                    <li class="breadcrumb-item active" aria-current="page"> <strong> Add New Template </strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <form action="{{route('admin.pages.choose-us.save')}}" method="POST">
        @csrf
        <div class="card fadeIn mt-3">
            <div class="card-header bg-light">
                <strong> Add New Template </strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group ">
                            <div class="border-custom-circle text-center custom-icon-parent bg-light shadow">
                                <h1> <i class="fa-brands fa-uncharted custom-icon-child" id="showicon"></i> </h1>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label class="form-control-label">Icon</label> <small class="text-danger"> * </small>
                            <input type="text" name="icon" id="icon" class="form-control bg-light" readonly value="fa-brands fa-uncharted">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="slick-center">
                        @foreach ($icons as $icon)
                            <div class="text-center card-hover-outline m-3 border-custom p-1" style="cursor: pointer;" onclick="selectIcon({{json_encode($icon)}})">
                                <h4> <i class="{{$icon}}" id="{{$icon}}"></i> </h4>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                    <textarea type="text" name="description" id="description" class="form-control description" rows="10"> Type your description here </textarea>
                </div>
            </div>
            <div class="card-footer">
                <button  class="btn btn-sm btn-primary"> Save </button>
                <a href="{{route('admin.pages.choose-us.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
            </div>
        </div>
    </form>


</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-slick')
@include('scripts-ck-editor')
<script>

    function selectIcon(icon){
        $('#icon').val(icon)
        $('#iconSelectedLabel').html(icon + ' selected')
        $('#showicon').removeClass()
        $('#showicon').addClass(icon + ' fadeIn custom-icon-child')
    }

</script>
@endsection
