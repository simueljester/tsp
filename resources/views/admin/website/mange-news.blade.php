@extends('admin.website.manage')

@section('subcontent')

@if ($my_website->completed_at == null)
    <p class="m-3 text-muted">
        Select news in the available resources. The selected list will be the displayed front page of your website <strong> News Section </strong>.
    </p>
    <div class="card p-3" style="border: none;background:transparent">
        <strong class="text-muted"> Available Resources ({{$news->count()}}) <small> <a href="{{route('admin.pages.news.index')}}"> Add New </a> </small> </strong>
        <div class="mt-3">
            <ul>
                @foreach ($news as $_news)
                    <li class="m-1" style="display: inline-block;">
                        <a href="javascript:;" style="color: #d20abe;" onclick="selectNews({{$_news}})"> <i class="fa-solid fa-earth-asia"></i> {{$_news->name}} </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@else
    <span class="text-muted"> Your content is currently completed, Please set to <strong class="text-dark"> In Progress </strong> to continue customizing. </span>
@endif


<div class="container-fluid p-5 text-center mb-5 fadeIn">
    <h2> <b> News </b> </h2>
    <div class="row" id="rowNewsContainer">
        @foreach ($selectedNews as $news)
            <div class="col-sm-4" id="colId{{$news->id}}">
                <div class="card articles" style="border:none;background:transparent">
                    <div class="card-body">
                        @if ($my_website->completed_at == null)
                            <i style="cursor: pointer;" class="fa-solid fa-xmark float-right" onclick="removeFromSelected({{ $news->id }})"></i>
                        @endif
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{asset('images/icons').'/'.$news->thumbnail}}" alt="" style="width: 100%;height: 150px;object-fit:cover;border-radius:12px;">
                            </div>
                            <div class="col-sm-6 text-left">
                                <h6> <b> <a href="{{route('admin.pages.news.show',$news->id)}}" style="color: #d20abe;" target="_blank"> {{$news->name}} </a> </b> </h6>
                                <div class="text-muted char-article-limit">
                                    {{ substr(strip_tags($news->description),0,110) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<form action="{{route('admin.my-website.manage-content.save')}}" method="POST">
    @CSRF
    <div class="mt-3">
        <input type="hidden" name="website_id" id="website_id" value="{{$my_website->id}}">
        <input type="hidden" name="content_code" id="content_code" value="news">
        <input type="hidden" id="previewData" name="data" id="data" cols="30" rows="10" value="{{$getIds}}">
        <button id="saveNews" class="btn btn-success btn-sm fadeIn"> Save News </button>
    </div>
</form>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>

$( document ).ready(function() {
      $('#saveNews').hide()
});
var news_ids =  $('#previewData').val() != '' ? $('#previewData').val().split(',').map(Number) : [] ;

function selectNews(news){
    if(news_ids.includes(news.id)){
        document.querySelector('#containerAlertSelected').insertAdjacentHTML(
        'afterbegin',
        `<div class="alert alert-info alert-dismissible fade show fadeInDown close-alert alert-selected bg-warning" role="alert" style="z-index:1000">
            <i class="fa-solid fa-triangle-exclamation fa-lg text-dark fa-beat-fade"></i>
            <span class="alert-text text-dark"><strong>Notice! ${news.name}</strong>  already selected </span>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="closeAlert()">
                <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
            </button>
        </div>`
        )
    }else{
        document.querySelector('#rowNewsContainer').insertAdjacentHTML(
        'afterbegin',
        `
            <div class="col-sm-4" id="colId${news.id}">
                <div class="card articles" style="border:none;background:transparent">
                    <div class="card-body">
                        <i style="cursor: pointer;" class="fa-solid fa-xmark float-right" onclick="removeFromSelected(${ news.id })"></i>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{url('/images/icons/${news.thumbnail} ')}}" alt="" style="width: 100%;height: 150px;object-fit: cover;border-radius:12px;">
                            </div>
                            <div class="col-sm-6 text-left">
                                <h6>
                                    <a href="/admin/pages/news/show/${news.id}" style="color: #d20abe;" target="_blank"> <b> ${news.name} </b>  </a>
                                </h6>
                                <div class="text-muted char-article-limit">
                                    ${news.description.replace(/<\/?[^>]+(>|$)/g, "")}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
        )

        news_ids.push(news.id)
        $('#previewData').val(news_ids)
        $('#saveNews').show()
    }

}

function removeFromSelected(news_id){
    $("#colId"+news_id).remove();

    var index = news_ids.indexOf(news_id);
    if (index !== -1) {
        news_ids.splice(index, 1);
    }

    $('#previewData').val(news_ids)
    $('#saveNews').show()
}

</script>
@endsection
