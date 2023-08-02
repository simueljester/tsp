@extends('admin.users.index')

@section('user-content')
<div class="mt-3">
    <form action="{{route('admin.users.update')}}" method="POST" autocomplete="off">
        @csrf
        @method('POST')
        <strong class="text-muted"> Fill up form </strong>
        <div class="form-group mt-3">
            <input type="text" name="name" id="name" class="form-control bg-light" placeholder="Full Name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control bg-light" placeholder="Email Address" value="{{ $user->email }}" autocomplete="off" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control bg-light" placeholder="Reset password / Leave blank to retain current password" autocomplete="off">
        </div>
        <div class="form-group">
            <select name="role" id="role" class="form-control bg-light" required>
                <option value=""> Select Role </option>
                <option value="owner" {{ $user->role == 'owner' ? 'selected' : null }}> Owner </option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : null }}> Admin </option>
            </select>
        </div>
        <div class="form-group">
            <input type="hidden" name="id" id="id" value="{{$user->id}}">
            <button onclick="return confirm('Are you sure you want to add update user?')" class="btn btn-primary btn-sm"> Save Changes </button>
            <a href="{{route('admin.users.index')}}" type="button" class="btn btn-outline-secondary btn-sm"> Cancel </a>

        </div>
    </form>
</div>
@endsection
