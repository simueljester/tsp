@extends('layouts.app-soft-ui')


@section('content')

<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-screwdriver-wrench"></i> Services </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.pages.services.categories.index')}}"> Category List</a></li>
                <li class="breadcrumb-item active" aria-current="page"> <strong> {{$category->name}} </strong> </li>
                </ol>
            </nav>
        </div>
  </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="{{route('admin.pages.services.categories.update')}}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <strong> Edit Category </strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Service Category" required value="{{$category->name}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                                    <textarea type="text" name="description" id="description" class="form-control" rows="10"> {!! $category->description !!} </textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Publish</label>
                                            <div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1" {{$category->published_at ? 'checked' : ''}}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" hidden>
                                        <div class="form-group">
                                            <label class="form-control-label">Is Featured</label><small> Display in homepage </small>
                                            <div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{$category->is_featured ? 'checked' : ''}}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" id="id" value="{{$category->id}}">
                        <button class="btn btn-sm btn-primary"> Save Changes </button>
                        <a href="{{route('admin.pages.services.categories.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-slick')
<script>
    function browseModalIcon(){
        $('#iconsModal').modal('show')
    }
    function selectIcon(icon){
        $('#icon').val(icon)
        $('#iconSelectedLabel').html(icon + ' selected')
        $('#modalPreview').removeClass()
        $('#modalPreview').addClass(icon)
    }
</script>
@endsection
