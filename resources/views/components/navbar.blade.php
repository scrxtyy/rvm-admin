@php
    $id = Auth::user()->id;
    $notifications = App\Models\Notifications::where('sender_id', $id)->latest()->take(5)->get();

@endphp

<nav aria-label="secondary" x-data="{ open: false }"
    class="sticky top-0 z-10 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white dark:bg-dark-eval-1"
    :class="{
        '-translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }">

    <div class="flex items-center gap-3">
        <x-button type="button" class="md:hidden" iconOnly variant="secondary" srText="Toggle dark mode"
            @click="toggleTheme">
            <x-heroicon-o-moon x-show="!isDarkMode" aria-hidden="true" class="w-6 h-6" />
            <x-heroicon-o-sun x-show="isDarkMode" aria-hidden="true" class="w-6 h-6" />
        </x-button>
    </div>

    <div class="flex items-center gap-3">

    @role('employee')
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = !dropdownOpen" class="relative p-3 rounded focus:outline-none hover:bg-purple-700 active:bg-purple-700">
                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment-alt" class="w-5 h-5 mt-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288z"></path>
                </svg>
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

            <div x-show="dropdownOpen" class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20" style="width:20rem;">
                <div class="py-2" id="notifications-list">
                    @foreach($notifications as $notif)
                        @if ($notif->isread == '1')
                            <a href="{{url('/notification/'. $notif->id)}}" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                <p class="text-gray-600 text-sm mx-2">
                                    <span class="font-normal" href="#">RVM Admin sent you a task: {{$notif->message}}</span>. <span class="text-gray-300">{{$notif->created_at->diffForHumans()}}</span>
                                </p>
                            </a>
                        @else
                            <a href="{{url('/notification/'. $notif->id)}}" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                <p class="text-gray-600 text-sm mx-2">
                                    <span class="font-bold" href="#">RVM Admin sent you a task: {{$notif->message}}</span>. <span class="text-gray-300">{{$notif->created_at->diffForHumans()}}</span>
                                </p>
                            </a>    
                        @endif
                    @endforeach
                </div>
                <a href="{{url('/notifs/'.$id)}}" class="block bg-gray-800 text-white text-center font-bold py-2">See all notifications</a>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>
    

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher1 = new Pusher('b89eb6a948d95cf92f3b', {
            cluster: 'ap1'
        });

        var channel1 = pusher1.subscribe('test-event');
        channel1.bind('pwet', function(data) {
            alert(data.test);
            // var notifications = data.notifications;
            // $('#notifications-list').empty();
            // for (var i = 0; i < notifications.length; i++) {
            //     var notification = notifications[i];
            //     var timeElapsed = moment(notification.created_at).fromNow();
            //     $('#notifications-list').prepend("<a href='{{url('/notification/'."+data.notifications.id+")}}' class='flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2'><p class='text-gray-600 text-sm mx-2'><span class='font-bold' href='#'>RVM Admin sent you a task: "+data.notifications.message+"</span>. <span class='text-gray-300'>"+timeElapsed+"</span></p></a>");
            // }
        });
        </script>
    @endrole

        <x-button type="button" class="hidden md:inline-flex" iconOnly variant="secondary" srText="Toggle dark mode"
            @click="toggleTheme">
            <x-heroicon-o-moon x-show="!isDarkMode" aria-hidden="true" class="w-6 h-6" />
            <x-heroicon-o-sun x-show="isDarkMode" aria-hidden="true" class="w-6 h-6" />
        </x-button>
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex items-center p-2 text-sm font-medium text-gray-500 rounded-md transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-purple-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ml-1">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>

<!-- Mobile bottom bar -->
<div class="fixed inset-x-0 bottom-0 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white md:hidden dark:bg-dark-eval-1"
    :class="{
        'translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }">
    <x-button type="button" iconOnly variant="secondary" srText="Search">
        <x-heroicon-o-search aria-hidden="true" class="w-6 h-6" />
    </x-button>

    <a href="{{ route('dashboard') }}">
        <x-application-logo aria-hidden="true" class="w-10 h-10" />
        <span class="sr-only">K UI</span>
    </a>

    <x-button type="button" iconOnly variant="secondary" srText="Open main menu"
        @click="isSidebarOpen = !isSidebarOpen">
        <x-heroicon-o-menu x-show="!isSidebarOpen" aria-hidden="true" class="w-6 h-6" />
        <x-heroicon-o-x x-show="isSidebarOpen" aria-hidden="true" class="w-6 h-6" />
    </x-button>
</div>