@extends('employees.dashboard')

@section('content')
  
  @php
        $rvm = App\Models\User::whereNotNull('id')->latest()->first();   
        $id = $rvm->id;
        $lastrvmid = $id + 1;
  @endphp

  <form class="w-full max-w-lg" action="{{ url('dashboard') }}" method="post">
    @if ($errors->any())
      <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
          @foreach ($errors->all() as $error)
              {{ $error }}
          @endforeach
      </div>
    @endif
    {!! csrf_field() !!}
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Employee ID
        </label>       
        <label class="block uppercase tracking-wide text-gray-700 text-l font-medium mb-2" for="grid-password">
          {{$lastrvmid}}
        </label>   
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="rvm" name="rvm" type="hidden" value="{{$lastrvmid}}">
        {{-- <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p> --}}
      </div>
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Assign RVMs
        </label> 
        <div class="flex justify-center">
          <select class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          name="rvmid">       
            @foreach ($allRvms as $item)
                <option value="{{$item->rvm_id}}">{{$item->rvm_id}}</option>
            @endforeach
        </select>
        </div>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
          Name
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name="name" id="name" placeholder="Jane Doe" required>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Email
        </label>        
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" name="email" type="email" required>
        {{-- <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p> --}}
      </div>
   </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Password
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
        name="password" id="password" type="password" placeholder="">
        <p class="text-gray-600 text-xs italic">Minimum of 8 characters</p>
      </div>
      <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password_confirmation">
          Confirm Password
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
        id="password_confirmation" name="password_confirmation" type="password" placeholder="">
      </div>
    </div>
   <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
      <button type="submit" class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
        Add
      </button>
    </div>
 </div>
  </form>
@endsection