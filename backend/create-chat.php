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

// Get form data
$chat_id = generateID(10);
$chat_name = $_POST['chat_name'];
$chat_users = $_POST['chat_users'];

// Suddivide gli ID degli utenti in un array
$user_ids_array = explode(',', $chat_users);

// Step 1: Creare una nuova voce in "ref" con "chat_id" auto-increment
$sql1 = "INSERT INTO `ref` (`chat_id`, `chat_name`) VALUES ('$chat_id', '$chat_name')";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();

// Step 2: Inserire nuove voci in "chats" per ogni utente
foreach ($user_ids_array as $user_id) {
    // Aggiungi utenti alla chat
    $sql2 = "INSERT INTO `chats` (`chat_id`, `user_id`) VALUES ('$chat_id', '$user_id')";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
}

// Chiudi la connessione al database
$conn->close();

header('Location: ../chat.php'); // Reindirizza alla lista delle chat
?>