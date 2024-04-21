<?php
// START SESSION IF NOT STARTED
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /Web-Programim/src/index.php");
    exit();
}
?>
