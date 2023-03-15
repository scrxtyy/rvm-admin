<x-app-layout>
    <x-slot name="header">
        
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Employee Dashboard') }}
            </h2>
        </div>
        <script src="{{ asset('Chart.min.js') }}"></script>
        <script src="{{ asset('index.min.js') }}"></script>
  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    </x-slot>

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
      // Enable pusher logging - don't include this in production  

        Pusher.logToConsole = true;

        var pusher = new Pusher('b89eb6a948d95cf92f3b', {
          cluster: 'ap1'
        });
        
        var channel = pusher.subscribe('notify-user');
        var emptied_channel = pusher.subscribe('storage-emptied');
        
        channel.bind('notif', function(data) {
          toastr.success(JSON.stringify(data));
        });
        emptied_channel.bind('empty', function(data) {
          alert(data);
        });
    </script>
</x-app-layout>
