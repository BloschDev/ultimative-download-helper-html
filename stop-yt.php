<?php
session_start();

if (isset($_SESSION['process']) && is_resource($_SESSION['process'])) {
    proc_terminate($_SESSION['process']);
    echo "Process stopped.";
} else {
    echo "No running process found.";
}
?>
