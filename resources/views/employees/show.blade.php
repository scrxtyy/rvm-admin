@extends('employees.dashboard')

@section('content')
 

<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
  <h2 class="text-xl font-semibold leading-tight">
      {{ __('Reverse Vending Machines') }}
  </h2>

  <h3 class="font-medium leading-tight text-3xl mt-0 mb-2 text-blue-600">{{ $employees->first_name." ".$employees->last_name }}</h3>

        <h5 class="card-title">Name : </h5>
        <p class="card-text">Email : {{ $employees->email }}</p>
        <p class="card-text">Password : {{ $employees->password }}</p>
  </a>
</div>

