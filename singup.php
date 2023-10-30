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
    <link rel="stylesheet" href="../css/singup.css">
    <title>Singup</title>
</head>
<body>
    <p>REGISTRATI</p>
    <form action="./backend/singup.php" method="post" id="form">
        <div class="field">
            <label for="user_name">Nome</label>
            <input type="text" name="user_name" id="user_name" placeholder="Nome utente" required>
        </div>
        <div class="field">
            <label for="user_surname">Cognome</label>
            <input type="text" name="user_surname" id="user_surname" placeholder="Cognome utente" required>
        </div>
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
    <script src="../js/check-singup.js"></script>
</body>
</html>