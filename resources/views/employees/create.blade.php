@extends('employees.dashboard')

@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Create New Employees</div>
  <div class="card-body">
       
      <form action="{{ url('employee') }}" method="post">
        {!! csrf_field() !!}
        <label>Name</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <label>Email</label></br>
        <input type="email" name="email" id="address" class="form-control"></br>
        <label>Password</label></br>
        <input type="password" name="mobile" id="password" class="form-control"></br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
    
  </div>
</div>
  
@stop

@endsection