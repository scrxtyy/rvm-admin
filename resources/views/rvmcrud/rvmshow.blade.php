@extends('employees.rvms')

@section('rvm')
    RVM Show

    rvm id: {{$rvms->rvm_id}}
    location: {{$rvms->location}}
@endsection