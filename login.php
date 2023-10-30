<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: chat.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <form action="./backend/login.php" method="post" id="login">
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
    <a href="singup.php">SINGUP</a>
</body>
</html>