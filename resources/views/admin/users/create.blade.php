@extends('admin.users.index')

@section('user-content')
<div class="mt-3">
    <form action="{{route('admin.users.save')}}" method="POST" autocomplete="off">
        @csrf
        @method('POST')
        <strong class="text-muted"> Fill up form </strong>
        <div class="form-group mt-3">
            <input type="text" name="name" id="name" class="form-control bg-light" placeholder="Full Name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control bg-light" placeholder="Email Address" value="{{ old('email') }}" autocomplete="off" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control bg-light" placeholder="Password" autocomplete="off" required>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-light" placeholder="Confirm Password" autocomplete="off" required>
        </div>
        <div class="form-group">
            <select name="role" id="role" class="form-control bg-light" required>
                <option value=""> Select Role </option>
                <option value="owner"> Owner </option>
                <option value="admin"> Admin </option>
            </select>
        </div>
        <div class="form-group">
            <button onclick="return confirm('Are you sure you want to add new user?')" class="btn btn-primary btn-sm"> Create </button>
            <a href="{{route('admin.users.index')}}" type="button" class="btn btn-sm btn-outline-secondary"> Cancel </a>
        </div>
    </form>
</div>
@endsection
