<?php

session_start();

require 'dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed'. $conn->connect_error);
}

// Get form data
$user_name = $_POST['user_name'];
$user_surname = $_POST['user_surname'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

$sql = "INSERT INTO `user` (`name`, `surname`, `email`, `password`) VALUES ('$user_name', '$user_surname', '$user_email', '$user_password')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
    echo "Record created successfully";
    header("Location: ../chat.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>