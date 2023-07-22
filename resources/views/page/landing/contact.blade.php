
<div class="container-fluid bg-white p-5 text-center mb-5">
    <div class="row ml-3">
        <div class="col-sm-6 text-right mt-5">
            {{-- <img class="zoomIn" src="{{ asset('images') }}/symbol2.png" width="280"> --}}
          
        </div>
        <div class="col-sm-6 text-left mt-3">
            <h1 class="mt-5 fadeIn"> <b><i class="fa-solid fa-phone"></i> Reach Us! Start your inquiries </b> </h1>
            <div class="form-group">
                <small class="text-muted"> Name: </small>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <small class="text-muted"> Email Address: </small>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <small class="text-muted"> Inquiry: </small>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div>
                <button class="btn btn-primary"> Send Inquiry </button>
            </div>
        </div>
    </div>
</div>
