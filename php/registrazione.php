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
    <link rel="icon" href="../img/playHub_logo.png"  type="image/png">
    <title>Registrazione</title>
    <link rel="stylesheet" href="../css/background.css">
    <link rel="stylesheet" href="../css/registrazione.css">
    <script src="../js/registrazione.js"></script>
</head>
<body>
    <div id="container1">
        <div id='container2'>
            <p id="title">Modulo di registrazione</p>
            <form method="post">
                <fieldset>
                    <legend>Compila i seguenti campi e clicca il pulsante "Registrati"</legend>
                <label for="username">Nome utente:</label>
                    <input type="text" id="username" name="user" required>
                    <p></p>
                <label for="pass1">Password:</label>
                    <input type="password" id="pass1" name="pass" class="password" required>
                <img id="showPass" title= "Mostra password" src="../img/eye.png" width="30" alt="">
                
                <label for="pass2">Conferma password:</label>
                    <input type="password" id="pass2" name="passConf" class="password" required>
                    <p></p>
                
                <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                    <p></p>
                <label for="domanda">Domanda di recupero:</label>
                    <select name="domanda" id="domanda" required>
                        
                    <!-- Questa parte viene vista come errore dal validatore ma è l'unica che permette l'uso di un
                    placeholder nel select che ho trovato, ho visto anche che è usata e funziona bene
                    nelle attuali versioni dei browser -->

                        <option value="0" selected disabled hidden>Scegli una domanda di recupero:</option>
                        <option value="1">Nome del tuo primo animale domestico?</option>
                        <option value="2">Qual è la tua squadra preferita?</option>
                        <option value="3">Soprannome da bambino?</option>
                        <option value="4">Qual è la tua città natale?</option>
                        <option value="5">Nome del tuo migliore amico?</option>
                        <option value="6">Titolo del tuo libro preferito?</option>
                    </select>
                    <p></p>
                
                <label for="risposta">Risposta alla domanda:</label>
                    <input type="text" id="risposta" name="risposta" required>
                    <p></p>
                    
                <input type="submit" id="submit" value="Registrati!">
            </fieldset>
            </form>
            <div id='footer'>
                <div id="passVerify" hidden>
                    <h4>La password deve:</h4>
                    <ul>
                        <li>Avere almeno 8 caratteri</li>
                        <li>Avere almeno una lettera maiuscola</li>
                        <li>Avere almeno una lettera minuscola</li>
                        <li>Avere almeno un numero</li>
                        <li>Avere almeno un carattere speciale tra &nbsp;</li>
                        <li style="list-style:none">!"#$%&'()*+,-./:;&lt;=&gt;?@[\]^_`{|}~</li>
                        <li>Non contenere spazi</li>
                    </ul>
                </div>
                <p id="esito"></p>
            </div>
        </div>
    </div>
    <div id="homepage">
        <a href='../index.php'> <img height='30' src='../img/backHome.png' alt='Return to Homepage'> </a><br>
        <em style="text-align: center;">Ritorna alla Home</em>
    </div>

</body>
</html>