<?php
session_start();

$outputFile = '/tmp/yt-dlp-output.txt';

if (file_exists($outputFile)) {
    $output = file_get_contents($outputFile);
    file_put_contents($outputFile, '');
    echo nl2br($output);
}
?>
