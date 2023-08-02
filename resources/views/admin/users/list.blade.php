@extends('admin.users.index')

@section('user-content')
<div class="table-responsive">
    <table class="table align-items-center mb-0 table-hover">
        <thead>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Name </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Email </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Role </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Action </th>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="text-capitalize">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-s"> <i class="fa-solid fa-user"></i> {{$user->name}} </h6>
                        </div>

                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td> {{$user->role}} </td>
                    <td>
                        <a href="{{route('admin.users.show',$user)}}" class="text-white btn bg-primary btn-sm">
                            View
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

@endsection
