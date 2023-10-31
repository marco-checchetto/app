<?php
session_start();

$_SESSION['chat_id'] = $_GET['chatid'];

header("Location: chat"); // Reindirizza alla chat corretta
?>