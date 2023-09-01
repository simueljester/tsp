
<div class="container-fluid bg-white text-center">
    <div class="card pt-5" style="border:none;">
        <div class="card-body">
            <h2> <b> Featured Services </b> </h2>
            <div> <a href=""> Browse All Services </a> </div>
            <div class="slick-center mt-5 mb-5">
                @foreach ($contents['services'] as $service)
                    <div class="card h-100 card-hover-scale" style="border:none;">
                        <div class="card-body">
                            <i class="{{$service->icon}} text-primary fa-2x "></i>
                            <div>
                                <b> {{$service->name}} </b>
                            </div>
                            <div class="text-muted char-limit text-left">
                                {{$service->description_clean}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
