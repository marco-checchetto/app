<?php

session_start();

require 'dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed'. $conn->connect_error);
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
$user_id = generateID(10);
$user_name = $_POST['user_name'];
$user_surname = $_POST['user_surname'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

$sql = "INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`) VALUES ('$user_id', '$user_name', '$user_surname', '$user_email', '$user_password')";

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