
<div class="container-fluid bg-white p-5" id="containerAboutEvents">
   <div class="row ">
        @if (array_key_exists("about",$contents))
            <div class="col-sm-5">
                <div class="text-left">
                    <center>
                        <img class="about-image" width="250" src="{{ asset('images') }}/tsp3.png">
                        <h2> <b> {{$contents['about']['title']}} </b> </h2>
                    </center>
                    <p class="text-muted">
                        {!! $contents['about']['description'] !!}
                    </p>

                </div>
            </div>
        @endif
        @if (array_key_exists("news",$contents))
            <div class="col-sm-7 text-left">
                <h2> <b> News & Events </b>  </h2>
                <a href="{{route('list-news')}}" class="mb-2"> Browse All Events </a>
                <div class="single-item">
                    @foreach ($contents['news'] as $news)

                        <div class="card text-white border-custom parallax mt-3">
                            <div class="border-custom" style="background-image: url('{{ asset('/images/icons/' . $news->thumbnail) }}');
                                background-attachment: fixed;
                                background-position: center;
                                background-repeat: no-repeat;
                                background-size: cover;height:500px;">
                            <div class="p-3 border-custom" style="background:rgba(0, 0, 0, 0.5);">

                                    <h3 class="card-title"> <strong> <a href="{{route('page-landing-show-news',$news->slug)}}" style="text-decoration: none;" class="text-white"> {{$news->headline}} </a> </strong> </h3>
                                    <a href="{{route('page-landing-show-news',$news->slug)}}">
                                        <p style="color: rgb(255, 145, 0)"> {{$news->name}} </p>
                                    </a>
                                    <div>
                                        <small> <i class="fa-solid fa-earth-asia"></i> {{ Carbon\Carbon::parse( $news->published_at)->format('M d, Y')}} </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        @endif
   </div>
</div>
