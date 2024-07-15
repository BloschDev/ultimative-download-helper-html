<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Shell-Skript ausführen
    $output = [];
    $return_var = 0;

    // Pfad zum deploy.sh Skript
    $deploy_script = '/var/www/html/deploy.sh';

    // Überprüfen, ob die Datei existiert und ausführbar ist
    if (file_exists($deploy_script) && is_executable($deploy_script)) {
        exec("sudo $deploy_script 2>&1", $output, $return_var);

        // Ergebnis anzeigen
        if ($return_var === 0) {
            echo "Update Done:<br>" . implode("<br>", $output);
        } else {
            echo "Update Error:<br>" . implode("<br>", $output);
        }
    } else {
        echo "Das Skript $deploy_script existiert nicht oder ist nicht ausführbar.";
    }
}
?>
