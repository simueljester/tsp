
<div class="container-fluid bg-light p-5 text-center mb-5">
    <div class="row ml-3">
        <div class="col-sm-5 text-right mt-5">
            <img class="zoomIn" src="{{ asset('images/icons') }}/{{$contents['introduction']['logo']}}" width="280">
        </div>
        <div class="col-sm-5 text-left mt-5">
            <h1 class="mt-5 fadeIn">
                <b> {{$contents['introduction']['title']}} </b>
                <p class="text-new-warning" style=" font-family: cursive;font-style: oblique;font-size:22px;">{{$contents['introduction']['slogan']}} </p>
            </h1>
            <p class="text-muted fadeIn">
                {!! $contents['introduction']['description'] !!}
            </p>

        </div>
    </div>
</div>
<div class="container-fluid p-4 bg-info text-center mt-5" style="background: rgb(247,172,32);
background: linear-gradient(90deg, rgba(247,172,32,1) 0%, rgba(247,136,32,1) 94%);">
    <strong> {{$contents['introduction']['breaker']}} </strong>
</div>
