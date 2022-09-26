<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>API TMB</title>
  <style>
  #parada {
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
    <span class="navbar-brand mb-0 h1">API TMB</span>
  </nav>
  <div class="fluid p-2">

    <form action="" method="POST">
      <div class="form-group">
        <br>
        <input type="text" name="parada" id="parada" class="form-control" placeholder="Introduce una parada">
        <br>
        <input type="submit" class="btn btn-primary">
      </div>
    </form>

  </div>
</body>

</html>

<?php


if (isset($_POST['parada'])) {
    $parada = $_POST['parada'];


    echo '<p id="numParada"> Parada num: '.$parada."</p>";
    $curl = curl_init();

    $url = "https://api.tmb.cat/v1/ibus/stops/$parada?app_id=4cd973cf&app_key=b11f349845d26222a6b4df1988a97d47";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $repuesta = curl_exec($ch);
    curl_close($ch);

    $reponse_json = json_decode($repuesta, true);
  

  
    echo '<div id ="paradas">';
    foreach ($reponse_json['data']['ibus'] as $result) {
        echo "Linea de autobús: ".$result['line'].", tiempo: ".$result['text-ca'].", destino: ".$result['destination']."<br>";
    }

    echo "</div>";
}
