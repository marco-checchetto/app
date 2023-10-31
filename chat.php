<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login');
    exit;
}

if (isset($_SESSION['chat_id'])) {
    $chat_id = $_SESSION['chat_id'];
}

require 'backend/dbconfig.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];


$chat_id = null; // Inizializza $chat_id prima del ciclo while

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/chat.css">
    <!-- <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon"> -->
    <link rel="icon" type="image/png" sizes="32x32" href="./img/icon/favicon.png">
    <title>Chat</title>
</head>

<body>
    <div id="wrap">
        <div id="menu">
            <div id="topbar">
                <p id="welcome-name">
                    Hi,<?php echo $user_name; ?>
                </p>
                <button>+</button>
            </div>
            <div>
                <form action="./backend/create-chat" method="post" id=new-chat-form>
                    <div class="new-chat-text">
                        <label for="chat_name">Chat name:</label>
                        <br>
                        <input type="text" name="chat_name" id="chat_name" placeholder="Nome chat" required>
                    </div>
                    <div class="new-chat-text">
                        <label for="chat_users">Add users:</label>
                        <br>
                        <input type="text" name="chat_users" id="chat_users" placeholder="Utenti della chat" required>
                    </div>
                    <div class="p-footer">
                        <input type="submit" value="Crea chat" id="send">
                    </div>
                </form>
            </div>
            <div>
                <?php

                $sql = "SELECT r.chatid AS cid, c.name AS cname FROM chat c JOIN reference r ON c.id = r.chatid JOIN user u ON r.userid = u.id WHERE u.id = '$user_id'";

                $res = mysqli_query($conn, $sql);

                if (mysqli_num_rows($res) > 0) {
                    echo "<p id='title'>Chat</p>";
                    echo "<ul>";
                    //echo "pipoo";
                    //print_r($res);
                    //$row = mysqli_fetch_assoc($res);
                    //print_r($row);
                
                    while ($row = mysqli_fetch_assoc($res)) {
                        $name = $row['cname'];
                        //echo $name;
                        $chatid = $row['cid'];

                        ?>

                        <script>
                            setInterval(() => {
                                let xhr1 = new XMLHttpRequest();
                                xhr1.open("POST", "getLast.php", true);
                                xhr1.onload = () => {
                                    if (xhr1.readyState === XMLHttpRequest.DONE) {
                                        if (xhr1.status === 200) {
                                            let data1 = xhr1.response;
                                            document.getElementById("last").innerHTML = data1;
                                        }
                                    }
                                }
                                xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhr1.send();
                            }, 500);
                        </script>

                        <?php

                        echo "<li><a href='setVariable.php?chatid=$chatid' class='chat-list'>$name</a><p id='last'></p></li>";

                    }
                    echo "</ul>";
                } else {
                    echo "<p>Create a new chat and add your friends to start!</p>";
                }
                ?>
            </div>
            <a href="./backend/logout" id="logout">LOGOUT</a>
        </div>
        <div id="chat">
            <div id="chat-container">
                <?php
                if (isset($_SESSION['chat_id'])) {
                    $idchat = $_SESSION['chat_id'];
                    $sql10 = "SELECT c.name FROM chat c WHERE c.id = '$idchat'";
                    $res10 = mysqli_query($conn, $sql10);
                    $row10 = mysqli_fetch_assoc($res10);

                    $sql20 = "SELECT r.userid FROM reference r WHERE r.chatid = '$idchat'";
                    $res20 = mysqli_query($conn, $sql20);
                    $row20 = mysqli_fetch_assoc($res20);

                    echo "<div id='bar'>";
                    echo "<p class='title'>" . $row10['name'] . "</p>";
                    echo "<div class='user-list'>";
                    echo "<p>". $row20['userid'] ."</p>";
                    while ($row20 = mysqli_fetch_assoc($res20)) {
                        echo "<p>, ". $row20['userid'] ."</p>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
                ?>

                <div id="chat-messages"></div>

                <?php
                if (isset($_SESSION['chat_id'])) {
                    ?>

                    <script>
                        window.addEventListener('load', function () {
                            var element = document.querySelector('#chat');
                            element.scrollTop = 9999999;
                        })
                        setInterval(() => {
                            let xhr = new XMLHttpRequest();
                            xhr.open("POST", "messages.php", true);
                            xhr.onload = () => {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
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
                }
                ?>

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
                    xhttp.open("GET", "backend/send-message.php?message_content=" + x, true);
                    xhttp.onload = () => {
                        if (xhttp.readyState === XMLHttpRequest.DONE) {
                            if (xhttp.status === 200) {
                                let data = xhr.response;
                                var element = document.querySelector('#chat');
                                element.scrollTop = 9999999;
                            }
                        }
                    }
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send();
                }


                document.addEventListener("keydown", function (event) {
                    if (event.key === "Escape") {
                        // Your code to handle the "Esc" key press here
                        console.log("Escape key pressed!");
                    }
                });
            </script>
            <?php
            if (isset($_SESSION['chat_id'])) {
                ?>
                <form id="message-form" onsubmit="loadDoc(); return false">
                    <input type="text" name="message_content" id="message_content" placeholder="Scrivi un messaggio"
                        required>
                    <input type="hidden" name="chat_id" value="<?php echo $chat_id; ?>">
                    <input id="send_message" type="submit" value="Invia">
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>