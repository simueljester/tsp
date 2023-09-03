
<div class="container-fluid bg-light p-5">
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
            <h2> <b> What Out Client Says </b> </h2> <a href="https://www.facebook.com/TSPnConsultancy" target="_blank"> <i class="fa-brands fa-facebook"></i> Visit our fb page</a>
            <div class="container mt-5">
                <div class="d-flex justify-content-center row">
                    <div class="d-flex flex-column comment-section">
                        <div class="single-item">
                            <div class="bg-light p-2">
                                <div class="d-flex flex-row user-info">
                                    <img class="rounded-circle" src="{{ asset('images') }}/user.png" width="45">
                                    <div class="d-flex flex-column justify-content-start ml-2">
                                    <span class="d-block font-weight-bold name"> Adrian Par </span>
                                    <span class="date text-black-50">Shared publicly - Jan 2020</span>
                                </div>
                                </div>
                                <div class="mt-2">
                                    <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



