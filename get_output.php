<?php
session_start();

if (file_exists('/tmp/gallery-dl-output.txt')) {
    // Lese die neue Ausgabe aus der Datei und gebe sie zurück
    $output = file_get_contents('/tmp/gallery-dl-output.txt');
    // Leere die Datei nach dem Lesen
    file_put_contents('/tmp/gallery-dl-output.txt', '');
    // Ersetze Zeilenumbrüche durch <br> für HTML
    echo nl2br($output);
}
?>
