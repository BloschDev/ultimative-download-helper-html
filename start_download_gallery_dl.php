<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $destinationDir = "/data/dl";

    $command = "gallery-dl -d " . escapeshellarg($destinationDir) . " " . escapeshellarg($url) . " > /tmp/gallery-dl-output.txt 2>&1 & echo $!";

    $pid = shell_exec($command);
    $_SESSION['gallery_dl_pid'] = trim($pid);
}
?>
