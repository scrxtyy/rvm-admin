@extends('employees.dashboard')

@section('content')
  
  @php
        $rvm = App\Models\Rvms::oldest()->first();   
        $lastrvmid = $rvm->rvm_id;
  @endphp
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

  <form class="w-full max-w-lg" action="{{route('rvm')}}" method="post">
    @if ($errors->any())
      <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
          @foreach ($errors->all() as $error)
              {{ $error }}
          @endforeach
      </div>
    @endif
    @csrf
    <div class="flex flex-wrap -mx-3 mb-6" >
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-name">
          RVM ID
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" name="rvm_id" id="rvm_id">

      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Barangay
        </label>  
            <div className="w-72">
              <Select label="Select Barangay" class="appearance-none block w-72 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="barangay" name="barangay">
                <Option>Aplaya</Option>
                <Option>Balibago</Option>
                <Option>Caingin</Option>
                <Option>Dila</Option>
                <Option>Dita</Option>
                <Option>Don Jose</Option>
                <Option>Ibaba</Option>
                <Option>Kanluran</Option>
                <Option>Labas</Option>
                <Option>Macabling</Option>
                <Option>Malitlit</Option>
                <Option>Malusak</Option>
                <Option>Market Area</Option>
                <Option>Pooc</Option>
                <Option>Pulong Santa Cruz</Option>
                <Option>Santo Domingo</Option>
                <Option>Sinalhan</Option>
                <Option>Tagapo</Option>
              </Select>
            </div>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              City
            </label> 
            <div className="w-72">
              <Select label="Select City" class="appearance-none block w-72 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="city" name="city">
                <Option>Sta. Rosa</Option>
              </Select>
            </div>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Province
            </label> 
              <div className="w-72">
              <Select label="Select Province" class="appearance-none block w-72 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="province" name="province">
                <Option>Laguna</Option>
              </Select>
            </div>
        {{-- <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="location" name="location" type="text" required> --}}
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
  
  <script>
    window.onload = function generateCode() {
     var prefix = "RVM-";
     var code = prefix + Math.floor(Math.random() * 100000);
     document.getElementById("rvm_id").value = code;
   }
 </script>
@endsection