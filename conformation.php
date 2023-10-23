<?php
/**
 * conformation.php
 *
 * Diese Datei verarbeitet die Formulardaten von 'index.php' nach dem Abschicken des Formulars.
 * Die Daten werden in einer CSV-Datei gespeichert und auf der Webseite angezeigt.
 *
 * PHP-Version 8
 *
 * @category   Data Processingg
 * @package    Registration_Form
 * @author     Toralf Richter
 * @link       https://github.com/richtertoralf/sport-registration/
 */
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anmeldung</title>
  <link rel="stylesheet" href="styles.css"> <!-- Hier wird die CSS-Datei eingebunden -->
</head>

<body>

  <div class="container_registration">

    <?php
// Überprüfen, ob die Anfrage vom POST-Formular kommt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formulardaten erhalten
    $spNr = $_POST["regEntry"][0]["SpNr"];
    $surname = $_POST["regEntry"][0]["surname"];
    $forename = $_POST["regEntry"][0]["forename"];
    $sex = $_POST["regEntry"][0]["sex"];
    $yearofbirth = $_POST["regEntry"][0]["yearofbirth"];
    $club = $_POST["regEntry"][0]["club"];
    $group = $_POST["regEntry"][0]["group"];
    $email = $_POST["single_email"];

    // Spaltenköpfe für die CSV-Datei
    $headers = ["Startpassnummer", "Nachname", "Vorname", "Geschlecht", "Geburtsjahr", "Verein", "Gruppe", "E-Mail"];

    // Daten in CSV-Datei speichern
    $data = [$spNr, $surname, $forename, $sex, $yearofbirth, $club, $group, $email];
    $csvFile = fopen("data.csv", "a"); // öffne die CSV-Datei im Anhänge-Modus

    if (filesize("data.csv") == 0) {
        // Wenn die Datei leer ist, schreibe die Spaltenköpfe
        fputcsv($csvFile, $headers);
    }

    fputcsv($csvFile, $data); // schreibe die Daten in die CSV-Datei
    fclose($csvFile); // schließe die CSV-Datei

            // Daten auf der Webseite anzeigen
            echo "<h2>Einzelanmeldung erfolgreich eingegangen:</h2>";
            echo "<table>";
            echo "<tr><td>Startpassnummer:</td><td>$spNr</td></tr>";
            echo "<tr><td>Nachname:</td><td>$surname</td></tr>";
            echo "<tr><td>Vorname:</td><td>$forename</td></tr>";
            echo "<tr><td>Geschlecht:</td><td>$sex</td></tr>";
            echo "<tr><td>Geburtsjahr:</td><td>$yearofbirth</td></tr>";
            echo "<tr><td>Verein:</td><td>$club</td></tr>";
            echo "<tr><td>Gruppe:</td><td>$group</td></tr>";
            echo "<tr><td>E-Mail:</td><td>$email</td></tr>";
            echo "</table>";
  
} else {
    echo "Ungültige Anfrage";
}

// Navigation einfügen
include('navigation.php');
?>
  </div>
  
</body>

</html>
