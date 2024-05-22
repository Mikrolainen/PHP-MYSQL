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
        <hr>

        <?php
            if (!empty($_GET['artist']) && !empty($_GET['album']) && !empty($_GET['aasta']) &&  !empty($_GET['hind']) ) {
            $artist = htmlspecialchars(trim($_GET['artist']));
            $album = htmlspecialchars(trim($_GET['album']));
            $aasta = htmlspecialchars(trim($_GET['aasta']));
            $hind = htmlspecialchars(trim($_GET['hind']));
            //päring
            $paring = "INSERT INTO albumid(artist,album,aasta,hind) VALUES ('".$artist."','".$album."','".$aasta."','".$hind."')";
            $valjund = mysqli_query($yhendus, $paring);
            //päringu vastuste arv
            $tulemus = mysqli_affected_rows($yhendus);
            if ($tulemus == 1) {
            echo "Kirje edukalt lisatud";
            } else {
            echo "Kirjet ei lisatud";
            } }
        ?>
        <h2>Uue albumi lisamine</h2>
        <form action="" method="get">
        <table>
            <tr><td>Artist: </td><td><input type="text" name="artist" required></td></tr>
            <tr><td>Album:</td><td> <input type="text" name="album" required></td></tr>
            <tr><td>Aasta: </td><td><input type="number" name="aasta" value="2000" min="1900" max="2099" required></td></tr>
            <tr><td>Hind: </td><td><input type="number" name="hind" value="1" min="1" max="1000" step="0.1" required></td></tr>
            <tr><td><input type="reset" value="Tühjenda"></td><td><input type="submit" value="LISA ALBUM"></td></tr>
        </table>
        </form>
        <hr>
        <h2>Andme kustutamine</h2>

            <table border="1" class="mb-5">
            <?php
            //päring
            $paring = 'SELECT * FROM albumid';
            $valjund = mysqli_query($yhendus, $paring);
            while($rida = mysqli_fetch_assoc($valjund)){
                echo '<tr>
                        <td>'.$rida['artist'].'</td>
                        <td>'.$rida['album'].'</td>
                        <td>'.$rida['aasta'].'</td>
                        <td><a href="'.$_SERVER['PHP_SELF'].'?id='.$rida["id"].'">kustuta</a></td>
                    </tr>';
            }
            if(!empty($_GET['id'])){
                //kustutamise päringud
                $id = $_GET['id'];
                $kustuta_paring = "DELETE FROM albumid WHERE id='$id'";
                $kustuta_valjund = mysqli_query($yhendus, $kustuta_paring);
                if($kustuta_valjund){
                    echo "Rida kustutatud!";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$_SERVER['PHP_SELF'].'">';
                } else {
                    echo "Viga kustutamisel!";
                }
            }
            ?>
            </table>
        

        <!-- <?php

            $paring = 'SELECT * FROM albumid';
            $valjund = mysqli_query($yhendus, $paring);
            $rida = mysqli_fetch_assoc($valjund);
            while($rida = mysqli_fetch_assoc($valjund)){
                echo $rida['artist'].' - '.$rida['album'].'<br>';
                }
            echo '<hr>';
            mysqli_free_result($valjund);

        ?> -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>