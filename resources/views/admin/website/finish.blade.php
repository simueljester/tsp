@extends('admin.website.manage')

@section('subcontent')
    <div class="fadeIn p-3">
        <div>
            <h3> <strong> <i class="fa-solid fa-list-check"></i> Summary of created contents </strong> </h3>
            <div>
                Double check your contents before saving and marking as completed. <strong> <i class="fa-solid fa-triangle-exclamation text-warning"></i> Caution: Marking this template as <span class="text-success"> active </span> will live up the data in production front page.  </strong>
            </div>
        </div>
        <div class="form-group mt-3">
            <label> Active </label>
            <div>
                @if ($my_website->active == 1)
                    <h6> <span class="badge badge-pill badge-success">Active</span> </h6>
                @else
                    <h6> <span class="badge badge-pill badge-secondary">Inactive</span> </h6>
                @endif
            </div>
        </div>
        <div class="form-group mt-3">
            <label> Status </label>
            <div>
                @if ($my_website->completed_at)
                    <strong class="text-success"> Completed: {{$my_website->completed_at->format('M d, Y h:i a')}} </strong>
                @else
                    <h6> <span class="badge badge-pill badge-secondary">In progress</span> </h6>
                @endif
            </div>
        </div>
        <div class="form-group mt-3">
            <label> Template Name </label>
            <input type="text" id="currentName" class="form-control border-custom" value="{{$my_website->name}}" required>
        </div>
        <div class="form-group mt-3">
            <label> Created content list: </label>
            <ol>
                @forelse ($content_keys as $key)
                    <li>
                        <a href="/admin/my-website/manage-content/{{$key}}/{{$my_website->id}}" style="color: #d20abe;" class="text-uppercase"> {{$key}} </a>
                    </li>
                @empty
                    <li> No record found </li>
                @endforelse
            </ol>
        </div>
    </div>
    <div class="mt-3">
        <span> Select action </span>
        <hr>
        <a href="{{route('admin.my-website.index')}}" class="btn btn-sm btn-outline-secondary border-custom"> Back to list </a>
        @if ($my_website->completed_at == null)
            <button type="button" id="complete" class="btn btn-outline-primary btn-sm fadeIn border-custom" onclick="confirmModal('mark-complete')"> <i class="fa-solid fa-circle-check"></i> Mark as Complete </button>
        @else
            <button type="button" id="inprogress" class="btn btn-secondary btn-sm fadeIn border-custom" onclick="confirmModal('mark-inprogress')"> <i class="fa-solid fa-pen-to-square"></i> Back to In progress </button>
        @endif


        @if ($my_website->active == 0)
            @if ($my_website->completed_at)
                <button type="button" id="active" class="btn btn-success btn-sm fadeIn border-custom" onclick="confirmModal('activate')"> <i class="fa-solid fa-circle-check"></i> Activate </button>
            @endif
        @else
            <button type="button" id="deactivate" class="btn btn-danger btn-sm fadeIn border-custom" onclick="confirmModal('deactivate')"> <i class="fa-regular fa-circle-xmark"></i> Deactivate </button>
        @endif
    </div>

    <form action="{{route('admin.my-website.mark-complete')}}" method="POST" id="formMarkComplete">
        @CSRF
        <input type="hidden" name="name" class="newName">
        <input type="hidden" name="website_id" id="website_id" value="{{$my_website->id}}">
    </form>

    <form action="{{route('admin.my-website.mark-inprogress')}}" method="POST" id="formMarkInprogress">
        @CSRF
        <input type="hidden" name="name" class="newName">
        <input type="hidden" name="website_id" id="website_id" value="{{$my_website->id}}">
    </form>

    <form action="{{route('admin.my-website.activate')}}" method="POST" id="formActivate">
        @CSRF
        <input type="hidden" name="name" class="newName">
        <input type="hidden" name="website_id" id="website_id" value="{{$my_website->id}}">
    </form>

    <form action="{{route('admin.my-website.deactivate')}}" method="POST" id="formDeactivate">
        @CSRF
        <input type="hidden" name="name" class="newName">
        <input type="hidden" name="website_id" id="website_id" value="{{$my_website->id}}">
    </form>

    <!-- The Modal -->
    <div id="myModal" class="modal fadeIn">
        <div class="modal-content">
            <div class="text-right">
                <span class="close float-right" onclick="closeModal()">&times;</span>
            </div>
            <div class="p-3 text-center">
                <h1> <span id="modalIcon"></span> </h1>
                <div id="modalDescription"></div>
                <hr>
                <div>
                    <button id="btn-mark-complete" class="btn btn-primary" onclick="markAsComplete()"> Confirm </button>
                    <button id="btn-inprogress" class="btn btn-secondary" onclick="markAsInprogress()"> Confirm </button>
                    <button id="btn-activate" class="btn btn-success" onclick="activateTemplate()"> Activate Template </button>
                    <button id="btn-deactivate" class="btn btn-danger" onclick="deactivateTemplate()"> Continue deactivation </button>
                </div>
            </div>
        </div>
    </div>

