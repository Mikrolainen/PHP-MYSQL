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
            if (!$yhendus) {
                die('probleem andmebaasiga');
            }

            // Uudiseid ühel lehel
            $uudiseid_lehel = 8;

            // Lehtede arvutamine
            $uudiseid_kokku_paring = "SELECT COUNT(id) AS total FROM uudised";
            $lehtede_vastus = mysqli_query($yhendus, $uudiseid_kokku_paring);
            $uudiseid_kokku = mysqli_fetch_assoc($lehtede_vastus);
            $total_uudiseid = $uudiseid_kokku['total'];
            $lehti_kokku = ceil($total_uudiseid / $uudiseid_lehel);

            // Kuvame kokku uudiste arvu
            echo 'Uudiseid kokku: ' . $total_uudiseid . '<br>';
            echo 'Lehekülgi kokku: ' . $lehti_kokku . '<br>';
            echo 'Uudiseid lehel: ' . $uudiseid_lehel . '<br>';

            // Kasutaja valik
            if (isset($_GET['page'])) {
                $leht = $_GET['page'];
            } else {
                $leht = 1;
            }

            // Millest näitamist alustatakse
            $start = ($leht - 1) * $uudiseid_lehel;

            // Andmebaasist andmed
            $paring = "SELECT * FROM uudised LIMIT $start, $uudiseid_lehel";
            $vastus = mysqli_query($yhendus, $paring);

            // Väljastamine
            while ($rida = mysqli_fetch_assoc($vastus)) {
                echo '<h3>' . $rida['pealkiri'] . '</h3>';
                echo '<p>' . $rida['uudis'] . '</p>';
            }
            $pages_to_show = 7;
            $start_page = max(1, $leht - floor($pages_to_show / 2));
            $end_page = min($lehti_kokku, $start_page + $pages_to_show - 1);

            if ($end_page - $start_page + 1 < $pages_to_show) {
                $start_page = max(1, $end_page - $pages_to_show + 1);
            }
            $eelmine = $leht - 1;
            $jargmine = $leht + 1;

            if ($leht > 1) {
                echo "<a href=\"?page=$eelmine\">Eelmine</a> ";
            }
            for ($i = $start_page; $i <= $end_page; $i++) {
                if ($i == $leht) {
                    echo "<b><a href=\"?page=$i\">$i</a></b> ";
                } else {
                    echo "<a href=\"?page=$i\">$i</a> ";
                }
            }
            if ($leht < $lehti_kokku) {
                echo "<a href=\"?page=$jargmine\">Järgmine</a> ";
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
