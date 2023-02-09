@extends('employees.dashboard')

@section('content')
 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>        
<style>
    #chart-wrapper {
      display: inline-block;
      position: relative;
      width: 100%;
    }
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
  @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
  <form class="max-w-lg" action="/assign/{{$employees->id}}" method="get">
    <button type="submit" href="{{ url('/assign/' . $employees->id) }}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
      Assign Task to <b>RVM {{$employees->rvm_id}}</b>
    </button>
    </form>
      
  {{-- <form action="{{url('/testupdate')}}" method="get">
    @csrf
    <button type="submit" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
    id="trigger-event">
      Trigger event</b>
    </button>
  </form> --}}
  @endif
</div>
{{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  <div class="p-6 text-gray-900">
    <center>
      <div class="wrapper">
          <div class="card">
            <div class="circle">
              <div class="bar"></div>
              <a href="#">
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
    </center>
  </div>
</div> --}}

{{-- <div class="flex items-center justify-center">
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
</div> --}}
<ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab"
  role="tablist">

  {{-- Plastic Bottles --}}
  <li class="nav-item" role="presentation">
    <a href="#tabs-home" class="
      nav-link
      block
      font-medium
      text-xs
      leading-tight
      uppercase
      border-x-0 border-t-0 border-b-2 border-transparent
      px-6
      py-3
      my-2
      hover:border-transparent hover:bg-gray-100
      focus:border-transparent
      active
    " id="tabs-home-tab" data-bs-toggle="pill" data-bs-target="#tabs-home" role="tab" aria-controls="tabs-home"
      aria-selected="true">Plastics</a>
  </li>

  {{--Tin cans--}}
  <li class="nav-item" role="presentation">
    <a href="#tabs-profile" class="
      nav-link
      block
      font-medium
      text-xs
      leading-tight
      uppercase
      border-x-0 border-t-0 border-b-2 border-transparent
      px-6
      py-3
      my-2
      hover:border-transparent hover:bg-gray-100
      focus:border-transparent
    " id="tabs-profile-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile" role="tab"
      aria-controls="tabs-profile" aria-selected="false">Tin Cans</a>
  </li>

  {{-- Coins --}}
  <li class="nav-item" role="presentation">
    <a href="#tabs-messages" class="
      nav-link
      block
      font-medium
      text-xs
      leading-tight
      uppercase
      border-x-0 border-t-0 border-b-2 border-transparent
      px-6
      py-3
      my-2
      hover:border-transparent hover:bg-gray-100
      focus:border-transparent
    " id="tabs-messages-tab" data-bs-toggle="pill" data-bs-target="#tabs-messages" role="tab"
      aria-controls="tabs-messages" aria-selected="false">Coins</a>
  </li>
</ul>

