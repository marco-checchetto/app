<?php
session_start();

require 'dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo 'error';
    die("Connection failed: " . $conn->connect_error);
}

// Recupera il chat_id dalla query string dell'URL (dall'URL)
// $chat_id = $_GET['chat_id'];

// Get form data
// $message_id = generateID(10);
$message_id = uniqid();
$chat_id = $_SESSION['chat_id'];
$author_id = $_SESSION['user_id'];
$message_content = $_GET['message_content'];

// Inserisci il messaggio con il chat_id corretto
$sql = "INSERT INTO `message` (`chatid`, `userid`, `content`) VALUES ('$chat_id', '$author_id', '$message_content')";
$res = mysqli_query($conn, $sql);

// Chiudi la connessione al database
$conn->close();

header("Location: ../chat.php"); // Reindirizza alla chat corretta
?>