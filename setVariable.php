<?php
session_start();

$_SESSION['chat_id'] = $_GET['chatid'];

header("Location: chat.php"); // Reindirizza alla chat corretta
?>