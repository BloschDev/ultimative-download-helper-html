<?php
session_start();

$url = $_GET['url'];
$cmd = "yt-dlp -o /data/vdl " . escapeshellarg($url) . " 2>&1";

// Start the process
$descriptorspec = array(
    0 => array("pipe", "r"),
    1 => array("pipe", "w"),
    2 => array("pipe", "w")
);

$process = proc_open($cmd, $descriptorspec, $pipes);
if (is_resource($process)) {
    $_SESSION['process'] = $process;
    while ($line = fgets($pipes[1])) {
        echo $line . "<br>";
        ob_flush();
        flush();
    }
    fclose($pipes[1]);
    proc_close($process);
    unset($_SESSION['process']);
} else {
    echo "Failed to start the process.";
}
?>
