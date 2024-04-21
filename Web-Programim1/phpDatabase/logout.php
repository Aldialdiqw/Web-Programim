<?php 
session_start();


// UNSET SESSION VARIABLES 
$_SESSION = array();


session_destroy();


header("Location: /Web-Programim/src/index.php");
exit();


?>