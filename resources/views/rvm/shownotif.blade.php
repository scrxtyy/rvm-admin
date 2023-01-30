@extends('rvm.employeedashboard')

@section('content')

<!-- Jumbotron -->
<div class="p-6 shadow-lg rounded-lg bg-white text-gray-700">
    <h2 class="font-semibold text-3xl mb-5">{{$notif->message}}</h2>
    <p><span class="font-bold">Task ID: </span> {{$notif->id}} <br>
    <span class="font-bold">Received at: </span> {{$notif->created_at}}</p>
    
    <hr class="my-6 border-gray-300" />
    <h4 class="font-bold text-xl mb-2">Description:</h4>
    @isset($notif->coin_amount)
        <p><span class="font-bold">Coins to be added: </span> {{$notif->coin_amount}}.00 PHP</p>
    @endisset
    <p><span class="font-bold">Submit proof before: </span> {{$notif->deadline}}</p>
    <p><span class="font-bold">Status: </span> 
        @if (isset($notif->status))
            <span class="text-green-500">{{$notif->status}}</span>
        @else
            <span class="text-yellow-500">Incomplete</span>
        @endif
    </p>
    <button
      type="button"
      class="inline-block px-6 py-2.5 mt-4 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-mdb-ripple="true"
      data-mdb-ripple-color="light" data-bs-toggle="modal" data-bs-target="#modalopen"
    >
      Submit proof
    </button>
  </div>
  <!-- Jumbotron -->

  
  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
  id="modalopen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog relative w-auto pointer-events-none">
    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
      <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Task Details</h5>
        <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
          data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body relative p-4">
        <form action="{{url('/uploadProof')}}" enctype="multipart/form-data" method="post">
          <input type="hidden" name="id" value="{{$notif->id}}">
          <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Please upload proof: </label>
          <input class="form-control
          block
          w-full
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
          m-0
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
          type="file" id="proof" name="proof">
          <button type="submit" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
            Mark as Done</button>                        
        </form>
      </div>
      {{-- <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
        <button type="button" class="px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md
          hover:bg-purple-700 hover:shadow-lg
          focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-purple-800 active:shadow-lg
          transition
          duration-150
          ease-in-out">Mark as done</button>
      </div> --}}
    </div>
  </div>
</div>
@endsection