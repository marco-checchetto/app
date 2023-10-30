<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if(isset($_GET['chat_id'])) {
    $_SESSION['chat_id'] = $_GET['chat_id'];
}

require 'backend/dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

$sql = "SELECT chats.chat_id, ref.chat_name FROM chats JOIN users ON chats.user_id = users.user_id JOIN ref ON chats.chat_id = ref.chat_id WHERE users.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Utilizza bind_param per passare il valore in modo sicuro
$stmt->execute();
$stmt->bind_result($chat_id, $chat_name);

$chat_id = null; // Inizializza $chat_id prima del ciclo while

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<style>
    .own-message {
        color: red;
    }
</style>
<body>
    <a href="./backend/logout.php">ESCI</a>
    <p><?php echo $user_name; ?></p>
    <div>
        <form action="./backend/create-chat.php" method="post">
            <div>
                <label for="chat_name">Nome chat</label>
                <input type="text" name="chat_name" id="chat_name" placeholder="Nome chat" required>
            </div>
            <div>
                <label for="chat_users">Utenti della chat</label>
                <input type="text" name="chat_users" id="chat_users" placeholder="Utenti della chat" required>
            </div>
            <div class="p-footer">
                <input type="submit" value="Crea chat" id="send">
            </div>
        </form>
    </div>
    <div>
        <?php
        echo "<h2>Le tue chat:</h2>";
        echo "<ul>";
        while ($stmt->fetch()) {
            if(isset($_GET['chat_id'])) {
                $id_chat = $_GET['chat_id'];
            }
            echo "<li><a href='chat.php?chat_id=$chat_id'>$chat_name</a></li>";
            
        }
        echo "</ul>";

        $stmt->close();
        ?>
    </div>

    <div id="chat-container">
    <div id="chat-messages"></div>

    <script>
        setInterval(() =>{
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "messages.php", true);
            xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    document.getElementById("chat-messages").innerHTML = data;
                }
            }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send();
        }, 500);
    </script>

    <?php
    // // Aggiungi il codice per recuperare e visualizzare i messaggi qui
    // $sql_mess = "SELECT * FROM app WHERE chat_id = '$id_chat' ORDER BY message_timestamp";
    // //echo "$sql_mess";
    // $result = mysqli_query($conn, $sql_mess);

    // while ($row = mysqli_fetch_array($result)) {
    //     $userid = $row['user_id'];
    //     $sql_user = "SELECT * FROM users WHERE user_id = '$userid'";
    //     $res = mysqli_query($conn, $sql_user);
    //     $roww = mysqli_fetch_array($res);
    //     $message_class = ($row['user_id'] == $user_id) ? 'own-message' : 'other-message';
    //     echo "<div class='$message_class'>". $roww['user_name'] ." > ". $row['message_timestamp'] ." : ". $row['message_content'] ."</div>";
    // }
    // $conn->close();
    ?>
    </div>

    <script>
        function loadDoc() {
            let x = document.forms["message-form"]["message_content"].value;
            document.getElementById("message_content").value = "";
            let xhttp = new XMLHttpRequest();
            xhttp.open("GET", "backend/send-message.php?message_content="+x, true);
            xhttp.onload = ()=>{
                if(xhttp.readyState === XMLHttpRequest.DONE){
                    if(xhttp.status === 200){
                    }
                }
            }
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();
        }
    </script>
    <?php
        if(isset($_GET['chat_id'])) {
    ?>
    <form id="message-form" onsubmit="loadDoc(); return false">
        <input type="text" name="message_content" id="message_content" placeholder="Scrivi un messaggio" required>
        <input type="hidden" name="chat_id" value="<?php echo $id_chat; ?>">
        <input type="submit" value="Invia">
    </form>
    <?php
        }
    ?>
</body>
</html>
