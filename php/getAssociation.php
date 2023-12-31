<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

/**
 * getAssociation.php
 *
 * Dieses Skript verarbeitet POST-Daten, um den Verband eines ausgewählten Vereins aus einer CSV-Datei zu finden.
 *
 * PHP-Version 8
 *
 * @category   Data Processing
 * @package    Participant_Registration
 * @author     Toralf Richter
 * @link       https://github.com/richtertoralf/sport-registration/
 */

chdir(__DIR__);

// Lese die POST-Daten (ausgewählter Vereinsname) aus dem HTTP-Request
$selectedClub = $_POST['selectedClub'];

/**
 * Funktion zum Lesen von Vereinen und ihren Verbänden aus einer CSV-Datei.
 *
 * @param string $filename - Der Dateipfad zur CSV-Datei mit Vereinsinformationen.
 * @return array - Ein assoziatives Array, das Vereine als Schlüssel und ihre Verbände als Werte enthält.
 */
function readClubsFromCSV($filename)
{
    $clubs = [];

    // Öffne die CSV-Datei im Lesemodus
    if (($handle = fopen($filename, "r")) !== FALSE) {
        // Lies jede Zeile der CSV-Datei
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $club = $data[0]; // Der Vereinsname befindet sich in der ersten Spalte
            $association = $data[1]; // Der Verband befindet sich in der zweiten Spalte
            $clubs[$club] = $association; // Füge den Vereinsnamen als Schlüssel und den Verband als Wert hinzu
        }
        // Schließe die CSV-Datei
        fclose($handle);
    }

    // Gib das Array mit den Vereinen und Verbänden zurück
    return $clubs;
}

// Rufe die Funktion auf und lese die Vereine und Verbände aus der 'clubs.csv'-Datei
$clubs = readClubsFromCSV('../data/clubs.csv');

// Finde den Verband für den ausgewählten Verein
// Wenn der ausgewählte Verein im Array existiert, weise den entsprechenden Verband zu. Andernfalls gib eine Meldung aus.
$association = isset($clubs[$selectedClub]) ? $clubs[$selectedClub] : '-';

// Gib den gefundenen Verband zurück als HTTP-Response
echo $association;
