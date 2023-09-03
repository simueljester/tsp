@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-inbox"></i> Inquiry </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"> <strong> List </strong> </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card fadeIn mt-3">
        <div class="card-header">
            <strong> Inquiries </strong>
            <br>
            <small> Inquiries are created from front end website </small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0 table-hover">
                    <thead>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Service </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Inquiry </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Name </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Date </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Action</th>
                    </thead>
                    <tbody>
                        @forelse ($inquiries as $inquiry)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-s">
                                            @if ($inquiry->service)
                                                <a href="{{route('admin.pages.services.show',$inquiry->service->id)}}" class="text-primary">
                                                    {{$inquiry->service->name}}
                                                </a>
                                            @else
                                                TSP
                                            @endif
                                        </h6>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-capitalize" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 500px;">
                                        {{$inquiry->description}}
                                    </p>
                                </td>
                                <td>
                                   {{$inquiry->name}} <br>
                                   <small class="text-muted"> {{$inquiry->email}} / {{$inquiry->contact}} </small>
                                </td>
                                <td>
                                    {{$inquiry->created_at->format('M d, Y h:i a')}}
                                </td>
                                <td>
                                    <a href="javascript:;" class="text-white btn bg-primary btn-sm" onclick="viewInquiry({{$inquiry}}, {{json_encode($inquiry->created_at->format('M d, Y'))}})">
                                        View
                                    </a>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="confirmDelete({{$inquiry->id}})">
                                        Delete
                                    </button>
                                    <form action="{{route('admin.inquiry.delete')}}" method="post" id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="deleteId" id="deleteId">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"> No record found </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-2">
                    {!! $inquiries->links() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
                <i class="fa-solid fa-triangle-exclamation fa-3x text-warning fa-fade"></i>
                <p>
                    Are you sure you want to delete this <strong> inquiry </strong> ?
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
              <button onclick="proceedDelete()" type="button" class="btn bg-gradient-primary">Confirm</button>
            </div>
          </div>
        </div>
    </div>

       {{-- View Inquiry --}}
       <div class="modal fade" id="inquiryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Inquiry</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
                <div id="serviceContainer">
                    <div class="p-3">
                        <center>
                            <h1>
                                <div class="border-custom-circle text-center custom-icon-parent-2 bg-light shadow target-icon mb-3">
                                    <i class="custom-icon-child-2" id="serviceIcon"></i>
                                </div>
                            </h1>
                        </center>
                    </div>
                    <div class="text-center">
                        <strong id="serviceName"></strong>
                    </div>
                </div>

                <div>
                    <p id="inquiryDescription"></p>
                </div>
                <div>
                    <i class="fa-solid fa-user"></i> <strong class="text-uppercase" id="inquiryName"></strong>
                </div>
                <div>
                    <small id="inquiryEmail"></small>
                </div>
                <div>
                    <small id="inquiryDate"></small>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>

    function confirmDelete(id){
        $('#deleteConfirmationModal').modal('show')
        $('#deleteId').val(id)
    }

    function proceedDelete(){
        document.getElementById("deleteForm").submit();
    }

    function viewInquiry(inquiry,created_at){
        if(inquiry.service != null){
            $('#serviceIcon').removeClass(inquiry.service.icon)
            $('#serviceIcon').addClass(inquiry.service.icon)
            $('#serviceName').html(inquiry.service.name)
            $('#serviceContainer').show()
        }else{
            $('#serviceContainer').hide()
        }

        $('#inquiryEmail').html(inquiry.email + ' / ' + inquiry.contact)

        $('#inquiryDescription').html(inquiry.description)
        $('#inquiryName').html(inquiry.name)
        $('#inquiryDate').html(created_at)
        $('#inquiryModal').modal('show')
    }

</script>
@endsection
