@extends('admin.users.index')

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
                <a href="{{route('admin.users.edit',$user)}}" class="btn btn-primary btn-sm">  Edit User </a>
                @if ($user->archived_at)
                    <a href="{{route('admin.users.set.active',$user)}}" class="btn btn-outline-success btn-sm"> Set Active </a>
                @else
                    <a href="{{route('admin.users.archive',$user)}}" class="btn btn-outline-secondary btn-sm"> Archive User </a>
                @endif

            </div>
        </div>
        <div class="col-sm-6">

        </div>
    </div>
</div>
@endsection
