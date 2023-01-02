@extends('employees.dashboard')

@section('content')
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
                        <a href="{{ url('/employees/' . $employees->rvm_id) }}" title="View Employee">
                            <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            <i class="fa fa-eye" aria-hidden="true"></i> 
                                View
                            </button>
                        </a>
                        <a href="{{ url('/employees/' . $employees->rvm_id . '/edit') }}" title="Edit Employee">
                            <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('/employees' . '/' . $employees->rvm_id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" title="Delete Student" onclick="return confirm('Confirm delete?')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> 
                              Delete
                            </button>
                        </form>

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