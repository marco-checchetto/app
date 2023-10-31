<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'backend/dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['chat_id'])) {
    $chat_id = $_SESSION['chat_id'];
    $sql1 = "SELECT m.content AS mess, u.name AS uname FROM message m INNER JOIN user u ON u.id = m.userid WHERE m.chatid = '$chat_id' ORDER BY m.timestamp DESC LIMIT 1";
    $res1 = mysqli_query($conn, $sql1);
}

$last = "";
if (isset($res1)) {
    if(mysqli_num_rows($res1) > 0){
        $row1 = mysqli_fetch_assoc($res1);
        $last .= "<strong>" . $row1['uname'] . "</strong>: ";
        $last .= $row1['mess'];
    } else {
        $last .= "Hey, this chat is empty!";
    }
}

echo $last;
?>