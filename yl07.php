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
          session_start();
          $vnimi="";
          $vemail="";
          $vsonum="";
          //kas väljad on täidetud
          if (isset($_POST['nimi']) && isset($_POST['email']) && isset($_POST['sonum'])) {
            //andmed vormist
            $nimi = trim(addslashes($_POST['nimi']));
            $email = trim(addslashes($_POST['email']));
            $sonum = trim(addslashes($_POST['sonum']));
            //kui kasutaja on midagi sisestanud, siis jäetakse need "meelde"
            $vnimi=$nimi;
            $vemail=$email;
            $vsonum=$sonum;
            if (!empty($nimi) && !empty($email) && !empty($sonum)) {
              if (strlen($nimi)>25 || strlen($email)>25 || strlen($sonum)>500 ) {
                echo'Tekstid on liiga pikad või email on valesti!';
              } else {
                //emaili andmed
                $to = 'banana.inc@gmail.com';
                $subject = 'Tagasiside kodulehelt';
                $message = $sonum;
                $from = 'From: '.$nimi.'<'.$email.'>';
                //CAPTCHA kontroll
                if ($_POST['kood']==$_SESSION['captchatekst']) {
                  //kas emaili saatmine õnnestus
                  if(mail($to, $subject, $message, $from)){
                    echo "Email saadetud!<br>Täname tagasiside eest!";
                    echo "<meta http-equiv=\"refresh\" content=\"2;URL='10_email.php'\">";
                    exit();
                  } else {
                    echo "Teie emaili ei saadetud ära!";
                  }
                } else{
                  echo "Turvakood on vale!";
                } 
              }
            } else {
              $error = 'Palun täida kõik väljad!';
            }
          }
          ?>
          <h2>Tagasiside</h2>
          <form action="" method="post">
            Teie nimi:<br>
            <input name="nimi" type="text" value="<?php echo $vnimi; ?>"><br>
            Teie email:<br>
            <input name="email" type="text" value="<?php echo $vemail; ?>"><br>
            Sõnum:<br>
            <textarea cols="30" rows="10" name="sonum"><?php echo $vsonum; ?></textarea><br>
            <img src="10_captcha.php"><br>
            Sisesta kood pildilt:<br>
            <input name="kood" type="text"><br>
            <input value="saada sõnum" type="submit">
          </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>