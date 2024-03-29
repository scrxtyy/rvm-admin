@extends('employees.dashboard')

@section('content')
    
  @if( session('message') )
  <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
    {{session('message')}}
    {{ session()->forget('message') }}
  </div>
  @endif

  <form class="w-full max-w-lg" action="{{ url('rvm/' .$rvms->rvm_id) }}" method="post">
    {!! csrf_field() !!}
    @method("PATCH")
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
            RVM ID
          </label>
          <label class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" name="rvm_id" id="rvm_id">
            {{$rvms->rvm_id}}
          </label>
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Location
          </label>        
          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="location" name="location" type="text" 
          value="{{$rvms->location}}">
           </div>
     </div>
     <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <button type="submit" class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
                Save
            </button>
      </div>
   </div>
</form>

@endsection