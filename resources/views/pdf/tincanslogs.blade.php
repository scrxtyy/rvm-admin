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

<h2>Tin cans Transaction Logs</h2>
Displaying data from {{$startDate}} to {{$endDate}}
<br>
<table>
  <tr>
    <th>LOG ID</th>
    <th>ACTION</th>
  </tr>
  @foreach($cansLogs as $log)
    <tr>
      <td style="colspan:1">{{ $log['id'] }}</td>
      <td> 
        @if (intval($log['kg_weight']==0))
          Tin cans storage has been emptied. {{$log['created_at']}}
        @else
          User inserted {{intval($log['kg_weight']*100)}} grams of tin cans. Rewarded {{intval($log['price'])}} coins. {{$log['created_at']}}
        @endif
          </td>
    </tr>
  @endforeach
</table>


</body>
</html>
