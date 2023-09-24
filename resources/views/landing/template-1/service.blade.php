
@if (array_key_exists("services",$contents))
    <div class="container-fluid bg-white text-center">
        <div class="card pt-5" style="border:none;">
            <div class="card-body">
                <h2> <b> Featured Services </b> </h2>
                <div> <a href="{{route('list-catalog')}}"> Browse All Services </a> </div>
                <div class="slick-center mt-5 mb-5">
                    @foreach ($contents['services'] as $service)
                    <a href="{{route('page-landing-show-service',$service->slug)}}" style="text-decoration: none;">
                        <div class="card h-100 card-hover-scale" style="border:none;">
                            <div class="card-body">
                                <i class="{{$service->icon}} fa-2x " style="color:rgba(247,136,32,1);text-decoration:none;"></i>
                                <div>
                                    <b class="text-dark"> {{$service->name}} </b>
                                </div>
                                <div class="text-muted char-limit text-left">
                                    {{$service->description_clean}}
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

