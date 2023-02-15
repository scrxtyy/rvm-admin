@extends('employees.dashboard')
@section('content')
@if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
  <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="text-xl font-semibold leading-tight">
          {{ __('RVMs') }}
      </h2>

      <a href="{{ url('/dashboard/create') }}" class="btn btn-success btn-sm" title="Add New RVM">   
        <button class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
          Add New
        </button>
      </a>
</div>
<br>
@if( session('message') )
<div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
  {{session('message')}}
  {{ session()->forget('message') }}
</div>
@endif
@if( session('deletemessage') )
<div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
  {{session('deletemessage')}}
  {{ session()->forget('deletemessage') }}
</div>
@endif
<div class="overflow-hidden bg-white shadow-md dark:bg-dark-eval-1">
   
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full text-center">
                <form action="/search" method="GET">
                  <input type="text" name="search" placeholder="Search Users"  class="
                  form-control
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-white bg-clip-padding
                  border border-solid border-gray-300
                  rounded
                  transition
                  ease-in-out
                  m-3
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                ">
                
                  <button type="submit" class="inline-block px-6 py-2.5 m-3 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    Search
                  </button>
                </form>
                <form action="/clearsearch" method="get">
                  <button type="submit" class="inline-block px-6 py-2.5 m-3 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    Clear Search
                  </button>
                </form>
                <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      RVM ID
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Name
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Email
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Actions
                    </th>
                  </tr>
                </thead class="border-b">
                <tbody>
                  @foreach($employees as $item)
                  <tr class="bg-white border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                      {{ $item->rvm_id }}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{ $item->name }}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{$item->email}}
                    </td>
                    {{-- <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{ substr($item->password, 0, 8)."..." }}
                    </td>  --}}
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        <a href="{{ url('/employee/' . $item->id) }}" title="View RVM">
                          <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            View
                          </button>
                        </a>
                        <a href="{{ url('/employee/' . $item->id . '/edit') }}" title="Edit Employee">
                          <button class="inline-block px-6 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">
                            Edit
                          </button>
                        </a>

                        <form method="POST" action="{{ url('/dashboard' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" title="Delete Employee" onclick="return confirm(&quot;Confirm delete?&quot;)">
                              Delete
                            </button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                {{ $employees->links() }}
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- <div class="flex space-x-2 justify-center">
        <a type="button" href="{{url('/simulatePlastics')}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
          Send 200 pieces to Plastics today
        </a>
        <a type="button" href="{{url('/simulatePlastics')}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
          Empty Plastics
        </a>
      </div> --}}

      {{-- <script>
        if ({{$message}} != ""){
          window.alert($message);
        }
      </script> --}}
@endrole
@role('employee')
@php
  $id = Auth::user()->id;
@endphp
<script>window.location = "/employee/<?php echo $id; ?>";</script>
@endrole
@endsection