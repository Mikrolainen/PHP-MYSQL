<?php include('config.php'); ?>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kasutaja = $_POST['kasutaja'];
    $parool = $_POST['parool'];
    
    $sql = "SELECT COUNT(*) FROM kasutajad WHERE kasutaja = ?";
    $stmt = $yhendus->prepare($sql);
    if ($stmt === false) {
        die("Valmistamise ebaõnnestus: " . $yhendus->error);
    }
    
    $stmt->bind_param("s", $kasutaja);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        die("Viga: Kasutajanimi on juba kasutusel.");
    }

    $sool = 'taiestisuvalinetekst';
    $krupteeritudParool = crypt($parool, $sool);

    $sql = "INSERT INTO kasutajad (kasutaja, parool) VALUES (?, ?)";

    $stmt = $yhendus->prepare($sql);
    if ($stmt === false) {
        die("Valmistamise ebaõnnestus: " . $yhendus->error);
    }

    $stmt->bind_param("ss", $kasutaja, $krupteeritudParool);

    if ($stmt->execute() === true) {
        echo "Uus kasutaja on edukalt registreeritud!";
    } else {
        echo "Viga: " . $sql . "<br>" . $yhendus->error;
    }

    $stmt->close();
}

$yhendus->close();
?>
