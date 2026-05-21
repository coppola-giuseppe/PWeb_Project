<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    function redirect(){
        try{
            if (isset($_SESSION['user']))
                throw new Exception();
    
        } catch(Exception $e){
            header("Location: ./php/homepage.php");
        }
    }

    redirect();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> playHub</title>
    <link rel="icon" href="./img/playHub_logo.png"  type="image/png">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/background.css">
    <script src="./js/index.js"></script>


</head>
<body>
    <div id="home">
        <img id="welcome_img" src="./img/playHub_logo.png" alt="playHub_logo" height="500">
        <div id="welcome_div">
            <h1>Welcome to <img src="./img/playHub_croppedLogo.png" alt="playHub_croppedLogo" width="200"></h1>
            <div id="login">
                <form method="post">
                    <fieldset>
                        <legend><h3>Accedi</h3></legend>
                    <em>Username</em> <input type="text" name="user" id="username" required><br><br>
                    <em>Password</em> <input type="password" name="pass" id="password" required>
                    
                    <img id="showPass" title="Mostra password" src="./img/eye.png" width="30" alt="">
                    
                    <br><br>
                    <p id="esito" hidden></p><br>
                    <button id="submit" type="submit">Login</button>
                    </fieldset>
                </form>
            </div>
            <br>
            <div id="tools">
                <a id="signup" href="./php/registrazione.php">Non sei registrato? Registrati ora!</a>
                 <br><br>
                <a id="recupero" href="./php/recuperoCredenziali.php">Hai perso la password? Recuperala qui!</a>
                 <br><br>
                <a id="info" href="./html/manuale.html">Non sai come funziona? Clicca qui!</a>
            </div>
        </div>
    </div>
</body>
</html>

