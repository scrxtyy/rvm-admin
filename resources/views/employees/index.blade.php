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
                  <input type="text" name="search" placeholder="Search Employees"  class="
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
                      Employee ID
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Name
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Email
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Assign RVM ID
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
                      {{ $item->id }}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{ $item->name }}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{$item->email}}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{$item->rvm_id}}
                    </td>
                    {{-- <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{ substr($item->password, 0, 8)."..." }}
                    </td>  --}}
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        <a href="{{ url('/employee/' . $item->id) }}" title="View RVM">
                          <button class="inline-block px-4 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            
                          </button>
                        </a>
                        <a href="{{ url('/employee/' . $item->id . '/edit') }}" title="Edit Employee">
                          <button class="inline-block px-4 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            
                          </button>
                        </a>

                        <form method="POST" action="{{ url('/dashboard' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="inline-block px-4 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" title="Delete Employee" onclick="return confirm(&quot;Confirm delete?&quot;)">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                              </svg>
                              
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
@endrole

@role('employee')
@php
  $id = Auth::user()->id;
@endphp
<script>window.location = "/employee/<?php echo $id; ?>";</script>
@endrole
@endsection