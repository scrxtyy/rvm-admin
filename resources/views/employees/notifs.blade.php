@extends('employees.dashboard')

@section('content')
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
  <h3 class="text-xl font-semibold leading-tight">
      {{ __('Sent Notifications') }}
  </h3>
</div>
@isset($message)
<div class="flex flex-col">
  <div class="bg-{{$color}}-100 rounded-lg py-5 px-6 mb-4 text-base text-{{$color}}-700 mb-3" role="alert">
    {{$message}}
  </div>
</div>
@endisset
<form action="/sort" method="GET">
  <select name="column">
      <option value="created_at">Created At</option>
      <option value="sender_id">Employee ID</option>
      <option value="deadline">Deadline</option>
  </select>
  <select name="order">
      <option value="asc">From Oldest</option>
<option value="desc">From Latest</option>
  </select>
  <button type="submit"class="inline-block px-6 py-2.5 m-3 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
    Sort
  </button>
</form>


  <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <table class="min-w-full">
            <thead class="bg-white border-b">
              <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  User ID
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  RVM ID
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Message
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Deadline
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Sent at
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Status
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($notifications as $notif)
              <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$notif->sender_id}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  1001
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$notif->message}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$notif->deadline}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$notif->created_at}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  @isset($notif->status)
                  <div class="mb-1 text-base text-green-700 mb-1 font-bold" role="alert">
                    {{$notif->status}}
                  </div>
                  @endisset
                  @empty($notif->status)
                  <div class="mb-1 text-base text-yellow-700 mb-1 font-bold" role="alert">
                    In progress
                  </div>
                  @endempty
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" 
                          data-bs-toggle="modal" data-bs-target="#modal-{{ $loop->iteration }}">
                      View Details  
                  </button>
                  <!-- Modal -->
                  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                    id="modal-{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog relative w-auto pointer-events-none">
                      <div
                        class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div
                          class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                          <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Task Details</h5>
                          <button type="button"
                            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body relative p-4">
                          Task Details for {{$notif->name}} <br>
                          Task: {{$notif->message}} <br>
                          @if($notif->coin_amount)
                            Coin Amount to be added: {{$notif->coin_amount}} PHP <br>
                          @endif
                          @if($notif->notes)
                            Notes: {{$notif->notes}} <br>
                          @endif
                          Deadline: {{$notif->deadline}} <br>
                          Sent at: {{$notif->created_at}}
                            <img src="/proof/{{$notif->id}}.png" >
                        </div>
                        <div
                          class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                          <button type="button" class="px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md
                            hover:bg-purple-700 hover:shadow-lg
                            focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0
                            active:bg-purple-800 active:shadow-lg
                            transition
                            duration-150
                            ease-in-out" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>  
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


@endsection