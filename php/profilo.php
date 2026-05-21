<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    function loggato(){
        try{
            if (!isset($_SESSION['user']))
                throw new Exception();
    
        } catch(Exception $e){
            header("Location: ../html/pageNotFound.html");
        }
    }

    loggato();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/playHub_logo.png"  type="image/png">
    <link rel="stylesheet" href="../css/background.css">
    <link rel="stylesheet" href="../css/profilo.css">
    <script src="../js/profilo.js"></script>
    <title>Profilo</title>
</head>
<body>
    <div id="container1">
        <div id="container2">
            <div id="nav">
                <p id="title">Profilo</p>
                <div id='user'>
                    <strong ><?php echo $_SESSION["user"] ?></strong>
                    <a id="profile_link" href="./profilo.php" title="Vai al profilo" >
                        <img src="../img/userPic2.png" alt="User profile icon">
                    </a>
                    <a id="logout" onclick="location.href='./requests/quit.php'"  href="#" title="Logout" >
                        <img src="../img/logout.png" alt="Logout icon">
                    </a>
                </div>
            </div>
            
            <div id="dati">
                <fieldset>
                    <legend><h3>Dati utente</h3></legend>
                    <div id="credenziali">
                        <em id="user_title">Username</em> <p id="username"> <br> </p>
                        <em id="pass_title">Password</em> <input type="button" id="password" value="Cambia Password">
                    </div>
                    <br>
                    <em>Email</em> <p id="email"></p>
                    <br><br>
                    <p id="vuoto" hidden>Nessuna partita trovata</p>
                    <table id="games">
                        <caption style="text-align:left">Ultime partite giocate:</caption>
                    <tr>
                        <th>Data</th>
                        <th>Gioco</th>
                        <th>Esito</th>
                    </tr>
                    </table>
                </fieldset>
            </div>

            <div id="passChange" style="display: none">
                <fieldset>
                <legend><h3>Cambio password</h3></legend>
                    <form method="post" id="formPass">
                        <label for="oldPass">Password attuale:</label>
                        <input type="password" name="oldPass" id="oldPass">

                        <img id="showPass1" class="showbtn" title= "Mostra password" src="../img/eye.png" width="30" alt="">
                        
                        
                        <label for="newPass1">Nuova password</label>
                        <input type="password" class="confirm" name="newPass1" id="newPass1">

                        <img id="showPass2" class="showbtn" title= "Mostra password" src="../img/eye.png" width="30" alt="">

                        
                        <label for="newPass2">Conferma password:</label>
                        <input type="password" class="confirm" name="newPass2" id="newPass2">
                        <div></div>
                        
                        <input type="submit" id="confirmChange" value="Cambia password">
                    </form>
                </fieldset>
                <br><br>
            </div>

            <div id="esito">
            </div>

            <div id="passConditions" hidden>
                    <h4>La password deve:</h4>
                    <ul>
                        <li>Avere almeno 8 caratteri</li>
                        <li>Avere almeno una lettera maiuscola</li>
                        <li>Avere almeno una lettera minuscola</li>
                        <li>Avere almeno un numero</li>
                        <li>Avere almeno un carattere speciale tra</li>
                        <li style="list-style:none">!"#$%&'()*+,-./:;&lt;=&gt;?@[\]^_`{|}~</li>
                        <li>Non contenere spazi</li>
                    </ul>
                </div>


        </div>
    </div>


    <div id="homepage">
        <a href='./homepage.php'> <img height='45' src='../img/backHome.png' alt='Return to Homepage'> </a><br>
        <em style="text-align: center;">Ritorna alla Home</em>
    </div>
    
</body>
</html>