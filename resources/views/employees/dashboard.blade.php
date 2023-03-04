<x-app-layout>
    <x-slot name="header">
        
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
        <script src="{{ asset('Chart.min.js') }}"></script>
        <script src="{{ asset('index.min.js') }}"></script>
  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    </x-slot>

    @yield('content')
    @yield('assign')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('b89eb6a948d95cf92f3b', {
            cluster: 'ap1'
        });

        var full_channel = pusher.subscribe('storage-full');
        full_channel.bind('full', function(data) {
            alert(data);
        });

        
        var coinsfull_channel = pusher.subscribe('coins-empty');
        coinsfull_channel.bind('empty', function(data) {
            alert(data);
        });
    </script>
</x-app-layout>
