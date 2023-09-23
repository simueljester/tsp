
@if (array_key_exists("services",$contents))
    <div class="container-fluid bg-light p-5 text-center mb-5" id="containerArticles">
        <h2> <b> Articles </b> </h2>
        <a href="{{route('list-article')}}"> Browse All Articles </a>
        <div class="row">
            @foreach ($contents['articles'] as $article)
                <div class="col-sm-4" id="colId{{$article->id}}">
                    <div class="card articles " style="border:none;cursor:pointer;background:transparent">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-hover-scale">
                                        <img src="{{asset('images/icons').'/'.$article->thumbnail}}" class="" style="width: 100%;height: 150px;object-fit:cover;border-radius:12px;">
                                    </div>
                                </div>
                                <div class="col-sm-6 text-left">
                                    <h6>
                                        <b>
                                            <a href="#" target="_blank" style="color: rgb(255, 145, 0)"> {{$article->name}} </a>
                                        </b>
                                    </h6>
                                    <div class="text-muted char-article-limit">
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
@endif
