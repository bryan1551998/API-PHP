<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>API Spotify</title>
  <style>
    #artista {
      width: 300px;
    }

    div#contenido {
      display: grid;

      grid-template-columns: repeat(auto-fill, minmax(22rem, 1fr));
      grid-auto-rows: 15rem;
      grap: 7px;


    }

    #discos {
      padding: 7px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">API Spotify</span>
  </nav>
  <div class="fluid p-2">

    <form action="" method="POST">
      <div class="form-group">
        <br>
        <input type="text" name="artista" id="artista" class="form-control" placeholder="Buscar artista">
        <br>
        <input type="submit" class="btn btn-primary">
      </div>
    </form>

  </div>
</body>

</html>


<?php

$artista;
if (isset($_POST["artista"])) {

  $artista = $_POST["artista"];

  #Extraer los espacios del input
  $searchString = " ";
  $replaceString = "%20";
  $outputString = str_replace($searchString, $replaceString, $artista);


  $curl = curl_init(); //Inicio sesión
  $url = "https://api.spotify.com/v1/search?q=$outputString&type=artist"; //URL de la petición

  $headers = array(
    "cache-control: no-cache",
    "Authorization: Bearer BQAh9-Gz8no7hktedsvLJmOq7MRHovOyfa1vq_GqQLy4HiVoSbJ3RQjFQ0HqNZe9bwayhPTVZD9tc3_7UUOhULBudWKy6IgxELGjg-ZfKHySN3b4MJ0ZmT1p3VzefzbdAilGcjKHQLDZW0sCZt2Sg1U8jVb--uKwGq4wgLKDW_RUpa9oUiMxpuJ6SPpBjW42R0-FTw"
  );

  $ch = curl_init($url); //Creo la session
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); //Selecciono el metodo
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Digo que me devuelva el resultado
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); //Paso los headers
  $respuesta = curl_exec($ch); //Guardo el resultado en un variable
  curl_close($ch); //Cierro la sesión
  $response_json = json_decode($respuesta, true); //Transformo el resultado a un JSON


  if (!empty($response_json)) {

    echo '<div class="p-4 text-center">';
    $id_artista = $response_json["artists"]["items"][0]["id"];
    echo "ID del artista: " . $id_artista;
    echo "<br>";
    echo "<br>";
    echo '<img src="' . $response_json["artists"]["items"][0]["images"][0]["url"] . '" width="150" hight="auto"/>';
    echo "<br>";

    echo  "</div>";

    $curl_2 = curl_init();
    $url_2 = "https://api.spotify.com/v1/artists/$id_artista/albums";

    $ch_2 = curl_init($url_2); //Creo la session
    curl_setopt($ch_2, CURLOPT_CUSTOMREQUEST, "GET"); //Selecciono el metodo
    curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true); //Digo que me devuelva el resultado
    curl_setopt($ch_2, CURLOPT_HTTPHEADER, $headers); //Paso los headers
    $respuesta_2 = curl_exec($ch_2); //Guardo el resultado en un variable
    curl_close($ch_2); //Cierro la sesión
    $response_json_2 = json_decode($respuesta_2, true); //Transformo el resultado a un JSON


    #echo "<script> console.log(".$respuesta_2.") </script>";
    #var_dump(count($response_json_2['items']));
    #print_r( $response_json_2['items']);

    echo '<div class="p-4 text-center">';
    echo '<div id="contenido">';
    foreach ($response_json_2['items'] as $clave) {

      echo '<div id="discos">';
      print_r($clave['name']);
      echo "<br>";
      echo ('<a href="' . ($clave['external_urls']['spotify']) . '">Ir a escuchar el álbum</a>');
      echo "<br>";
      echo ('<img src="' . ($clave['images'][0]['url']) . '" width="150" hight="auto"/>');
      echo "'</div>
      ";
      #print_r($clave['images'][0]['url']);
    }
    echo  "</div>";
    echo  "</div>";
  } else {
    echo "Artista no encontrado";
  }
}
