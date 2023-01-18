@extends('employees.dashboard')

@section('assign')
  
  @php
        $rvm = App\Models\User::whereNotNull('rvm_id')->latest()->first();   
        $rvmid = $rvm->rvm_id;
        $lastrvmid = $rvmid + 1;
  @endphp

  <form action="/insertassign" method="get">
    <input type="hidden" value="{{$id}}" name="id">
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        {!! csrf_field() !!}
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
          Name
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name="name" id="name" placeholder="Name" required>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
          Task Description
        </label>
        <textarea
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
          rows="3"
          placeholder="Describe the Task" 
          name="description" required></textarea>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
          Task Deadline
        </label>
        <input type="date"
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
        placeholder="Select a date" name="deadline"/>  
      </div>
    </div>

    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <button type="submit" class="inline-block px-6 py-2.5 bg-purple-600 text-white font-large text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out">
          Send Notification
        </button>
      </div>
    </div>
    
  </form>

@endsection