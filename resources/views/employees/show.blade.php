@extends('employees.dashboard')

@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Students Page</div>
  <div class="card-body">
        <div class="card-body">
        <h5 class="card-title">Name : {{ $employees->name }}</h5>
        <p class="card-text">Address : {{ $employees->address }}</p>
        <p class="card-text">Mobile : {{ $employees->mobile }}</p>
  </div>
  </div>
</div>