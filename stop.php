<?php
session_start();

if (isset($_SESSION['proc_id'])) {
    $pid = $_SESSION['proc_id'];
    // Prozess beenden
    exec('kill ' . $pid);
    unset($_SESSION['proc_id']);
}
?>
