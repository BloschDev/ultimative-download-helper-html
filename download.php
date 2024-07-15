<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // URL aus dem Formular
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);

    // Zielverzeichnis
    $destinationDir = "/data";

    // Befehl erstellen
    $command = "gallery-dl -d " . escapeshellarg($destinationDir) . " " . escapeshellarg($url);

    // Befehl ausführen und Prozess-Handler speichern
    $proc = proc_open($command, [
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w']
    ], $pipes);

    // Prozess-ID speichern, um später zu beenden
    $_SESSION['proc_id'] = proc_get_status($proc)['pid'];

    if (is_resource($proc)) {
        while ($line = fgets($pipes[1])) {
            echo $line;
            @flush();
            @ob_flush();
        }
    }

    // Prozesse schließen
    fclose($pipes[1]);
    proc_close($proc);
}
?>
