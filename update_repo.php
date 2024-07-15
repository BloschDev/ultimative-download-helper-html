<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Befehle ausführen
    $output = [];
    $return_var = 0;

    exec('git clone https://github.com/BloschDev/ultimative-download-helper-html.git /tmp/repo && cp -r /tmp/repo/* /var/www/html/ && rm -rf /tmp/repo', $output, $return_var);

    // Ergebnis anzeigen
    if ($return_var === 0) {
        echo "Update erfolgreich:<br>" . implode("<br>", $output);
    } else {
        echo "Fehler beim Update:<br>" . implode("<br>", $output);
    }
}
?>
