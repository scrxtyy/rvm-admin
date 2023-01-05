@extends('employees.dashboard')

@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header"></div>
  <div class="card-body">
        <div class="card-body">
        <h5 class="card-title">Name : {{ $employees->name }}</h5>
        <p class="card-text">Email : {{ $employees->email }}</p>
        <p class="card-text">Password : {{ $employees->password }}</p>
  </div>
  </div>
</div>