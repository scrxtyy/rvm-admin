@extends('employees.dashboard')

@section('content')

<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <div class="flex items-center justify-center">
        <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
          <a
            href="{{ url('/employee/' . $employees->id . '/edit')}}"
            aria-current="page"
            class="
              rounded-l
              px-6
              py-2.5
              bg-green-600
              text-white
              font-medium
              text-xs
              leading-tight
              uppercase
              hover:bg-green-700
              focus:bg-green-700 focus:outline-none focus:ring-0
              active:bg-green-800
              transition
              duration-150
              ease-in-out
            "
          >
            Edit Profile
          </a>
          <a
          href="{{ url('/employee/' . $employees->id . '/editpassword')}}"
            class="
              px-6
              py-2.5
              bg-green-600
              text-white
              font-medium
              text-xs
              leading-tight
              uppercase
              hover:bg-green-700
              focus:bg-green-700 focus:outline-none focus:ring-0
              active:bg-green-800
              transition
              duration-150
              ease-in-out
            "
          >
            Change Password
          </a>
        </div>
      </div>
    </div>
</div>
  @if( session('message') )
    <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
      {{session('message')}}
    </div>
  @endif
@yield('edit')

@stop