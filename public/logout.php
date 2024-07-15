<?php
session_start(); // Pokreće sesiju

// Uništavanje sesije
$_SESSION = array();
session_destroy();

// Preusmjeravanje na stranicu za prijavu
header('Location: login.php');
exit;
?>