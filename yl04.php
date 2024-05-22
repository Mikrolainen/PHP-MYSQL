<?php include('config.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHPMYSQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <h1>bananaman</h1>

        <?php
          $paring = "SELECT arved.arve_nr, albumid.artist, albumid.album, kliendid.eesnimi, kliendid.perenimi, kliendid.telefoninumber FROM arved, albumid, kliendid 
          WHERE arved.albumid_id=albumid.id AND arved.kliendid_id=kliendid.id;";
          $valjund = mysqli_query($yhendus, $paring);
          while($rida = mysqli_fetch_assoc($valjund)){
            echo 'Arve number: '.$rida['arve_nr'].'<br>';
            echo 'Ostja: '.$rida['eesnimi'].' '.$rida['perenimi'].'<br>';
            echo 'Kontakt: '.$rida['telefoninumber'].'<br>';
            echo 'Toote nimetus: '.$rida['artist'].' - '.$rida['album'].'<br><br>';
          }
          mysqli_free_result($valjund);
          mysqli_close($yhendus);	
        ?>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>