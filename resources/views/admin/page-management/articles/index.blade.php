@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-regular fa-newspaper"></i> Articles </h4>
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
            <strong> Articles </strong>
            <div class="mt-3">
                <a href="{{route('admin.pages.articles.create')}}" class="btn btn-primary btn-sm"> </i> Add New Article  </a>
            </div>
        </div>
        <div class="card-body">

        </div>
    </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>


</script>
@endsection