<div class="tab-content" id="tabs-tabContent">

  {{-- PLASTIC BOTTLES TAB --}}
  <div class="tab-pane fade show active" id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="font-medium leading-tight text-2xl mt-0 mb-2 text-gray-600">Plastic Bottles</h2>
      <x-button target="_blank" href="#" variant="black" class="items-center max-w-xs gap-2">
        <span>Total: {{$totalplastic}} KG / 10 KG</span>
      </x-button>
    </div>
    
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Date/Time
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Item/s Weight
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      No. of Item/s
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Price of Item/s
                    </th>
    
                  </tr>
                </thead>
                <tbody>
                    @foreach($plasticsLog as $plasticLog)
                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$plasticLog->created_at}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$plasticLog->kg_Weight}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$plasticLog->pieces}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$plasticLog->price}}
                            </td>
                        </tr>
                  @endforeach
                </tbody>
                {{ $plasticsLog->links() }}
              </table>
            </div>
          </div>
        </div>
      </div>
      <br><br>
      Plastic Bottles Data Chart (kg per day): <br>
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div id="chart-wrapper">
          <canvas id="chart1"></canvas>
        </div>
      </div>

  </div>

  {{-- TIN CANS TAB --}}
  <div class="tab-pane fade" id="tabs-profile" role="tabpanel" aria-labelledby="tabs-profile-tab">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="font-medium leading-tight text-2xl mt-0 mb-2 text-gray-600">Tin Cans</h2>
        <x-button target="_blank" href="#" variant="black" class="items-center max-w-xs gap-2">
          <span>Total: {{$totaltincans}} KG / 10 KG</span>
        </x-button>
      </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Date/Time
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Item/s Weight
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      No. of Item/s
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Price of Item/s
                    </th>

                  </tr>
                </thead>
                <tbody>
                    @foreach($cansLog as $canLog)
                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">  
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{$canLog->created_at}}
                        </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$canLog->kg_weight}} KG
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$canLog->pieces}}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$canLog->price}} PHP
                            </td>
                        </tr>
                  @endforeach
                </tbody>
                {{ $cansLog->links() }}
              </table>
            </div>
          </div>
        </div>
      </div>
        <br><br>
        Tin Cans Data Chart (kg per day):
        <br>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          <div id="chart-wrapper">
            <canvas id="chart2"></canvas>
          </div>
        </div>

  </div>

  {{-- COINS TAB --}}
  <div class="tab-pane fade" id="tabs-messages" role="tabpanel" aria-labelledby="tabs-profile-tab">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="font-medium leading-tight text-2xl mt-0 mb-2 text-gray-600">Coins</h2>
      <x-button target="_blank" href="#" variant="black" class="items-center max-w-xs gap-2">
        <span>Total: {{$currentCoins}} PHP / 200 PHP</span>
      </x-button>
    </div>

    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full">
              <thead class="border-b bg-gray-800">
                <tr>
                  
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Date/Time
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Coins IN
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Coins OUT
                  </th>
                </tr>
              </thead>
              <tbody>
                  @foreach($coinTable as $coinsTable)
                      <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          {{$coinsTable->created_at}}
                      </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$coinsTable->coins_in}} PHP
                          </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$coinsTable->coins_out}} PHP
                          </td>
                      </tr>
                @endforeach
              </tbody>
              {{$coinTable->links()}}
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

<br><br><br>

  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('b89eb6a948d95cf92f3b', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('update-element');
    channel.bind('notif', function(data) {
      toastr.success(JSON.stringify(data.notify));
    });
    
    const ctx1 = document.getElementById('chart1');
    // ctx.canvas.width = 300;
    // ctx.canvas.height = 300;  
    new Chart(ctx1, {
      type: 'bar',
      data: {
        labels: [
          @foreach($plasticBars as $plasticBar)
            '{{$plasticBar->date}}',
          @endforeach
        ],
        datasets: [{
          label: 'KG of plastic bottles per day',
          data: [@foreach($plasticBars as $plasticBar)
            '{{$plasticBar->count}}',
          @endforeach],
            backgroundColor: [@foreach($plasticBars as $plasticBar)
                'rgba(152, 62, 203, 0.2)',
            @endforeach],
            borderColor: [@foreach($plasticBars as $plasticBar)
                'rgba(152, 62, 203, 1)',
                @endforeach],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    const ctx2 = document.getElementById('chart2');
    // ctx.canvas.width = 300;
    // ctx.canvas.height = 300;  
    new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: [
          @foreach($tinBars as $tinBar)
            '{{$tinBar->date}}',
          @endforeach
        ],
        datasets: [{
          label: 'KG of tin cans per day',
          data: [
            @foreach($tinBars as $tinBar)
              '{{$tinBar->count}}',
            @endforeach
          ],
          backgroundColor: [@foreach($tinBars as $tinBar)
                'rgba(152, 62, 203, 0.2)',
            @endforeach],
            borderColor: [@foreach($tinBars as $tinBar)
                'rgba(152, 62, 203, 1)',
                @endforeach],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });


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
</script>

@endsection
