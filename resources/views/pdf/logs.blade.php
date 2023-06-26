{{-- @php
      $logs = DB::table('user_reports')->get();
@endphp --}}

<html>
<head>
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }
</style>
</head>
<body>

<h2>System Reports</h2>
Displaying data from {{$startDate}} to {{$endDate}}
<br>
<table>
  <tr>
    <th>LOG ID</th>
    <th>ACTION</th>
  </tr>
  @foreach($logs as $log)
    <tr>
      <td style="colspan:1">{{ $log['id'] }}</td>
      <td> 
        @if($log['user_type']==0)
          ADMIN: {{$log['action'] }} {{$log['created_at']}}
        @else
          USER ID: {{$log['user_id']}} {{$log['action']}} {{$log['created_at']}}
        @endif
      </td>
    </tr>
  @endforeach
</table>


</body>
</html>
