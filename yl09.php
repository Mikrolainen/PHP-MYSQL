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

        class Auto {
            var $varv;
            var $tootja;
            var $kiirus;

            function __construct($varv, $tootja) {
                $this->varv = $varv;
                $this->tootja = $tootja;
            }

            function kiirendus() {
                while ($this->kiirus < 100) {
                    $this->kiirus += 10;
                    echo "Kiirus: " . $this->kiirus . " km/h<br>";
                    if ($this->kiirus >= 100) {
                        echo "<br>soitsid liiga kiiresti, politsei on nuud su kannul, politsei ara jooksmisel tuli avarii ja auto laks umber, said surma!<br>vaena audi on nuud katki";
                        break;
                    }
                }
            }
        }

        $minuAuto = new Auto("punane", "Audi");
        echo "soidad autoga: " . $minuAuto->varv . " " . $minuAuto->tootja . "<br><br>";
        $minuAuto->kiirendus();

        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>