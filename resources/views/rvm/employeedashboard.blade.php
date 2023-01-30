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
      // Pusher.logToConsole = true;
  
      var pusher = new Pusher('b89eb6a948d95cf92f3b', {
        cluster: 'ap1'
      });
  
      var channel = pusher.subscribe('update-element');
      channel.bind('notif', function(data) {
        toastr.success(JSON.stringify(data.notify));
      });
      
      // var channel1 = pusher.subscribe('update-dropdown');
      // channel1.bind('update', function(data) {
      //   $('#notifications-list').empty();

      //   for (var i = 0; i < data.notifications.length; i++) {
      //       var notification = data.notifications[i];
      //       var timeElapsed = moment(notification.created_at).fromNow();
      //       if (notification.isread === 1) {
      //           $('#notifications-list').append("<a href='{{url('/notification/'."+notifications.id+")}} class='flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2'><p class='text-gray-600 text-sm mx-2'><span class='font-normal' href='#'>RVM Admin sent you a task: "+notifications.message+"</span>. <span class='text-gray-300'>"+timeElapsed+"</span></p></a>");
      //       } else {
      //           $('#notifications-list').append("<a href='{{url('/notification/'."+notifications.id+")}} class='flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2'><p class='text-gray-600 text-sm mx-2'><span class='font-bold' href='#'>RVM Admin sent you a task: "+notifications.message+"</span>. <span class='text-gray-300'>"+timeElapsed+"</span></p></a>");
      //       }
      //   }
      // });
    </script>
</x-app-layout>
