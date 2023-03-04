@extends('employees.dashboard')

@section('content')
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
  <h3 class="text-xl font-semibold leading-tight">
      {{ __('Sent Notifications') }}
  </h3>
</div>

{{-- <form action="{{url('/filter')}}" method="GET">
  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="status">
    Filter by: (RVM ID/Status)
  </label>     
  <select id="rvmid" name="rvmid" class="form-select overflow-x appearance-none font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
        @php
            $rvmids = App\Models\User::all()->whereNotNull('rvm_id');
        @endphp
        @foreach($rvmids as $ids)
          <option value="{{$ids->rvm_id}}">{{$ids->rvm_id}}</option>
        @endforeach
    </select>
    <select id="status" name="status" class="form-select overflow appearance-none font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
        <option value="Done">Done</option>
        <option value="For verification">For Verification</option>
        <option value="Incomplete">In progress</option>
  </select>
  <button type="submit"class="inline-block px-6 py-2.5 m-3 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
    Filter
  </button>
</form> --}}

  @if (isset($filtered))
    <div class="bg-blue-100 rounded-lg py-5 px-6 mb-4 text-base text-blue-700 mb-3" role="alert">
      {{$filtered}}
    </div>
  @endif
  @if (isset($sorted))
    <div class="bg-blue-100 rounded-lg py-5 px-6 mb-4 text-base text-blue-700 mb-3" role="alert">
      {{$sorted}}
    </div>
  @endif
  @if( session('message') )
    <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
      {{session('message')}}
      {{session()->forget('message')}}
    </div>
  @endif
  

  <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <table class="min-w-full">
            <thead class="bg-white border-b">
              <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Log ID
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Storage
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  RVM ID
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Full at
                </th>
                {{-- <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Status
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

                </th> --}}
              </tr>
            </thead>
            <tbody id="adminnotif-tbody">
              @foreach($storageTable as $store)
              <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$store->log_id}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  @if ($store->storage==0)
                      Plastics
                    @if ($store->storage==1)
                      Tin Cans
                    @endif
                  @endif
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$store->rvm_id}}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  {{$store->created_at}}
                </td>
                {{-- <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  @if(isset($notif->status))
                    <span class="text-green-500">{{$notif->status}}</span> <br>
                    @if ($notif->status=="For verification")
                      <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" 
                        data-bs-toggle="modal" data-bs-target="#verify-{{ $loop->iteration }}">
                        Verify
                      </button>
                    @endif
                  @else
                    <span class="text-yellow-500">In progress</span>
                  @endif
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  <button type="button" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" 
                          data-bs-toggle="modal" data-bs-target="#modal-{{ $loop->iteration }}">
                      View Details  
                  </button>
                  <!-- Modal for task details -->
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
                        </div>
                        <div
                          class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                          <button type="button" class="px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md
                            hover:bg-green-700 hover:shadow-lg
                            focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0
                            active:bg-green-800 active:shadow-lg
                            transition
                            duration-150
                            ease-in-out" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal for verifying proof -->
                  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                    id="verify-{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          @isset($notif->proof)
                            <img src="{{ asset($notif->proof) }}">
                          @endisset
                          <form action="{{url('/verifyProof')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$notif->id}}">
                            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out"
                            id="verify" name="verify">
                              Verify
                            </button>
                          </form>
                        </div>
                        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                          <button type="button" class="px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md
                            hover:bg-green-700 hover:shadow-lg
                            focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0
                            active:bg-green-800 active:shadow-lg
                            transition
                            duration-150
                            ease-in-out" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </td>   --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection