<x-app-layout>
  <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Reverse Vending Machines') }}
            </h2>
            <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
              Add New
            </button>
            
            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
              <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                  <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                      Modal title
                    </h5>
                    <button type="button"
                      class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                      data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body relative p-4">
                    <p>This is a vertically centered modal.</p>
                  </div>
                  <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                      class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                      data-bs-dismiss="modal">
                      Close
                    </button>
                    <button type="button"
                      class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
                      Save changes
                    </button>
                  </div>
                </div>
              </div>
            </div>


        </div>
    </x-slot>

    <div class="overflow-hidden bg-white shadow-md dark:bg-dark-eval-1">

    </div>

    <div class="overflow-hidden bg-white shadow-md dark:bg-dark-eval-1">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table class="min-w-full text-center">
                    <thead class="border-b bg-gray-800">
                      <tr>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                          RVM ID
                        </th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                          Name
                        </th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                          Email
                        </th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                          Password
                        </th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                          Actions
                        </th>
                      </tr>
                    </thead class="border-b">
                    <tbody>
                      @foreach($employees as $employees)
                      <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                          {{$employees->rvm_id}}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          {{$employees->name}}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          {{$employees->email}}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          {{$employees->password}}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          <button type="button" class="btn-info inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                            View
                          </button>
                          <button type="button" class="inline-block px-6 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">
                            Edit
                          </button>
                          <button type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                            Delete
                          </button>
    
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>

    
</x-app-layout>
