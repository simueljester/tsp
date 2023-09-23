
<div class="container-fluid bg-white p-5 text-center mb-5" id="containerContact">
    <div class="row ml-3">
        <div class="col-sm-6 text-right mt-5">
            {{-- <img class="zoomIn" src="{{ asset('images') }}/symbol2.png" width="280"> --}}

        </div>
        <div class="col-sm-6 text-left mt-3 contact">
            <form action="{{route('save-inquiry')}}" method="POST">
                @csrf
                <h1 class="mt-5 fadeIn"> <b><i class="fa-solid fa-phone"></i> Reach Us! Start your inquiries </b> </h1>
                <div class="form-group">
                    <small class="text-muted"> Name: </small> <strong class="text-danger"> * </strong>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small class="text-muted"> Email Address: </small> <strong class="text-danger"> * </strong>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small class="text-muted"> Contact #: </small> <strong class="text-danger"> * </strong>
                            <input type="text" name="contact" id="contact" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <small class="text-muted"> Inquiry: </small> <strong class="text-danger"> * </strong>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <button class="btn btn-primary"> Send Inquiry </button>
                </div>
            </form>
        </div>
    </div>
</div>
