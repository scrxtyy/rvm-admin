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
              bg-purple-600
              text-white
              font-medium
              text-xs
              leading-tight
              uppercase
              hover:bg-purple-700
              focus:bg-purple-700 focus:outline-none focus:ring-0
              active:bg-purple-800
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
              bg-purple-600
              text-white
              font-medium
              text-xs
              leading-tight
              uppercase
              hover:bg-purple-700
              focus:bg-purple-700 focus:outline-none focus:ring-0
              active:bg-purple-800
              transition
              duration-150
              ease-in-out
            "
          >
            Change Password
          </a>
          {{-- <a
          href="{{ url('/employee/' . $employees->id . '/editrvm')}}"
            class="
              rounded-r
              px-6
              py-2.5
              bg-purple-600
              text-white
              font-medium
              text-xs
              leading-tight
              uppercase
              hover:bg-purple-700
              focus:bg-purple-700 focus:outline-none focus:ring-0
              active:bg-purple-800
              transition
              duration-150
              ease-in-out
            "
          >
            Edit RVM Details
          </a> --}}
        </div>
      </div>
    </div>
</div>

@yield('edit')

@stop