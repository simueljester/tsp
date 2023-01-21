@extends('layouts.app')

@section('content')
<div>
    <div>
        <h4 class="mt-3"> <i class="fa-solid fa-users-gear"></i> Users </h4> 
     </div>

    <ul class="nav nav-tabs mt-5">

        <li class="nav-item">
            <a class="nav-link {{Route::current()->getName() == 'users.index' && $status == 'active' ? 'active text-dark' : 'text-muted'}}" href="{{route('users.index')}}"> Active List </a>
        </li>

        @if (Route::current()->getName() == 'users.index')
            <form action="">
                <li class="nav-item">
                    <button class="nav-link {{ $status == 'archive' ? 'active text-dark' : 'text-muted' }} " style="cursor: pointer;"  name="status"  value="archive">Archive List</button>
                </li>
            </form>
        @endif

        <li class="nav-item">
            <a class="nav-link {{Route::current()->getName() == 'users.create' ? 'active text-dark' : 'text-muted' }}" href="{{route('users.create')}}">Add New</a>
        </li>

        @if (Route::current()->getName() == 'users.show')
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'users.show' ? 'active text-dark' : 'text-muted' }}"> View User </a>
            </li> 
        @endif

        @if (Route::current()->getName() == 'users.edit')
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'users.edit' ? 'active text-dark' : 'text-muted' }}"> Edit User </a>
            </li> 
        @endif
 
      
    </ul>
    @yield('user-content')
</div>
@endsection
