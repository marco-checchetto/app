<?php 
    session_start();

    include_once "dbconfig.php";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo 'error';
        die("Connection failed: " . $conn->connect_error);
    }

    // if(isset($_SESSION['unique_id'])){
    //     $chat_id = $_SESSION['chat_id'];
    //     $author_id = $_SESSION['user_id'];
    //     $message = mysqli_real_escape_string($conn, $_POST['message_content']);

    //     if(!empty($message)){
    //         $sql = "INSERT INTO `message` (`chatid`, `userid`, `content`) VALUES ('$chat_id', '$author_id', '$message')";
    //     }
    // }else{
    //     header("location: ../login.php");
    // }


    
?>