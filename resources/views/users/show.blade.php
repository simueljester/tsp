@extends('users.index')

@section('user-content')
<div class="mt-3">
    <div class="row">
        <div class="col-sm-6">
            <div>
                Name: <strong> {{$user->name}} </strong>
            </div>
            <div>
                Email: <strong> {{$user->email}} </strong>
            </div>
            <div>
                Role: <strong class="text-capitalize"> {{$user->role}} </strong>
            </div>
            <div>
                Account Status: <strong class="text-capitalize"> 
                    @if ($user->archived_at)
                        <span class="text-warning"> Archived </span>
                    @else
                        <span class="text-success"> Active </span>
                    @endif
            
                </strong>
            </div>
            <div class="mt-3">
                @if ($user->archived_at)
                    <a href="{{route('users.set.active',$user)}}" class="btn btn-success"> <i class="fa-solid fa-box-archive"></i> Set Active </a>
                @else
                    <a href="{{route('users.archive',$user)}}" class="btn btn-warning"> <i class="fa-solid fa-box-archive"></i> Archive User </a>
                @endif      
                <a href="{{route('users.edit',$user)}}" class="btn btn-primary"> <i class="fa-regular fa-pen-to-square"></i> Edit User </a>
            </div>
        </div>
        <div class="col-sm-6">

        </div>
    </div>
</div>
@endsection