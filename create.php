<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>API TMB</title>
  <style>
  #nombre,#modulo {
      width: 300px;
    }
    #paradas {
     padding: 15px;
    }
    #numParada {
     padding: 15px;
     margin:0px;
    }
  </style>
</head>

<body>
<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">API </span>
      </nav>

      <ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" href="all.php">All</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="create.php">Create</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="update.php">Update</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="search.php">Search</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="delete.php">Delete</a>
  </li>
</ul>
  <div class="fluid p-2">

    <form action="" method="POST">
      <div class="form-group">
        <br>
        <input type="text" name="modulo" id="modulo" class="form-control" placeholder="Introduce nombre modulo" required>
          <br>
         <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Introduce modulo" required>
        <br>
        <input type="submit" class="btn btn-primary">
      </div>
    </form>

  </div>
</body>

</html>

<?php


if (isset($_POST['nombre'])) {
   
$nombre = $_POST['nombre'];
$modulo = $_POST['modulo'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8000/api/ufs',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{ 
 "nombre": "'.$nombre.'",
 "modulo": "'.$modulo.'"
        
        }',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: XSRF-TOKEN=eyJpdiI6ImNXMVU1SkM2NCt0M1I5c004Rm9KSmc9PSIsInZhbHVlIjoiakJtcHhVMlRidDM3K1lXUWhmdTFxT1BZOFZIWjJMSEJ1Vi8zc1pFMk1hSTVxaktjQWwvczlkeDVVTUV0TW9md2hXUE5oaElxRlhlN0lNVzBncDZvaG11eFp0b3FseXlteFZ4bjZuVURvK2ZKQkFJUHc3RjRrUjVXbURBaFdueUoiLCJtYWMiOiIwZDRiY2UwMzk2OWNmMzkxNjUwZGE0NTdjNTY3YmY1YjQxYjY2ZTRjNzBmMjEzMjMzNmE3NzEyOThhZGFkYjhjIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Im1idktKMUF5MDgyU01kbmk3VnFQd3c9PSIsInZhbHVlIjoidWlWZ3Y1ZldCeGZpd1p5Z3ErYWZoYk9EemFrViszVFJPQlJLVFhjZ1FsSmM2RXJxb29hQXM3Umk4cFgxTjZjb0lUem1CNitmK3dDSXRkSnpBQU1sejROcUtKWXFYdW1HMEdwcFRZUkViT1QwN1dyckUyaFNYUStTL2lZWG9MR2kiLCJtYWMiOiIwYWFkNDlhOGM5NDZkMWE3YTNmMmU4NjBmYjU0YmYyZGU5NmYwNWE4YjM3N2NjNGQxMmFhNmNhMzIwMWVmYmE2IiwidGFnIjoiIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
}
