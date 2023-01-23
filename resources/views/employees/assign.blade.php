@extends('employees.dashboard')

@section('assign')
  
  @php
        $rvm = App\Models\User::whereNotNull('rvm_id')->latest()->first();   
        $rvmid = $rvm->rvm_id;
        $lastrvmid = $rvmid + 1;
  @endphp

  <form action="{{url('/insertassign')}}" method="post">
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        @isset($message)
          <div class="flex flex-col">
            <div class="bg-{{$color}}-100 rounded-lg py-5 px-6 mb-4 text-base text-{{$color}}-700 mb-3" role="alert">
              {{$message}}
            </div>
          </div>
        @endisset
        {!! csrf_field() !!}
        <input type="hidden" value="{{$id}}" name="id">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
          Name
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name="name" id="name" value="{{$name}}" required>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
          Task Description
        </label>

          <select class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
          aria-label="Default select example" id="selectTask" name="selectTask" placeholder="Select Task">
            <option selected></option>
            <option value="Empty Plastics">Empty PLASTICS Storage</option>
            <option value="Empty Tincans">Empty TINCANS Storage</option>
            <option value="Replenish Coins">Replenish COINS</option>
        </select>
        <br>
        <div id="addcoins" style="display:none;">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="addedcoins">
          Amount of coins in Pesos:
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
        id="addedcoins" type="number" name="coinsamt" placeholder="₱">
        </div>
        <br>
        <textarea
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
        rows="3"
        placeholder="Add Notes" 
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
        placeholder="Select a date" name="deadlinedate"/> 
        <input type="time"
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
        placeholder="Select a time" name="deadlinetime" step="1"/>  
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

<script>
  document.getElementById("selectTask").onchange = function() {
    if (this.value === "Replenish Coins") {
      document.getElementById("addcoins").style.display = "block";
    } else {
      document.getElementById("addcoins").style.display = "none";
    }
  }
</script>
@endsection