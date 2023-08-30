@extends('admin.website.manage')

@section('subcontent')

<p class="m-3 text-muted">
    Select choose us data in the available resources. The selected list will be the displayed front page of your website <strong> Choose Us Section </strong>.
</p>
<div class="card p-3" style="border: none;background:transparent">
    <strong class="text-muted"> Available Resources ({{$choose_us_data->count()}}) <small> <a href="{{route('admin.pages.choose-us.index')}}"> Add New </a> </small> </strong>
    <div class="mt-3">
        <ul>
            @foreach ($choose_us_data as $data)
                <li class="m-1" style="display: inline-block;">
                    <a href="javascript:;" style="color: #d20abe;" onclick="selectChooseUs({{$data}})"> <i class="{{$data->icon}}"></i> {{$data->name}} </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>


<div class="container-fluid p-5">
    <div>
        <h2> <b> Why Choose Us? </b> </h2>
        <div id="chooseUsContainer">
            @forelse ($selectedData as $data)
            <div class="card" style="background: transparent; border:none;background:transparent" id="rowId{{$data->id}}">
                <div class="card-body">
                    <span style="cursor: pointer;" onclick="removeFromSelected({{ $data->id }})" class="float-right"> Remove <i class="fa-solid fa-xmark" ></i> </span>
                    <div class="row">
                        <div class="col-sm-2 p-5 border-custom background-orange" style="position: relative;">
                            <div style="width: 50px;height: 50px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" class="zoomIn">
                                 <i class="{{$data->icon}} text-white fa-2x "></i>
                            </div>
                        </div>
                        <div class="col-sm-8 text-left p-3">
                            <b> <i class="fa-regular fa-circle-check text-success"></i> <a style="color: #d20abe;" href="{{route('admin.pages.choose-us.show',$data->id)}}" target="_blank"> {{$data->name}} </a>  </b>
                            <div> {!! $data->description !!} </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                No record found
            @endforelse
        </div>
    </div>
</div>

<form action="{{route('admin.my-website.manage-content.save')}}" method="POST">
    @CSRF
    <div class="mt-3">
        <input type="hidden" name="website_id" id="website_id" value="{{$my_website->id}}">
        <input type="hidden" name="content_code" id="content_code" value="choose_us">
        <input type="hidden" id="previewData" name="data" id="data" cols="30" rows="10" value="{{$getIds}}">
        <button id="saveChooseUs" class="btn btn-success btn-sm fadeIn"> Save Choose Us </button>
    </div>
</form>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>

$( document ).ready(function() {
      $('#saveChooseUs').hide()
});
var ids =  $('#previewData').val() != '' ? $('#previewData').val().split(',').map(Number) : [] ;

function selectChooseUs(data){
    if(ids.includes(data.id)){
        document.querySelector('#containerAlertSelected').insertAdjacentHTML(
        'afterbegin',
        `<div class="alert alert-info alert-dismissible fade show fadeInDown close-alert alert-selected bg-warning" role="alert" style="z-index:1000">
            <i class="fa-solid fa-triangle-exclamation fa-lg text-dark fa-beat-fade"></i>
            <span class="alert-text text-dark"><strong>Notice! ${data.name}</strong>  already selected </span>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="closeAlert()">
                <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
            </button>
        </div>`
        )
    }else{
        document.querySelector('#chooseUsContainer').insertAdjacentHTML(
        'afterbegin',
        `
        <div class="card" style="background: transparent; border:none;background:transparent" id="rowId${data.id}">
            <div class="card-body">
                <span onclick="removeFromSelected(${data.id})" class="float-right" style="cursor:pointer"> Remove <i style="cursor: pointer;" class="fa-solid fa-xmark"></i> </span>
                <div class="row">
                    <div class="col-sm-2 p-5 border-custom background-orange" style="position: relative;">
                        <div style="width: 50px;height: 50px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" class="zoomIn">
                                <i class="${data.icon} text-white fa-2x "></i>
                        </div>
                    </div>
                    <div class="col-sm-8 text-left p-3">
                        <b> <a style="color: #d20abe;" href="/admin/pages/choose-us/show/${data.id}" target="_blank">  ${data.name}  </a> </b>
                        <div> ${data.description} </div>
                    </div>
                </div>
            </div>
        </div>
        `
        )

        ids.push(data.id)
        $('#previewData').val(ids)
        $('#saveChooseUs').show()
    }

}

function removeFromSelected(id){
    $("#rowId"+id).remove();

    var index = ids.indexOf(id);
    if (index !== -1) {
        ids.splice(index, 1);
    }

    $('#previewData').val(ids)
    $('#saveChooseUs').show()
}

</script>
@endsection
