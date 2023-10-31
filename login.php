<?php
session_start();

$error = '';

if (isset($_SESSION["user_id"])) {
    header("Location: chat");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/access.css">
    <title>Login</title>
</head>
<body>
    <!-- <form action="./backend/login" method="post" id="login">
        <div class="field">
            <label for="user_email">Email</label>
            <input type="text" name="user_email" id="user_email" placeholder="Email utente" required>
        </div>
        <div class="field">
            <label for="user_password">Password</label>
            <input type="password" name="user_password" id="user_password" placeholder="Password utente" required>
        </div>
        <p id="u-error" class="hidden">Compilare tutti i campi</p>
        <div class="p-footer">
            <input type="submit" value="Invia" id="send">
        </div>
    </form>
    <a href="singup">SINGUP</a> -->


    <div class="body">
        <div class="access-card">
            <p class="title">LOGIN</p>
            <p class="subtitle">Inserisci le tue credenziali</p>
            <form method="post" action="./backend/login" class="access-form" id="login">
                <div id="email" class="email">
                    <input id="i-email" class="input" type="text" name="email" placeholder="e-mail">
                    <div id="e-email" class="e e-hidden">L'e-mail non può essere vuota</div>
                    <div id="e-email-valid" class="e e-hidden">Inserire una e-mail valida</div>
                </div>
                <div id="password" class="password">
                    <input id="i-pass" class="input" type="password" name="password" placeholder="password">
                    <div id="e-pass" class="e e-hidden">La password non puo essere vuota</div>
                </div>
                <input type="submit" value="LOGIN">
                <?php 
                if ($error) {
                    echo "<p class='incorrect'>$error</p>";
                }
                ?>
                <a href="singup">Effettua la registrazione</a>
            </form>
        </div>
    </div>
    <script src="./js/login.js"></script>
</body>
</html>