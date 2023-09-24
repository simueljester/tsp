
<div class="container-fluid bg-light p-5" id="containerChooseUs">
    <div class="row">
        @if (array_key_exists("choose_us",$contents))
            <div class="col-sm-8">
                <h2> <b> Why Choose Us? </b> </h2>
                @foreach ($contents['choose_us'] as $data)
                    <div class="card" style="background: transparent; border:none;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 p-5 border-custom background-orange" style="position: relative;">
                                    <div style="width: 50px;height: 50px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" class="choose-item">
                                        <i class="{{$data->icon}} text-white fa-2x "></i>
                                    </div>
                                </div>
                                <div class="col-sm-8 text-left p-3">
                                    <b> {{$data->name}} </b>
                                    <div>
                                        {!! $data->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="col-sm-4">
            @if ($featuredReviews->isNotEmpty())
                <h2> <b> What Our Client Says </b> </h2> <a href="https://www.facebook.com/TSPnConsultancy" target="_blank"> <i class="fa-brands fa-facebook"></i> Visit our fb page</a>
                <div class="container mt-5">

                    <div class="single-item ">
                        @foreach ($featuredReviews as $review)
                        <div class="d-flex row">
                            <div class="d-flex flex-column comment-section">
                                <div class="bg-light p-4">
                                    <div class="d-flex flex-row user-info">
                                        <img class="rounded-circle" src="{{ asset('images') }}/user.png" width="45" height="45">
                                        <div class="d-flex flex-column justify-content-start ml-2">
                                        <span class="d-block font-weight-bold name"> {{$review->commented_by}}
                                            @for ($i = 1; $i <= (int)$review->rating; $i++)
                                                <i class="fa-solid fa-star text-warning"></i>
                                            @endfor
                                        </span>
                                        <span class="date text-black-50"><i class="fa-solid fa-earth-asia"></i> {{$review->created_at->format('M d, Y')}}</span>
                                    </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="comment-text">{{$review->comment}}</p>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{route('page-landing-show-service',$review->service)}}" class="btn btn-sm background-orange text-white border-custom">
                                            {{$review->service->name}} <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
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
</div>



