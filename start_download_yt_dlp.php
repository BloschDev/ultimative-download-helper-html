<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $outputDir = "/data/vdl";

    $command = "yt-dlp -o " . escapeshellarg($outputDir) . " " . escapeshellarg($url) . " > /tmp/yt-dlp-output.txt 2>&1 & echo $!";

    $pid = shell_exec($command);
    $_SESSION['yt_dlp_pid'] = trim($pid);
}
?>
