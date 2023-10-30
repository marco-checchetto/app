<?php
session_start();

require 'dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo 'error';
    die("Connection failed: " . $conn->connect_error);
}

$chat_name = $_POST['chat_name'];
$chat_users = $_POST['chat_users'];

// Suddivide gli ID degli utenti in un array
$user_ids_array = explode(',', $chat_users);

// Check unique name
$sql4 = "SELECT * FROM chat WHERE name = '$chat_name'";
$res4 = mysqli_query($conn, $sql4);
if(/*mysqli_num_rows($res4) > 0*/ false){
    echo "chat already exists";
} else {
    // Step 1: Creare una nuova voce in "ref" con "chat_id" auto-increment
    $sql1 = "INSERT INTO `chat` (`name`) VALUES ('$chat_name')";
    $res1 = mysqli_query($conn, $sql1);
    
    $sql2 = "SELECT id FROM chat WHERE name = '$chat_name'";
    $res2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($res2);
    $new_id = $row['id'];
    //echo "$new_id";
    
    // Step 2: Inserire nuove voci in "chats" per ogni utente
    foreach ($user_ids_array as $user_id) {
        // Aggiungi utenti alla chat
        $sql3 = "INSERT INTO `reference` (`chatid`, `userid`) VALUES ('$new_id', '$user_id')";
        $res3 = mysqli_query($conn, $sql3);
    }
}

// Chiudi la connessione al database
$conn->close();

header('Location: ../chat.php'); // Reindirizza alla lista delle chat
?>