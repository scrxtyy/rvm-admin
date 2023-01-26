@extends('employees.edit')

@section('edit')

@php
     $id = Auth::user()->id; 
@endphp


Change Password

<form action="{{route('changePassword')}}" method="post">
    <br>
    @csrf
    @if(session('success'))
        <h1>{{session('success')}}</h1>
    @endif
 

    <input type="hidden" name="id" value="{{$employees->id}}">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
    @if ($errors->any())
        <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
            <ul class="list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Old Password
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
        name="current_password" id="current_password" type="password" placeholder="******************" required>

        {{-- <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p> --}}
    </div>
    <div class="w-full md:w-1/2 px-3">
        <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-purple-600 checked:border-purple-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" 
        type="checkbox" id="showOldPassword">
        <label class="block uppercase tracking-wide text-gray-700 text-xs mb-2" for="showOldPassword">
            Show Old Password
        </label>
        {{-- @error('current_password')
            <div class="text-red-700 mb-2 mt-2">{{ $message }}</div>
        @enderror --}}
    </div>

    <br>

    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        New Password
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
        name="new_password" id="new_password" type="password" placeholder="******************" required>

        {{-- <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p> --}}
    </div>
    <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password_confirmation">
        Confirm Password
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
        id="new_password_confirmation" name="new_password_confirmation" type="password" placeholder="******************" required>
    </div>
    <div class="w-full md:w-1/2 px-3 mt-3">
        <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-purple-600 checked:border-purple-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" 
        type="checkbox" value="" id="showNewPassword">
        <label class="block uppercase tracking-wide text-gray-700 text-xs mb-2" for="flexCheckDefault">
            Show New Password
        </label>
        {{-- @error('new_password')
            <div class="text-red-700 mb-2 mt-2">{{ $message }}</div>
        @enderror --}}
    </div>

    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <button type="submit" value="Add" class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out">
            Save
          </button>
        </div>
      </div>
</form>
<script>
    window.addEventListener("DOMContentLoaded", function () {
    const toggleOldPassword = document.querySelector("#showOldPassword");
    const password = document.querySelector("#current_password");

    const toggleNewPassword = document.querySelector("#showNewPassword");
    const new_password = document.querySelector("#new_password");
    const confirm_new_password = document.querySelector("#new_password_confirmation");

    toggleOldPassword.addEventListener("click", function (e) {
        const type =
        password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
    });

    
    toggleNewPassword.addEventListener("click", function (e) {
        const type =
        new_password.getAttribute("type") === "password" ? "text" : "password";
        new_password.setAttribute("type", type);

        confirm_new_password.getAttribute("type") === "password" ? "text" : "password";
        confirm_new_password.setAttribute("type", type);
    });

    });


</script>
    
@endsection