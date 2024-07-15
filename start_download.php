<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // URL aus dem Formular
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);

    // Zielverzeichnis
    $destinationDir = "/data";

    // Befehl erstellen
    $command = "gallery-dl -d " . escapeshellarg($destinationDir) . " " . escapeshellarg($url) . " > /tmp/gallery-dl-output.txt 2>&1 & echo $!";

    // Befehl ausführen und Prozess-Handler speichern
    $pid = shell_exec($command);

    // Prozess-ID speichern, um später zu beenden
    $_SESSION['proc_id'] = trim($pid);
}
?>