<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;

        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>

    $('.newName').val($('#currentName').val())
    $('#btn-mark-complete').hide()
    $('#btn-activate').hide()
    $('#btn-deactivate').hide()
    $('#btn-inprogress').hide()


    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function closeModal(){
        modal.style.display = "none";
    }

    function confirmModal(actionCode){

        if(actionCode == 'mark-complete'){
            $('#modalIcon').html('<i class="fa-regular fa-circle-check fa-3x text-primary"></i>')
            $('#modalDescription').html('Are you sure you want to mark this template as <strong> Completed </strong> ?')
            $('#btn-mark-complete').show()
            $('#btn-inprogress').hide()
            $('#btn-activate').hide()
            $('#btn-deactivate').hide()
            $('.newName').val($('#currentName').val())
        }

        else if(actionCode == 'mark-inprogress'){
            $('#modalIcon').html('<i class="fa-solid fa-pen-to-square fa-3x text-secondary"></i>')
            $('#modalDescription').html('Since marking as in progress and to continue customizing, the active status will be set to <strong class="text-danger"> inactive / deactivate </strong> and display Maintenance page on production. <br>  Are you sure you want to mark this template as <strong> In Progress </strong> ?')
            $('#btn-mark-complete').hide()
            $('#btn-inprogress').show()
            $('#btn-activate').hide()
            $('#btn-deactivate').hide()
            $('.newName').val($('#currentName').val())
        }

        else if(actionCode == 'activate'){
            $('#modalIcon').html('<i class="fa-solid fa-triangle-exclamation fa-beat-fade fa-3x" style="color: #ee2b2b;"></i>')
            $('#modalDescription').html('You are about to <strong> activate </strong> this template. <br> Activating this will update the contents you saved in this template to production. <br> This will also remove the current active template. <br><strong> Are you sure you want to do this? </strong>')
            $('#btn-mark-complete').hide()
            $('#btn-inprogress').hide()
            $('#btn-activate').show()
            $('#btn-deactivate').hide()
            $('.newName').val($('#currentName').val())
        }

        else if(actionCode == 'deactivate'){
            $('#modalIcon').html('<i class="fa-solid fa-triangle-exclamation fa-beat-fade fa-3x" style="color: #ee2b2b;"></i>')
            $('#modalDescription').html('You are about to <strong> deactivate </strong> this template. <br> Maintenance message will be displayed in your website since no template is active <br><strong> Are you sure you want to do this? </strong>')
            $('#btn-mark-complete').hide()
            $('#btn-inprogress').hide()
            $('#btn-activate').hide()
            $('#btn-deactivate').show()
            $('.newName').val($('#currentName').val())
        }

        modal.style.display = "block";
    }

    function markAsComplete(){
        $('#formMarkComplete').submit();
    }

    function markAsInprogress(){
        $('#formMarkInprogress').submit();
    }

    function activateTemplate(){
        $('#formActivate').submit();
    }

    function deactivateTemplate(){
        $('#formDeactivate').submit();
    }

</script>
@endsection
