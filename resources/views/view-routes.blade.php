<!DOCTYPE html>
<html>
<head>
    <title>Rotas: {{ env('APP_NAME') }} | {{ $prefix }}*</title>
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

  /* cabecalho */
  table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #04AA6D;
    color: white;
  }
</style>
</head>
<body>

<h1>{{ env('APP_NAME') }} | {{ $prefix }}*</h1>

<table id="routes">
  <tr>
    <th>Method</th>
    <th>Route</th>
    <th>Name</th>
    <th>Middleware</th>
    <th>Action</th>
  </tr>
  @foreach ($routes as $value)
    @if(str_starts_with($value->uri(), $prefix))
      <tr>
        <td>{{ implode("|", $value->methods()) }}</td>
        
        <td>
            @if(in_array('GET', $value->methods()))
                <a href="{{ $value->uri() }}">{{ $value->uri() }}</a>
            @else
                {{ $value->uri() }}
            @endif
        </td>

        <td>
          @if($value->getName()) {{ $value->getName() }} @endif
        </td>    

        <td>{{ implode("|", $value->middleware()) }}</td>
        <td>{{ $value->getActionName() }}</td>
      </tr>
    @endif
  @endforeach
</table>

</body>
</html>
