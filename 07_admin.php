<?php
session_start();
if (!isset($_SESSION['tuvastamine'])) {
  header('Location: 07_login.php');
  exit();
  }
?>

<h1>Salajane info</h1>
<p>Salainfo</p>

<h2>Registreeri uus kasutaja</h2>
    <form action="register.php" method="post">
        <label for="kasutaja">Kasutajanimi:</label>
        <input type="text" id="kasutaja" name="kasutaja" required><br><br>
        <label for="parool">Parool:</label>
        <input type="password" id="parool" name="parool" required><br><br>
        <input type="submit" value="Registreeri">
    </form>

  <?php



  ?>




<hr>
<form action="07_logout.php" method="post">
 <input type="submit" value="Logi välja" name="logout">
</form>

