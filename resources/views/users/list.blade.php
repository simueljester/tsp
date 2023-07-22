@extends('users.index')

@section('user-content')

    <table class="table mt-3">
        <thead class="thead-light">
            <tr>
                <th> Name </th>
                <th> Email </th>
                <th> Role </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="text-capitalize">
                        <a href="{{route('admin.users.show',$user)}}" class="text-new-warning"> <i class="fa-solid fa-user"></i> {{$user->name}} </a>
                    </td>
                    <td>
                        {{$user->email}} 
                    </td>
                    <td> {{$user->role}} </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3"> No record found </td>
                </tr>
            @endforelse
         
        </tbody>
    </table>
@endsection