@php
    $employees = App\Models\User::whereHas(
    'roles', function($q){
        $q->where('name', 'employee');
    })->get();

    $id = Auth::user()->id;
@endphp

<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">
    @role('employee')
    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
       </x-slot>
    </x-sidebar.link>
    <x-sidebar.link title="Notifications" href="{{ url('/notifs/' . $id) }}">
        <x-slot name="icon">
            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment-alt" class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288z"></path>
              </svg>
       </x-slot>
    </x-sidebar.link>
    @endrole
@if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
    <x-sidebar.link title="Employees" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="h-5 w-5">
            <path
              stroke-linecap="round"
              d="M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 10-2.636 6.364M16.5 12V8.25" />
          </svg>
       </x-slot>
    </x-sidebar.link>
    <x-sidebar.link title="RVMs" href="{{ route('rvms') }}" :isActive="request()->routeIs('rvms')">
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link title="Sent Notifications" href="{{ route('notifications') }}" :isActive="request()->routeIs('notifications')">
        <x-slot name="icon">
            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="comment-alt" class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288z"></path>
              </svg>
       </x-slot>
    </x-sidebar.link>
    <x-sidebar.link title="Storage Details" href="{{ route('full-storage') }}" :isActive="request()->routeIs('full-storage')">
        <x-slot name="icon">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="h-5 w-5">
            <path
              d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
            <path
              fill-rule="evenodd"
              d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z"
              clip-rule="evenodd" />
          </svg>
       </x-slot>
    </x-sidebar.link>
    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">RVM IDs</div>
    <x-sidebar.link title="Add a new machine" href="{{ route('dashboard.create') }}" :isActive="request()->routeIs('dashboard.create')">
        <x-slot name="icon">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sliders-h" class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M496 384H160v-16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h80v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h336c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm0-160h-80v-16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h336v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h80c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm0-160H288V48c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16C7.2 64 0 71.2 0 80v32c0 8.8 7.2 16 16 16h208v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h208c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16z"></path>
            </svg>
        </x-slot>
    </x-sidebar.link>

    @foreach ($employees as $index)

        <x-sidebar.link title="RVM {{ $index->rvm_id}}" href="{{ url('/employee/' . $index->id) }}" :isActive="request()->route()->parameter('id') == $index->id">
            <x-slot name="icon">
                <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endforeach
@endif

</x-perfect-scrollbar>