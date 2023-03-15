@extends('employees.dashboard')

@section('content')
@if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
  <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="text-xl font-semibold leading-tight">
          {{ __('RVMs') }}
      </h2>

      <a href="{{ url('/rvm/create') }}" class="btn btn-success btn-sm" title="Add New RVM">   
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
                <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      RVM ID
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Location
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      
                    </th>
                  </tr>
                </thead class="border-b">
                <tbody>
                  @foreach($allRvms as $item)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->rvm_id }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{ $item->location }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        
                            <a href="{{ url('/rvm/' . $item->rvm_id) }}" title="View RVM">
                            <button type="submit" class="inline-block px-5 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out" title="View RVM">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                            </button>
                            </a>
                          
                          <form method="POST" action="{{ url('/rvm' . '/' . $item->rvm_id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="inline-block px-5 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" title="Delete RVM" onclick="return confirm(&quot;Confirm delete?&quot;)">
                              <svg fill="none" stroke="currentColor" class="w-4 h-4" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                              </svg>
                            </button>
                        </form>
                         
                        </td>
                    </tr>
                  @endforeach
                </tbody>
                {{ $allRvms->links() }}
              </table>
            </div>
          </div>
        </div>
      </div>

@endif

@endsection