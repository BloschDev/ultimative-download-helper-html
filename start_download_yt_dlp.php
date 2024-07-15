<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $format = isset($_POST['format']) ? filter_var($_POST['format'], FILTER_SANITIZE_STRING) : '18';
    $outputTemplate = "/data/vdl/%(channel)s - %(title)s.%(ext)s";

    $command = "yt-dlp -f " . escapeshellarg($format) . " -o " . escapeshellarg($outputTemplate) . " " . escapeshellarg($url) . " > /tmp/yt-dlp-output.txt 2>&1 & echo $!";

    $pid = shell_exec($command);
    $_SESSION['yt_dlp_pid'] = trim($pid);
}
?>
