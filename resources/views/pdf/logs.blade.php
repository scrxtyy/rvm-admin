{{-- @php
      $logs = DB::table('user_reports')->get();
@endphp --}}

SYSTEM REPORTS
<div class="overflow-hidden bg-white shadow-md dark:bg-dark-eval-1">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class=" inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <table class="min-w-full">
            <tbody>
              @foreach($logs as $log)
                <tr class="bg-white border-b">
                  <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $log['id'] }}
                  </td>
                  <td class="text-sm text-gray-400 italic px-6 py-4 whitespace-nowrap">
                    @if($log['user_type']==0)
                      ADMIN: {{$log['action'] }} {{$log['created_at']}}
                    @else
                      USER ID: {{$log['user_id']}} {{$log['action']}} {{$log['created_at']}}
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>