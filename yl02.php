<?php include('config.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">

        <h1>yl 02</h1>

        <form action="" method="get">
            <select name="otsingutuup">
                <option value="artist">Artistid</option>
                <option value="album">Albumid</option>
            </select>
            <input type="text" name="otsing" placeholder="Sisesta otsingusona">
            <input type="submit" value="Otsi">
            </form>

        <?php

            if (!empty($_GET["otsing"])) {
              $valik = $_GET["otsingutuup"];
              $otsi = $_GET["otsing"];
              $paring = 'SELECT * FROM albumid WHERE '.$valik.' LIKE "%'.$otsi.'%"';
            } else {
              $paring = 'SELECT artist,album FROM albumid WHERE aasta >= 2010 ORDER BY artist LIMIT 10';
            }
            $valjund = mysqli_query($yhendus, $paring);

            while($rida = mysqli_fetch_assoc($valjund)){
                echo $rida['artist'].' - '.$rida['album'].'<br>';
                }
            echo '<hr>';
            mysqli_free_result($valjund);
            $paring = 'SELECT COUNT(*) as count, AVG(hind) as avg, SUM(hind) as max FROM albumid';
            $valjund = mysqli_query($yhendus, $paring);
            $rida = mysqli_fetch_assoc($valjund);
            echo 'Andmebaasis on '.$rida['count'].' albumit'.'<br>'.'Keskmine hind on '.$rida['avg'].'<br>'.'Suurim vaartus on '.$rida['max'];
            echo '<hr>';

            mysqli_free_result($valjund);
            $paring = 'SELECT album, MIN(aasta) as maxi FROM albumid';
            $valjund = mysqli_query($yhendus, $paring);
            $rida = mysqli_fetch_assoc($valjund);
            echo 'vanim album on '.$rida['maxi'];
            echo '<hr>';

            mysqli_free_result($valjund);
            $paring = 'SELECT album,hind,artist FROM albumid WHERE hind > (SELECT AVG(hind) FROM albumid) LIMIT 10';
            $valjund = mysqli_query($yhendus, $paring);
            echo 'Albumid mille hind on suurem kui keskmine on <br>';
            while($rida = mysqli_fetch_assoc($valjund)){
            echo $rida['artist'].' - '.$rida['album'].' - '.$rida['hind'].' E <br>';  }

        ?>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>