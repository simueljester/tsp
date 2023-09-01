@extends('admin.website.manage')

@section('subcontent')

@if ($my_website->completed_at == null)
    <p class="m-3 text-muted">
        Select services you want to show in your website. <strong> Published Services </strong> will still be visible in your website <a href="#"> catalog page. </a>
    </p>
    <div class="card p-3" style="border: none;background:transparent">
        <strong class="text-muted"> Available Resources ({{$services->count()}}) <small> <a href="{{route('admin.pages.services.categories.index')}}"> Add New </a> </small> </strong>
        <div class="mt-3">
            <ul>
                @foreach ($services as $service)
                    <li class="m-1" style="display: inline-block;">
                        <a href="javascript:;" style="color: #d20abe;" onclick="selectService({{$service}})"> <i class="{{$service->icon}}"></i> {{$service->name}} </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@else
    <span class="text-muted"> Your content is currently completed, Please set to <strong class="text-dark"> In Progress </strong> to continue customizing. </span>
@endif

<div class="container-fluid text-center">
    <div class="card pt-5" style="border:none;background:transparent">
        <div class="card-body">
            <h2> <b> Featured Services </b> </h2>
            <div> <a href="#"> Browse Catalog </a>  </div>
            <div class="row" id="rowServiceContainer">
                @foreach ($selectedServices as $service)
                    <div class="col-sm-4 mt-3" id="colId{{$service->id}}">
                        <div class="card fadeIn bg-light h-100 p-3 border-custom" style="background:transparent;">
                            <div class="card-body">
                                @if ($my_website->completed_at == null)
                                    <i style="cursor: pointer;" class="fa-solid fa-xmark float-right" onclick="removeFromSelected({{ $service->id }})"></i>
                                @endif
                                <i class="{{$service->icon}} text-primary fa-2x"></i>
                                <div>
                                    <b>
                                        <a href="{{route('admin.pages.services.show',$service->id)}}" style="color: #d20abe;" target="_blank">
                                            <i class="fa-regular fa-circle-check text-success"></i>  {{$service->name}}
                                        </a>
                                    </b>
                                </div>
                                <div class="text-muted char-limit">
                                    {{$service->description_clean}}
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<form action="{{route('admin.my-website.manage-content.save')}}" method="POST">
    @CSRF
    <div class="mt-3">
        <input type="hidden" name="website_id" id="website_id" value="{{$my_website->id}}">
        <input type="hidden" name="content_code" id="content_code" value="services">
        <input type="hidden" id="previewData" name="data" id="data" cols="30" rows="10" value="{{$getIds}}">
        <button id="saveService" class="btn btn-success btn-sm fadeIn"> Save Services </button>
    </div>
</form>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>


$( document ).ready(function() {
      $('#saveService').hide()
});

var service_ids =  $('#previewData').val() != '' ? $('#previewData').val().split(',').map(Number) : [] ;

function selectService(service){

    if(service_ids.includes(service.id)){ // if already selected
        document.querySelector('#containerAlertSelected').insertAdjacentHTML(
        'afterbegin',
        `<div class="alert alert-info alert-dismissible fade show fadeInDown close-alert alert-selected bg-warning" role="alert" style="z-index:1000">
            <i class="fa-solid fa-triangle-exclamation fa-lg text-dark fa-beat-fade"></i>
            <span class="alert-text text-dark"><strong>Notice! ${service.name}</strong>  already selected </span>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="closeAlert()">
                <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
            </button>
        </div>`
        )
    }else{
        document.querySelector('#rowServiceContainer').insertAdjacentHTML(
        'afterbegin',
        `<div class="col-sm-4 mt-3" id="colId${service.id}">
            <div class="card bg-light fadeIn h-100 p-3 border-custom" style="background:transparent">
                <div class="card-body">
                    <i style="cursor: pointer;" class="fa-solid fa-xmark float-right" onclick="removeFromSelected(${ service.id })"></i>
                    <i class="${service.icon} text-secondary fa-2x"></i>
                    <div>
                        <b>
                            <a href="/admin/pages/services/show/${service.id}" style="color: #d20abe;" target="_blank"> ${service.name} </a>
                        </b>
                    </div>
                    <div class="text-muted char-limit">
                        ${service.description_clean}
                    </div>
                </div>
            </div>
        </div>`
        )

        service_ids.push(service.id)
        $('#previewData').val(service_ids)
        $('#saveService').show()
    }

}

function removeFromSelected(service_id){
    $("#colId"+service_id).remove();

    var index = service_ids.indexOf(service_id);
    if (index !== -1) {
        service_ids.splice(index, 1);
    }

    $('#previewData').val(service_ids)
    $('#saveService').show()
}

</script>
@endsection
