@extends('admin.website.manage')

@section('subcontent')
<p class="m-3 text-muted">
    Select articles in the available resources. The selected list will be the displayed front page of your website <strong> Article Section </strong>.
</p>
<div class="card p-3" style="border: none;">
    <strong class="text-muted"> Available Resources ({{$articles->count()}}) <small> <a href="{{route('admin.pages.articles.index')}}"> Add New </a> </small> </strong>
    <div class="mt-3">
        <ul>
            @foreach ($articles as $article)
                <li class="m-1" style="display: inline-block;">
                    <a href="javascript:;" style="color: #d20abe;" onclick="selectArticle({{$article}})"> <i class="fa-regular fa-newspaper"></i> {{$article->name}} </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="container-fluid bg-light p-5 text-center mb-5 fadeIn">
    <h2> <b> Articles </b> </h2>
    <div class="row" id="rowArticleContainer">
        @foreach ($selectedArticles as $article)
            <div class="col-sm-4" id="colId{{$article->id}}">
                <div class="card bg-light articles" style="border:none;cursor:pointer">
                    <div class="card-body">
                        <i style="cursor: pointer;" class="fa-solid fa-xmark float-right" onclick="removeFromSelected({{ $article->id }})"></i>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{asset('images/icons').'/'.$article->thumbnail}}" alt="" style="width: 100%;height: 150px;object-fit:cover;border-radius:12px;">
                            </div>
                            <div class="col-sm-6 text-left">
                                <h6> <b> {{$article->name}} </b> </h6>
                                <div class="text-muted char-article-limi">
                                    {{ substr(strip_tags($article->description),0,110) }}
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
        <input type="hidden" name="content_code" id="content_code" value="articles">
        <input type="hidden" id="previewData" name="data" id="data" cols="30" rows="10" value="{{$getIds}}">
        <button id="saveArticle" class="btn btn-success btn-sm fadeIn"> Save Articles </button>
    </div>
</form>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>

$( document ).ready(function() {
      $('#saveArticle').hide()
});
var article_ids =  $('#previewData').val() != '' ? $('#previewData').val().split(',').map(Number) : [] ;

function selectArticle(article){
    if(article_ids.includes(article.id)){
        alert('Article already selected')
    }else{
        document.querySelector('#rowArticleContainer').insertAdjacentHTML(
        'afterbegin',
        `
            <div class="col-sm-4" id="colId${article.id}">
                <div class="card bg-light articles" style="border:none;cursor:pointer">
                    <div class="card-body">
                        <i style="cursor: pointer;" class="fa-solid fa-xmark float-right" onclick="removeFromSelected(${ article.id })"></i>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{url('/images/icons/${article.thumbnail} ')}}" alt="" style="width: 100%;height: 150px;object-fit: cover;border-radius:12px;">
                            </div>
                            <div class="col-sm-6 text-left">
                                <h6> <b> ${article.name} </b> </h6>
                                <div class="text-muted char-article-limit">
                                    ${article.description.replace(/<\/?[^>]+(>|$)/g, "")}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
        )

        article_ids.push(article.id)
        $('#previewData').val(article_ids)
        $('#saveArticle').show()
    }

}

function removeFromSelected(article_id){
    $("#colId"+article_id).remove();

    var index = article_ids.indexOf(article_id);
    if (index !== -1) {
        article_ids.splice(index, 1);
    }

    $('#previewData').val(article_ids)
    $('#saveArticle').show()
}

</script>
@endsection
