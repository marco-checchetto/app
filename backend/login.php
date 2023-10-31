<?php
session_start();

require 'dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo 'error';
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user_email = $_POST['email'];
$user_password = $_POST['password'];

$sql = "SELECT * FROM user WHERE email='$user_email'";

$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    if (password_verify($user_password, $row["password"])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_password'] = $row['password'];
        $_SESSION['user_username'] = $row['username'];
        header("Location: ../chat");
    } else {
        echo "Accesso fallito. Controlla le tue credenziali.";
    }
} else {
    echo "Utente inesistente";
}

$conn->close();
?>