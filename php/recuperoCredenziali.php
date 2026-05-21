<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    function redirect(){
        try{
            if (isset($_SESSION['user']))
                throw new Exception();
    
        } catch(Exception $e){
            header("Location: ./homepage.php");
        }
    }
    
    redirect();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupero Credenziali</title>
    <link rel="icon" href="../img/playHub_logo.png"  type="image/png">
    <link rel="stylesheet" href="../css/background.css">
    <link rel="stylesheet" href="../css/recuperoCredenziali.css">
    <script src="../js/recuperoCredenziali.js"></script>
</head>
<body>

    <div id="container">

        <!-- controllo username/email -->
        <div id="form_check">
            <h1>Hai perso la password?</h1><br>
            <h3>Inserisci l'username e l'email associata per iniziare il recupero!</h3> <br>
            <form method="post" id="user_mail">
                <strong>Username:</strong> <input type="text" class="input" name="username">
                <strong>Email:</strong> <input type="email" class="input" name="email">
                <input type="submit" id="submit" value="Recupera">
            </form><br>
            <div id="EsitoInvio1" class="esito" hidden></div>
        </div>

        <!-- controllo risposta di sicurezza -->
        <div id="check_answer" hidden>
            <h3>Inserisci la risposta data in fase di registrazione</h3><br>
                <div id="form_verify">
                    <p><strong>Domanda di recupero: </strong><em class="input_2" id="domanda"></em></p>
                    <form method="post" id="answer">
                        <label for="risposta"><strong>Risposta:</strong></label>
                        <input class="input_2" type="text" id="risposta" name="risposta"><br><br>
                        <input type="submit" id="verify" value="Verifica">
                    </form>
                </div><br>
            <div id="EsitoInvio2" class="esito" hidden></div>
        </div>

        <!-- aggiorno password  -->
        <div id="updatePass" hidden>
            <h3>Risposta esatta, aggiorna le credenziali:</h3><br>
                <div id="form_update">
                    <form method="post" id="update">
                    <label for="pass"><strong>Nuova password:</strong></label>
                        <input type="password" name="pass" id="pass" class="input pass">
                    <img id="showPass" title ="Mostra password" src="../img/eye.png" width="30" alt="">
                    <label for="passConf"><strong>Conferma password:</strong></label>
                        <input type="password" id="passConf" name="passConf" class="input pass">
                        <br>
                        <input type="submit" id="updateBtn" value="Aggiorna password">
                    </form>
                </div><br><br>
            <div id="EsitoInvio3" class="esito" hidden></div>
        </div>

        
        
       
    </div> 

    <div id="homepage">
        <a href="../index.php"> <img height="30" src="../img/backHome.png" alt="Return to Homepage"> </a><br>
        <em>Ritorna alla Home</em>
    </div>

</body>
</html>