@extends('admin.website.manage')

@section('subcontent')

<p class="m-3 text-muted">
   Select in the list of created about template. The selected list will be the about page of your website.
</p>
<div class="card p-3" style="border: none;background:transparent">
    <strong class="text-muted"> Available Resources ({{$abouts->count()}}) <small> <a href="{{route('admin.pages.about.create')}}"> Add New </a> </small> </strong>
    <div class="row">
        @forelse ($abouts as $about)
            <div class="col-sm-3">
                <div class="card " style="border: none;background:transparent">
                    <div class="card-body">
                        <h4> <strong> <i class="fa-solid fa-circle-info"></i> {{$about->title}} </strong> </h4>
                        <div class="mt-1">
                            <a style="color: #d20abe" href="javascript:;" onclick="previewAbout({{$about}})"> Preview </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-sm-12">
                No records found.
            </div>
        @endforelse
    </div>
</div>

<div class="fadeIn">
    <h2> <b id="title"> {{$activeAbout ? $activeAbout->title : 'Title here'}} </b>  </h2>
    <div class="text-muted" id="description">
        @if ($activeAbout)
            {!! $activeAbout->description !!}
        @else
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat. Sed porttitor lectus nibh. Sed porttitor lectus nibh.
        @endif
    </div>
    <center>
        <img class="about" width="250" src="{{ asset('images') }}/tsp3.png">
    </center>
</div>

<form action="{{route('admin.my-website.manage-content.save')}}" method="POST">
    @CSRF
    <div class="mt-3">
        <input type="hidden" name="website_id" id="website_id" value="{{$my_website->id}}">
        <input type="hidden" name="content_code" id="content_code" value="about">
        <input type="hidden" id="previewData" name="data" id="data" cols="30" rows="10" />
        <button id="saveAbout" class="btn btn-success btn-sm fadeIn"> Save About </button>
    </div>
</form>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    $( document ).ready(function() {
      $('#saveAbout').hide()
    });

    function previewAbout(about){

        $('#title').html(about.title)
        $('#description').html(about.description)
        $('#previewData').val(JSON.stringify(about))
        $('#saveAbout').show()

    }

</script>

@endsection
