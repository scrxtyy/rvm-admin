@extends('employees.show')

@section('logs')

<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
    <h2 class="py-4 text-gray-600 dark:text-gray-400">PET Bottles</h2> 
    <x-button target="_blank" href="#" variant="black" class="items-center max-w-xs gap-2">
      {{-- <span>Total: {{$plasticweight*10}} KG / 10 KG</span> --}}
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
                  @foreach($plasticsLog as $plasticLog)
                      <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$plasticLog->created_at}}
                          </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$plasticLog->kg_Weight}}
                          </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$plasticLog->pieces}}
                          </td>
                          <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              {{$plasticLog->price}}
                          </td>
                      </tr>
                @endforeach
              </tbody>
              {{ $plasticsLog->links() }}
            </table>
          </div>
        </div>
      </div>
    </div>
  
    
@endsection