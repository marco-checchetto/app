<?php
session_start();

require 'dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo 'error';
    die("Connection failed: " . $conn->connect_error);
}

function generateID($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $id = '';
    for ($i = 0; $i < $length; $i++) {
        $id .= $characters[rand(0, $charactersLength - 1)];
    }
    return $id;
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
$sql = "INSERT INTO `app` (`chat_id`, `user_id`, `message_id`, `message_content`) VALUES ('$chat_id', '$author_id', '$message_id', '$message_content')";
$stmt = $conn->prepare($sql);
// $stmt->bind_param("iiis", $chat_id, $author_id, $message_id, $message_content);
$stmt->execute();

// Chiudi la connessione al database
//$conn->close();

//header("Location: ../chat.php?chat_id=$chat_id"); // Reindirizza alla chat corretta
?>