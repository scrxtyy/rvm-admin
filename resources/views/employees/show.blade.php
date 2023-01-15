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
                <a href="#pet">
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

<br><br>
<div id="pet"></div>
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
  <h2 class="py-4 text-gray-600 dark:text-gray-400">PET Bottles</h2> 
  <x-button target="_blank" href="#" variant="black" class="items-center max-w-xs gap-2">
    <span>Total: {{$plasticweight*10}} KG / 10 KG</span>
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
                @foreach($plasticsLog as $plasticsLog)
                    <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{$plasticsLog->created_at}}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{$plasticsLog->kg_Weight}}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{$plasticsLog->pieces}}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{$plasticsLog->price}}
                        </td>
                    </tr>
              @endforeach
            </tbody>
            {{-- {{ $plasticsLog->links() }} --}}
          </table>
        </div>
      </div>
    </div>
  </div>


  
<br><br>
<div id="tincans"></div>
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
  <h2 class="py-4 text-gray-600 dark:text-gray-400">Tin Cans</h2> 
  <x-button target="_blank" href="#" variant="black" class="items-center max-w-xs gap-2">
    <span>Total: {{$cansweight*10}} KG / 10 KG</span>
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
                  @foreach($cansLog as $cansLog)
                      <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">  
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          {{$cansLog->created_at}}
                      </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$cansLog->kg_weight}} KG
                          </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$cansLog->pieces}}
                          </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$cansLog->price}} PHP
                          </td>
                      </tr>
                @endforeach
              </tbody>
              {{-- {{ $cansLog->links() }} --}}
            </table>
          </div>
        </div>
      </div>
    </div>

<br><br>
<div id="coins"></div>
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
  <h2 class="py-4 text-gray-600 dark:text-gray-400">Coins</h2> 
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
                  @foreach($coinTable as $coinTable)
                      <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          {{$coinTable->created_at}}
                      </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$coinTable->coins_in}} PHP
                          </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$coinTable->coins_out}} PHP
                          </td>
                      </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

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
