@extends('employees.dashboard')

@section('content')
<div id="my-element"></div>
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
  <h3 class="text-xl font-semibold leading-tight">
      RVM ID: RVM{{ $employees->rvm_id}}
  </h3>
  <h2 class="text-xl font-semibold leading-tight">
    Employee name: {{ $employees->name }}
  </h2>
  <h2 class="card-text">
    Email: {{ $employees->email }}
  </h2>
  </a>
  @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
  <form class="max-w-lg" action="/assign/{{$employees->id}}" method="get">
    <button type="submit" href="{{ url('/assign/' . $employees->id) }}" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
      Assign Task to <b>RVM {{$employees->rvm_id}}</b>
    </button>
  </form>
      
  <p> No Records Found. </p>
  @endif
</div>


@endsection
