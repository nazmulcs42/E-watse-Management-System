
<!DOCTYPE html>
<html lang="en">
<head>
  <title>houses</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

    <body>
      <center>
        <div class="container">
  <h2>house location Table</h2>
  <p> Basic Information.</p>            
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
            <th>id</th>
            <th>name</th>
            <th>address</th>
            <th>type</th>
            <th>lat</th>
            <th>lng</th>
            <th>created_at</th>
            <th>updated_at</th>
           
      </tr>
    </thead>
    <tbody>
     @foreach($results as $data)
                <tr>    
                  <td>{{$data->id}}</td>
                  <td>{{$data->name}}</td>
                  <td>{{$data->adress}}</td>
                  <td>{{$data->type}}</td>
                  <td>{{$data->lat}}</td>                 
                  <td>{{$data->lng}}</td>                 
                  <td>{{$data->created_at}}</td>                 
                  <td>{{$data->updated_at}}</td>                 
                </tr>
            @endforeach
    </tbody>
  </table>
</div>
</center>
    </body>
</html>
