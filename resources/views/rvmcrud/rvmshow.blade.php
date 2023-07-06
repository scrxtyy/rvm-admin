@extends('employees.dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>        
<style>
    #chart-wrapper {
      display: inline-block;
      position: relative;
      width: 90%;
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
<div id="my-element"></div>
<div class="flex flex-col gap-4 md:flex-row md:items-center">
  <h3 class="text-xl font-semibold leading-tight">
      <b>RVM ID:</b> RVM{{ $rvms->rvm_id}}
  </h3>
  <h2 class="text-xl font-semibold leading-tight">
    <b> Location:</b> {{ $rvms->location }}
  </h2>
  </a>
  {{-- @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
  <form class="max-w-lg" action="/assign/{{$employees->id}}" method="get">
    <button type="submit" href="{{ url('/assign/' . $employees->id) }}" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
      Assign Task to <b>RVM {{$employees->rvm_id}}</b>
    </button>
    </form>
      
  @endif --}}
  <div class="tr-position-absolute">
    <a href="{{ url('/rvm/' . $rvms->rvm_id . '/edit') }}" title="Edit RVM">
      <button class="inline-block px-4 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>
        
      </button>
    </a>

  <form method="POST" action="{{ url('/rvm' . '/' . $rvms->rvm_id) }}" accept-charset="UTF-8" style="display:inline">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" class="inline-block px-4 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" title="Delete RVM" onclick="return confirm(&quot;Confirm delete?&quot;)">
      <svg fill="none" stroke="currentColor" class="w-4 h-4" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
      </svg>
    </button>
  </form>
</div>
</div>

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
      <label class="rounded items-center max-w-xs gap-2 bg-black text-white p-4">
        @if($totalplastic)
          @if(is_null($totalplastic->total_kg))
              <p>No records found.</p>
          @else
              {{-- Display your data here --}}
              Total:<span id="plastictotal"> {{ number_format($totalplastic->total_kg,2) }}</span> KG / 5 KG
          @endif
        @else
            <p>No records found.</p>
        @endif
      </label>
    </div>
    
    <div class="flex flex-col">
      <br><br>
      Plastic Bottles Data Chart (kg per day): <br>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          <div id="chart-wrapper">
            <canvas id="chart1"></canvas>
          </div>
        </div>
     

        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <form action="{{url('/downloadplasticsLogs')}}" method="get">
              @csrf
              <label class="uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="status">
                Start Date
              </label>     
              <input type="date" class="peermin-h-[auto] w-25 outline-gray rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
              placeholder="Select a date" name="startDate" required/>
              <b> | </b>
              <label class="uppercase tracking-wide text-gray-700 text-xs py-2 font-bold mt-2" for="status">
                End Date
              </label>     
              <input type="date" class="peer min-h-[auto] w-25 rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
              placeholder="Select a date" name="endDate" required/>
              <x-button type="submit">Download PDF</x-button>
            </form>
            <div class="overflow-hidden">
              <table id = " " class="min-w-full" style="width:100%">
                <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      ID
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Item/s Weight (grams)
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Price of Item/s
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Date/Time
                    </th>
                  </tr>
                </thead>
                @if ($plasticsLog->isEmpty())
                    <tr style="colspan:4">No records Found.</tr>
                @else
                  <tbody id="plastic-tbody">
                      @foreach($plasticsLog as $plasticLog)
                          <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                  {{$plasticLog->id}}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                  {{$plasticLog->kg_Weight*1000}}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$plasticLog->price}}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$plasticLog->created_at}}
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                  {{ $plasticsLog->links() }}
                @endif
               
                
              </table>
            </div>
          </div>
        </div>
      </div>

  </div>

  {{-- TIN CANS TAB --}}
  <div class="tab-pane fade" id="tabs-profile" role="tabpanel" aria-labelledby="tabs-profile-tab">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="font-medium leading-tight text-2xl mt-0 mb-2 text-gray-600">Tin Cans</h2>
        <label class="rounded items-center max-w-xs gap-2 bg-black text-white p-4">
          @if($totaltincans)
            @if(is_null($totaltincans->total_kg))
                <p>No records found.</p>
            @else
                {{-- Display your data here --}}
                Total:<span id="tincanstotal"> {{ number_format($totaltincans->total_kg,2) }}</span> KG / 5 KG
            @endif
          @else
              <p>No records found.</p>
          @endif
        </label>
      </div>
    <div class="flex flex-col">
      <br><br>
      Tin Cans Data Chart (grams per day):
      <br>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          <div id="chart-wrapper">
            <canvas id="chart2"></canvas>
          </div>
        </div>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
              <form action="{{url('/downloadtincansLogs')}}" method="get">
                @csrf
                <label class="uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="status">
                  Start Date
                </label>     
                <input type="date" class="peermin-h-[auto] w-25 outline-gray rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                placeholder="Select a date" name="startDate" required/>
                <b> | </b>
                <label class="uppercase tracking-wide text-gray-700 text-xs py-2 font-bold mt-2" for="status">
                  End Date
                </label>     
                <input type="date" class="peer min-h-[auto] w-25 rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                placeholder="Select a date" name="endDate" required/>
                <x-button type="submit">Download PDF</x-button>
              </form>
            <div class="overflow-hidden">
              <table id = " " class="min-w-full">
                <thead class="border-b bg-gray-800">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      ID
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Item/s Weight (grams)
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Price of Item/s
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Inserted at:
                    </th>

                  </tr>
                </thead>
                 @if ($cansLog->isEmpty())
                    <tr style="colspan:4">No records Found.</tr>
                @else
                  <tbody id="tincans-tbody">
                      @foreach($cansLog as $canLog)
                          <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">  
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$canLog->id}}
                          </td>
                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                  {{$canLog->kg_weight*1000}}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$canLog->price}}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{$canLog->created_at}}
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                  {{ $cansLog->links() }}
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>

  {{-- COINS TAB --}}
  <div class="tab-pane fade" id="tabs-messages" role="tabpanel" aria-labelledby="tabs-profile-tab">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="font-medium leading-tight text-2xl mt-0 mb-2 text-gray-600">Coins</h2>
      <label class="rounded items-center max-w-xs gap-2 bg-black text-white p-4">

        @if($currentCoins)
          @if(is_null($currentCoins->coins_total))
              <p>No records found.</p>
          @else
              {{-- Display your data here --}}
              Total:<span id="currentcoins"> {{ $currentCoins->coins_total }}</span> PHP / 200 PHP
          @endif
        @else
            <p>No records found.</p>
        @endif
       
      </label>
    </div>
      <form action="{{url('/downloadcoinsLogs')}}" method="get">
        @csrf
        <label class="uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="status">
          Start Date
        </label>     
        <input type="date" class="peermin-h-[auto] w-25 outline-gray rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
        placeholder="Select a date" name="startDate" required/>
        <b> | </b>
        <label class="uppercase tracking-wide text-gray-700 text-xs py-2 font-bold mt-2" for="status">
          End Date
        </label>     
        <input type="date" class="peer min-h-[auto] w-25 rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
        placeholder="Select a date" name="endDate" required/>
        <x-button type="submit">Download PDF</x-button>
      </form>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table id =" " class="min-w-full">
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
              @if ($coinTable->isEmpty())
                  <tr style="colspan:4">No records Found.</tr>
              @else
                <tbody id="coins-tbody">
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
              @endif
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

