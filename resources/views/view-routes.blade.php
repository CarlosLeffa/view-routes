<!DOCTYPE html>
<html>
<head>
  <title>{{ $title }} </title>
<style>
  table {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  table td, table th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  /* corsim cornao */
  table tr:nth-child(even){background-color: #f2f2f2;}

  /* mouse over */
  table tr:hover {background-color: #ddd;}

  /* header */
  table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #646262;
    color: white;
  }
</style>
</head>
<body>

<h1>Routes: {{ count($routes) }} </h3>

<table id="routes">
  <tr>
    <th>Method</th>
    <th>Route</th>
    <th>Name</th>
    <th>Middleware</th>
    <th>Action</th>
  </tr>
  @foreach ($routes as $value)
    <tr>
      <td>{{ implode("|", $value['methods']) }}</td>

      <td>
        @if($value['link'])
          <a href="{{ $value['link'] }}">{{ $value['link'] }}</a>
        @else
          {{ $value['uri'] }}
        @endif
      </td>

      <td>{{ $value['name'] }}</td>
      <td>{{ implode("|", $value['middlewares']) }}</td>
      <td>{{ $value['action'] }}</td>

    </tr>
  @endforeach
</table>

</body>
</html>
