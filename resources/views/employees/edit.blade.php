@extends('employees.dashboard')

@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Edit Student</div>
  <div class="card-body">
       
      <form action="{{ url('student/' .$employees->rvm_id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$employees->rvm_id}}" id="id" />
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$employees->name}}" class="form-control"></br>
        <label>Email</label></br>
        <input type="email" name="address" id="address" value="{{$employees->email}}" class="form-control"></br>
        <label>Password</label></br>
        <input type="password" name="mobile" id="mobile" value="{{$employees->password}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
    
  </div>
</div>
  
@stop