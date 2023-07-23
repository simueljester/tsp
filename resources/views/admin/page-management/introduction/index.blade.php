@extends('layouts.app-soft-ui')

@section('content')
<div>
    <div class="card">
        <div class="card-body">
            <div>
                <h4 class="mt-3"> <i class="fa-solid fa-cube"></i> Introduction </h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.pages.introduction.index')}}"> <strong> List </strong> </a></li>
                </ol>
            </nav>
        </div>
    </div>
    @if ($activeViewing)
        <div class="card fadeIn mt-3">
            <div class="card-header">
                <strong> View Introduction </strong> <a href="{{route('admin.pages.introduction.index')}}" style="font-size: 12px;"> Remove </a>
            </div>
            <div class="card-body">
                <div class="container-fluid bg-light p-5 mb-5">
                    <div class="row ml-3">
                        <div class="col-sm-5 text-center mt-5">
                            <img class="zoomIn" src="{{ asset('images') }}/symbol2.png" width="280">
                        </div>
                        <div class="col-sm-5 text-left mt-5">
                            <h1 class="mt-5 fadeIn">
                                <b> {{$activeViewing->title}} </b>
                                <p class="text-new-warning" style=" font-family: cursive;font-style: oblique;font-size:22px;"> {{$activeViewing->slogan}} </p>
                            </h1>
                            <p class="text-muted fadeIn"> {!! $activeViewing->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card bg-white fadeIn mt-3">
        <div class="card-header">
            <strong> Template List </strong>
            <div class="mt-3">
                <a href="{{route('admin.pages.introduction.create')}}" class="btn btn-primary btn-sm"> <i class="fa-solid fa-plus"></i> Add Template  </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0 table-hover">
                    <thead>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Title </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Active</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Action</th>
                    </thead>
                    <tbody>
                        @forelse ($introductions as $intro)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-xs"> {{$intro->title}} </h6>
                                    </div>
                                </td>
                                <td>
                                    @if ($intro->active == true)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"onclick="viewIntro({{$intro->id}})">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a> &nbsp
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs ml-3" data-original-title="Edit user">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a> &nbsp
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs ml-3" data-original-title="Edit user">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"> No record found </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    function viewIntro(id){
        var url = '{{ route("admin.pages.introduction.index", ":id") }}';
        url = url.replace(':id', id);
        window.location.href = url;
    }
</script>
@endsection
