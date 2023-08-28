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
                    <li class="breadcrumb-item active" aria-current="page"> <strong> {{$article->name}} </strong></li>
                </ol>
            </nav>
        </div>
  </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="{{route('admin.pages.articles.update')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="card fadeIn mt-3">
                    <div class="card-header bg-light">
                        <strong> Edit Article </strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-control-label">Name</label><small class="text-danger"> * </small>
                            <input type="text" name="name" id="name" class="form-control" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" value="{{ $article->name }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Slug</label><small class="text-danger"> * </small>
                            <input type="text" name="slug" id="slug-text" class="form-control bg-light" readonly value="{{ $article->slug }}">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Description</label> <small class="text-danger"> * </small>
                            <textarea type="text" name="description" id="description" class="form-control description" rows="10"> {!! $article->description !!} </textarea>
                        </div>
                        <div class="form-group">
                            <div class="mt-2 mb-2">
                                <img id="outputImage" src="{{asset('images/icons').'/'.$article->thumbnail}}" class="border-custom shadow" style="width: 200px;height:150px;object-fit:contain" />
                            </div>
                            <label class="form-control-label">Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail" accept="image/*" onchange="loadFile(event)">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Service</label> <small> (optional) </small>
                            <select name="service_id" id="service_id" class="form-control">
                                <option value=""> -- </option>
                                @forelse ($services as $service)
                                    <option value="{{$service->id}}" {{$article->service_id == $service->id ? 'selected' : ''}}> {{$service->name}} </option>
                                @empty
                                    <option value=""> No record </option>
                                @endforelse
                            </select>
                            <small>If service is selected, this particular article will be displayed when user visited the service. </small>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">Publish</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1" {{$article->published_at ? 'checked' : ''}}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" hidden>
                                <div class="form-group">
                                    <label class="form-control-label">Is Featured</label> <small> Display in homepage </small>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{$article->is_featured ? 'checked' : ''}}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" id="id" value="{{$article->id}}">
                        <button  class="btn btn-sm btn-primary"> Save Changes </button>
                        <a href="{{route('admin.pages.articles.index')}}" class="btn btn-sm btn-outline-secondary"> Cancel </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-ck-editor')

<script>

    function convertToSlug( str ) {
        str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
        str = str.replace(/^\s+|\s+$/gm,'');
        str = str.replace(/\s+/g, '-');
        $( "#slug-text" ).val(str);
    }

    var loadFile = function(event) {
        var output = document.getElementById('outputImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        $('#outputImage').show()
    };
</script>
@endsection
