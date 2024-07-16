<?php
session_start();

$output = [];
$return_var = 0;

// Befehl zum Ausführen des Deploy-Skripts
$deploy_script = '/var/www/deploy.sh';

if (file_exists($deploy_script) && is_executable($deploy_script)) {
    exec("sudo $deploy_script > /tmp/deploy-output.txt 2>&1 & echo $!", $output, $return_var);
    $_SESSION['deploy_pid'] = trim($output[0]);
    echo "Deployment gestartet.";
} else {
    echo "Das Skript $deploy_script existiert nicht oder ist nicht ausführbar.";
}
?>
