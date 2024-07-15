<?php
session_start();

if (file_exists('/tmp/gallery-dl-output.txt')) {
    $output = file_get_contents('/tmp/gallery-dl-output.txt');
    file_put_contents('/tmp/gallery-dl-output.txt', '');
    echo nl2br($output);
}
?>
