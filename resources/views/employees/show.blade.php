@extends('employees.dashboard')

@section('content')
 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>        
<style>
    body{
      scroll-behavior: smooth!important;
    }
    .wrapper{
    width: 800px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    }
    .wrapper .card{
    background: #fff;
    width: calc(33% - 10px);
    height: 300px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    flex-direction: column;
    box-shadow: 0px 10px 15px rgba(0,0,0,0.1);
    }
    .wrapper .card .circle{
    position: relative;
    height: 150px;
    width: 150px;
    border-radius: 50%;
    cursor: default;
    }
    .card .circle .box,
    .card .circle .box span{
    position: absolute;
    top: 50%;
    left: 50%;
    }
    .card .circle .box{
    height: 100%;
    width: 100%;
    background: #fff;
    border-radius: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    transition: all 0.2s;
    }
    .card .circle:hover .box{
    transform: translate(-50%, -50%) scale(0.91);
    }
    .card .circle .box span,
    .wrapper .card .text{
    background: -webkit-linear-gradient(left, #581b81, #5e286e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    }
    .circle .box span{
    font-size: 38px;
    font-family: sans-serif;
    font-weight: 600;
    transform: translate(-45%, -45%);
    transition: all 0.1s;
    }
    .card .circle:hover .box span{
    transform: translate(-45%, -45%) scale(1.09);
    }
    .card .text{
    font-size: 20px;
    font-weight: 600;
    }
    @media(max-width: 753px){
    .wrapper{
        max-width: 700px;
    }
    .wrapper .card{
        width: calc(50% - 20px);
        margin-bottom: 20px;
    }
    }
    @media(max-width: 505px){
    .wrapper{
        max-width: 500px;
    }
    .wrapper .card{
        width: 100%;
    }
    }
</style>

<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
  <h3 class="text-xl font-semibold leading-tight">
      RVM ID: RVM{{ $employees->rvm_id}}
  </h3>
  <h2 class="text-xl font-semibold leading-tight">
    Employee name: {{ $employees->name }}
  </h2>
  <h2 class="card-text">
    Email: {{ $employees->email }}
  </h2>
  </a>
</div>
<br><br>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  <div class="p-6 text-gray-900">
      <div class="wrapper">
          <div class="card">
            <div class="circle">
                <div class="bar"></div>
                <a href="route('employee/{{$employees->id}}/plastics')">
                  <div class="box"><span></span></div>
                </a>
            </div>
          <div class="text">Plastic</div>
        </div>

      <div class="card js">
          <div class="circle">
            <div class="bar"></div>
              <a href="#tincans">
                <div class="box"><span></span></div>
              </a>
          </div>
          <div class="text">Tin Cans</div>
        </div>

        <div class="card react">
          <div class="circle">
            <div class="bar"></div>
              <a href="#coins">
                <div class="box"><span></span></div>
              </a>
          </div>
          <div class="text">Coins</div>
        </div>
        
      </div>
  </div>
</div>
<div class="flex items-center justify-center">
  <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="group">
    <a
      href="{{ url('/employee/' . $employees->id . '/plastics#down')}}"
      aria-current="page"
      class="
        rounded-l
        px-6
        py-2.5
        bg-blue-600
        text-white
        font-medium
        text-xs
        leading-tight
        uppercase
        hover:bg-blue-700
        focus:bg-blue-700 focus:outline-none focus:ring-0
        active:bg-blue-800
        transition
        duration-150
        ease-in-out
      "
    >
      Plastics
    </a>
    <a
    href="{{ url('/employee/' . $employees->id . '/tincans#down')}}"
      class="
        px-6
        py-2.5
        bg-blue-600
        text-white
        font-medium
        text-xs
        leading-tight
        uppercase
        hover:bg-blue-700
        focus:bg-blue-700 focus:outline-none focus:ring-0
        active:bg-blue-800
        transition
        duration-150
        ease-in-out
      "
    >
      Tin Cans
    </a>
    <a
    href="{{ url('/employee/' . $employees->id . '/coins#down')}}"
      class="
        rounded-r
        px-6
        py-2.5
        bg-blue-600
        text-white
        font-medium
        text-xs
        leading-tight
        uppercase
        hover:bg-blue-700
        focus:bg-blue-700 focus:outline-none focus:ring-0
        active:bg-blue-800
        transition
        duration-150
        ease-in-out
      "
    >
      Coins
    </a>
  </div>
</div>

<div id="down"></div>

  @yield('logs')

<script>
    let options = {
    startAngle: -1.55,
    size: 150,
    value: {{$plastic}},
    fill: {gradient: ['#581b81', '#5e286e']}
    }
    $(".circle .bar").circleProgress(options).on('circle-animation-progress',
    function(event, progress, stepValue){
    $(this).parent().find("span").text(String(stepValue.toFixed(2).substr(2)) + "%");
    });
    $(".js .bar").circleProgress({
    value: {{$tincans}}
    });
    $(".react .bar").circleProgress({
    value: {{$coins}}
    });

    // setInterval(function(){
    // $.get('/dashboard', function(){
    // $(".circle .bar").circleProgress({value: {{$plastic}}});
    // $(".js .bar").circleProgress({ value: {{$tincans}}});
    // $(".react .bar").circleProgress({ value: {{$coins}}});
    // });
    // }, 10000);
</script>

@endsection
