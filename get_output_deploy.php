<?php
session_start();

if (file_exists('/tmp/deploy-output.txt')) {
    $output = file_get_contents('/tmp/deploy-output.txt');
    file_put_contents('/tmp/deploy-output.txt', '');
    echo nl2br($output);
}
?>
