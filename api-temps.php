<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>API Tiempo</title>
  <style>
    #municipio {
      width: 300px;
    }

    div#contenido {
      display: grid;

      grid-template-columns: repeat(auto-fill, minmax(22rem, 1fr));
      grid-auto-rows: 15rem;
    }

    
  </style>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">API Tiempo</span>
  </nav>
  <div class="fluid p-2">

    <form action="" method="POST">
      <div class="form-group">
        <br>
        <input type="text" name="municipio" id="municipio" class="form-control" placeholder="Buscar municipio">
        <br>
        <input type="submit" class="btn btn-primary">
      </div>
    </form>

  </div>
</body>

</html>


<?php

if(isset($_POST['municipio'])){

    $municipio = $_POST['municipio'];
    echo $municipio;

    $url = "https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/diaria/$municipio";

    $headers = array(
        'api_key: eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJicnlhbi1hbGV4aXNzMUBob3RtYWlsLmNvbSIsImp0aSI6ImNlZDMwYjFjLWU4OWYtNDViYS04ZGJiLWNjYzc4NTc5MmRlYSIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNjUzOTI5NjEyLCJ1c2VySWQiOiJjZWQzMGIxYy1lODlmLTQ1YmEtOGRiYi1jY2M3ODU3OTJkZWEiLCJyb2xlIjoiIn0.VOQpa-6qOoeW50m1MkSnEHRGHDn99WE5MppJLg_ly_4'
    );
    
    
    $ch = curl_init($url); //Creo la sessión
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); //Selecciono el metodo
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Digo que me de el resultado
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); //Paso los headers
    $respuesta = curl_exec($ch); //Guardo el resultado en una variable
    curl_close($ch); //Cierro la sesión
    
// echo gettype($respuesta);

    $response_json = json_decode($respuesta, true); //Transformo el resultado a un JSON


// echo gettype($response_json);
    echo '<script> console.log('.$respuesta.')</script>';
    
    
    // print_r($response_json['datos']);
    
    // echo '<a href="'.$response_json['datos'].'" target>link</a>';







$curl2 = curl_init();

curl_setopt_array($curl2, array(
  CURLOPT_URL => $response_json['datos'] ,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl2);

curl_close($curl2);
// echo $response;

 echo '<div class="p-4">';
 $response_json2 = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true);
 echo '<br>';
 print_r($response_json2[0]['nombre']);
 echo '<br>';
 echo 'Temperatura máxima: ';
 print_r($response_json2[0]['prediccion']['dia'][0]['temperatura']['maxima']);
 echo '<br>';
  echo 'Temperatura minima: ';
 print_r($response_json2[0]['prediccion']['dia'][0]['temperatura']['minima']);

 echo '<div >';
}


