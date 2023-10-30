<?php
session_start();

require 'dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo 'error';
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

$sql = "SELECT user_id, user_name FROM users WHERE user_email='$user_email' AND user_password='$user_password'";

$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($user_id, $user_name);

if ($stmt->fetch()) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
    header("Location: ../chat.php");
} else {
    echo "Accesso fallito. Controlla le tue credenziali.";
}

$stmt->close();
$conn->close();
?>