@role('employee') 
  <script>
    //Pusher.logToConsole = true;
    var pusher = new Pusher('b89eb6a948d95cf92f3b', {
    cluster: 'ap1'
    });

    var channel = pusher.subscribe('notify-user');

    channel.bind('notif', function(data) {
      toastr.success(JSON.stringify(data.notify));
    });
  </script>
@endrole

<br><br><br>

  <script>
        $(document).ready(function () {
      $('table.min-w-full').DataTable({
        searching: false,
        ordering: true,
        info: false,
        paging: false
    });

});
    //Pusher.logToConsole = true;
    var pusher = new Pusher('b89eb6a948d95cf92f3b', {
    cluster: 'ap1'
    });

    var plastic_channel = pusher.subscribe('plastic-insert');
    var tincan_channel = pusher.subscribe('tincan-insert');
    var coin_channel = pusher.subscribe('coins-changed');

    plastic_channel.bind('insert-1', function(data) {
      var row = "<tr  class='bg-gray-100 border-b transition duration-300 ease-in-out hover:bg-gray-200'>"+
              "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + data.id 
              + "</td><td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + (data.kg_Weight*1000)
              + "  </td><td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + data.price 
              + " </td><td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + data.created_at 
              + "</td></tr>";
      $('#plastic-tbody').prepend(row);
      
      const myspan = document.getElementById('plastictotal');
      myspan.innerHTML = data.total_kg;
    });

    tincan_channel.bind('insert-2', function(data) {
      var row = "<tr  class='bg-gray-100 border-b transition duration-300 ease-in-out hover:bg-gray-200'>"+
              "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + data.id 
              + "</td><td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + (data.kg_weight*1000) 
              + " </td><td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + data.price 
              + " </td><td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + data.created_at 
              + "</td></tr>";
      $('#tincans-tbody').prepend(row);
      
      const myspan = document.getElementById('tincanstotal');
      myspan.innerHTML = data.total_kg;
    });

    coin_channel.bind('decrement', function(data) {
      var row = "<tr class='bg-gray-100 border-b transition duration-300 ease-in-out hover:bg-gray-200'>"+
              "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + data.created_at
              + "</td><td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + data.coins_in 
              + " </td><td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" + data.coins_out 
              + " </td></tr>";
      $('#coins-tbody').prepend(row);

      const myspan = document.getElementById('currentcoins');
      myspan.innerHTML = data.coins_total;
    });

    const ctx1 = document.getElementById('chart1');
    // ctx.canvas.width = 300;
    // ctx.canvas.height = 300;  
    new Chart(ctx1, {
      type: 'bar',
      data: {
        labels: [
          @if(isset($plasticBars))
            @foreach($plasticBars as $plasticBar)
              '{{$plasticBar->date}}',
            @endforeach
          @endif
        ],
        datasets: [{
          label: 'Grams of plastic bottles per day',
          data: [
                    @foreach($plasticBars as $plasticBar)
                      '{{$plasticBar->count}}',
                    @endforeach],
            backgroundColor: [
                @foreach($plasticBars as $plasticBar)
                  'rgba(34,197,94, 0.2)',
                @endforeach],
            borderColor: [
              @foreach($plasticBars as $plasticBar)
                'rgba(34,197,94,  1)',
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
          label: 'Grams of tin cans per day',
          data: [
            @foreach($tinBars as $tinBar)
              '{{$tinBar->count}}',
            @endforeach
          ],
          backgroundColor: [@foreach($tinBars as $tinBar)
                'rgba(34,197,94, 0.2)',
            @endforeach],
            borderColor: [@foreach($tinBars as $tinBar)
                'rgba(34,197,94, 1)',
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
</script>

@endsection
