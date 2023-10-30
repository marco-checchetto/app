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

$sql = "SELECT id, name FROM user WHERE email='$user_email' AND password='$user_password'";

$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];
    header("Location: ../chat.php");
} else {
    echo "Accesso fallito. Controlla le tue credenziali.";
}

$conn->close();
?>