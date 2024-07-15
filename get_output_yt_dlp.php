<?php
session_start();

if (file_exists('/tmp/yt-dlp-output.txt')) {
    $output = file_get_contents('/tmp/yt-dlp-output.txt');
    file_put_contents('/tmp/yt-dlp-output.txt', '');
    echo nl2br($output);
}
?>
