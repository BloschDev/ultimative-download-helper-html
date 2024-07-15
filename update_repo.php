<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Befehle ausführen
    $output = [];
    $return_var = 0;

    // Repository klonen
    exec('git clone https://github.com/BloschDev/ultimative-download-helper-html.git /tmp/repo 2>&1', $output, $return_var);
    if ($return_var !== 0) {
        echo "Fehler beim Klonen des Repositories:<br>" . implode("<br>", $output);
        exit;
    }

    // Dateien kopieren
    $output = [];
    exec('cp -r /tmp/repo/* /var/www/html/ 2>&1', $output, $return_var);
    if ($return_var !== 0) {
        echo "Fehler beim Kopieren der Dateien:<br>" . implode("<br>", $output);
        exit;
    }

    // Temporäres Repository entfernen
    $output = [];
    exec('rm -rf /tmp/repo 2>&1', $output, $return_var);
    if ($return_var !== 0) {
        echo "Fehler beim Entfernen des temporären Repositories:<br>" . implode("<br>", $output);
        exit;
    }

    echo "Update erfolgreich:<br>" . implode("<br>", $output);
}
?>
