@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-globe"></i> My Website </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.my-website.index')}}">List</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> <strong> Add New Template </strong></li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{route('admin.my-website.save')}}" method="POST">
        @csrf
        <div class="card fadeIn mt-3">
            <div class="card-header bg-light">
                <strong> Add New Template </strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div>
                    <small> Creation of template will be inactive by default </small>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-primary"> Save & Manage </button>
                <a href="{{route('admin.my-website.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
            </div>
        </div>
    </form>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>


</script>
@endsection
