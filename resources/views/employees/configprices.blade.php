@extends('employees.dashboard')

@section('content')

@if( session('message') )
  <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
    {{session('message')}}
    {{session()->forget('message')}}
  </div>
@endif

@if( session('incorrect') )
  <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
    {{session('incorrect')}}
    {{session()->forget('incorrect')}}
  </div>
@endif
<span class="mb-2 font-semibold">CURRENT DATA:</span>

    @foreach ($grams as $item)
    <div class="flex flex-wrap w-1/2 -mx-3 mb-2">
      <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
            PLASTICS: 
          </label>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
            TIN CANS:  
          </label>
      </div>
    </div>
    <div class="flex flex-wrap w-1/2 -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="appearance-none block w-15 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" for="addedcoins">
        {{$item->plasticgrams}}g / 1 PHP
        </label>
      </div>
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="appearance-none block w-15 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" for="addedcoins">
          {{$item->tincangrams}}g / 1 PHP
        </label>
      </div>
    </div>
    @endforeach

 <span class="mb-2 font-semibold">UPDATE:</span>
  <form action="{{url('/updatePrice')}}" method="get">
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
     
        {!! csrf_field() !!}
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
          Select waste price to configure:
        </label>
        <select class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
        aria-label="Default select example" id="waste" name="waste" placeholder="Select Waste" required>
          <option value="plasticgrams">Plastics</option>
          <option value="tincangrams">Tin Cans</option>
        </select>
    </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="addedcoins">
            Grams per 1 PHP:
          </label>
          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
          id="gramsperpiso" type="number" name="gramsperpiso" placeholder="g" required>
    </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="addedcoins">
            Please enter admin password:
          </label>
          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
          id="password" type="password" name="password" placeholder="********" required>
    </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <button type="submit" class="inline-block px-6 py-2.5 bg-green-600 text-white font-large text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
          Update
        </button>
      </div>
    </div>
  </form>

<script>
</script>
@endsection