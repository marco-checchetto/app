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
    <title>Singup</title>
</head>
<body>
    <!-- <p>REGISTRATI</p>
    <form action="./backend/singup" method="post" id="singup">
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
    </form> -->


    <div class="body">
        <div class="access-card">
            <p class="title">SINGUP</p>
            <p class="subtitle">Inserisci i dati</p>
            <form method="post" action="./backend/singup" class="access-form" id="singup">
                <div class="first">
                    <div id="name" class="name">
                        <input id="i-name" class="input" type="text" name="name" placeholder="nome">
                        <div id="e-name" class="e e-hidden">Inserire un nome</div>
                    </div>
                    <div id="surname" class="surname">
                        <input id="i-surname" class="input" type="text" name="surname" placeholder="cognome">
                        <div id="e-surname" class="e e-hidden">Inserire un cognome</div>
                    </div>
                </div>
                <div id="email" class="email">
                    <input id="i-email" class="input" type="text" name="email" placeholder="e-mail">
                    <div id="e-email" class="e e-hidden">L'e-mail non può essere vuota</div>
                    <div id="e-email-valid" class="e e-hidden">Inserire una e-mail valida</div>
                </div>
                <div id="password" class="password">
                    <input id="i-pass" class="input" type="password" name="password" placeholder="password">
                    <div id="e-pass" class="e e-hidden">La password non puo essere vuota</div>
                </div>
                <input type="submit" value="SINGUP">
                <?php 
                if ($error) {
                    echo "<p class='incorrect'>$error</p>";
                }
                ?>
                <a href="login">Effettua l'accesso</a>
            </form>
        </div>
    </div>
    <script src="./js/singup.js"></script>
</body>
</html>