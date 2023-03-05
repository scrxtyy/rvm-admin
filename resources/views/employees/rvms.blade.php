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
                <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      RVM ID
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Location
                    </th>
                  </tr>
                </thead class="border-b">
                <tbody>
                  @foreach($rvms as $item)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->rvm_id }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{ $item->location }}
                        </td>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
                {{ $rvms->links() }}
              </table>
            </div>
          </div>
        </div>
      </div>

@endif

@endsection