@extends('rvm.employeedashboard')

@section('content')
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
  <h3 class="text-xl font-semibold leading-tight">
      {{ __('Notifications') }}
  </h3>
</div>

<form action="{{url('/filterEmployee')}}" method="GET">
    @php
        $rvm = Auth::user();
    @endphp
    <input type="hidden" name="rvmid" value="{{$rvm->rvm_id}}">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="status">
      Filter by: (Status)
    </label>
    <select id="status" name="status" class="form-select appearance-none font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
        <option selected class="text-gray-500">Status</option>
        <option value="Done">Done</option>
        <option value="For verification">For Verification</option>
        <option value="Incomplete">In progress</option>
  </select>
  <button type="submit"class="inline-block px-6 py-2.5 m-3 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
    Filter
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
                  Task ID
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Message
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Received at
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Deadline
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
                  {{$notif->id}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$notif->message}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$notif->created_at}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$notif->deadline}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  @if (isset($notif->status))
                    <span class="text-green-500">{{$notif->status}}</span>
                  @else
                    <span class="text-yellow-500">In progress</span>
                  @endif
                </td>               
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  <a href="{{url('/notification/'.$notif->id)}}">
                    <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                      View Details  
                    </button>
                  </a>
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