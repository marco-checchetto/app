<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    // Initialize your database connection

    require 'backend/dbconfig.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    $user_id = $_SESSION['user_id'];
    $output = "";
    
    if (isset($_SESSION['chat_id'])) {
        $chat_id = $_SESSION['chat_id'];
        echo $chat_id;
        $sql = "SELECT * FROM app m JOIN users u ON u.user_id = m.user_id WHERE m.chat_id = '$chat_id' ORDER BY m.message_timestamp";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $message_class = ($row['user_id'] == $user_id) ? 'own-message' : 'other-message';
                $output .= "<div class='$message_class'>". $row['user_name'] ." > ". $row['message_timestamp'] ." : ". $row['message_content'] ."</div>";
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
    } else {
        $output .= '<div class="text">Select a chat first.</div>';
    }
    
    echo $output;
?>
