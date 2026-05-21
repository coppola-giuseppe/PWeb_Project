<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    function loggato(){
        try{
            if (!isset($_SESSION['user']))
                throw new Exception();
    
        } catch(Exception $e){
            header("Location: ../../html/pageNotFound.html");
        }
    }
    
    loggato();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../img/playHub_logo.png"  type="image/png">
    <link rel="stylesheet" href="../../css/background.css">
    <link rel="stylesheet" href="../../css/giochi/sassoCartaForbici.css">
    <script src="../../js/giochi/sassoCartaForbici.js"></script>
    <title>Sasso Carta Forbici</title>
</head>
<body>
    <div id="container1a">
        <div id="container2a">
            <div id="nav">
                <p id="title">Sasso Carta Forbici</p>
                <div id='user'>
                    <strong><?php echo $_SESSION["user"] ?></strong>
                    <a id="profile_link" href="../profilo.php" title="Vai al profilo" >
                        <img src="../../img/userPic2.png" alt="User profile icon">
                    </a>
                    <a id="logout" onclick="location.href='../requests/quit.php'"  href="#" title="Logout" >
                        <img src="../../img/logout.png" alt="Logout icon">
                    </a>
                </div>
            </div>

            <div id="game">
                <div id="start">
                    <img src="../../img/giochi/sasso%20carta%20forbici/sassoCartaForbiciClean.png" width="400" alt="Sasso Carta Forbici Image">
                    <br>
                    <button id="startButton">Inizia a giocare</button>
                </div>
                
                <div id="scegli" style="display: none;">
                    <h1>SCEGLI COSA GIOCARE</h1>
                    <div id="carta" class="scelta">
                        <img src="../../img/giochi/sasso%20carta%20forbici/carta.png" width="200" alt="">
                        <br><br>
                        <strong>CARTA</strong>
                    </div>

                    <div id="forbici" class="scelta">
                        <img src="../../img/giochi/sasso%20carta%20forbici/forbici.png" width="200" alt="">
                        <br><br>
                        <strong>FORBICI</strong>
                    </div>

                    <div id="sasso" class="scelta">
                        <img src="../../img/giochi/sasso%20carta%20forbici/sasso.png" width="200" alt="">
                        <br><br>
                        <strong>SASSO</strong>
                    </div>
                </div>

                <div id="gioca" style="display: none;">
                    <p id="countdown"></p>
                    <br>
                    <div id="giocatore">
                        <strong style="font-size: x-large;"><?php echo $_SESSION["user"] ?></strong>
                        <img id="img" src="../../img/giochi/sasso%20carta%20forbici/sasso.png" width="200" alt="">
                    </div>
                    <div id="cpu">
                        
                        <img id="imgCPU" src="../../img/giochi/sasso%20carta%20forbici/sassoCPU.png" width="200" alt="">
                        <strong style="font-size: x-large;">CPU</strong>
                    </div>
                    <div id="esito"></div>
                    <button id="reset" hidden>Rigioca</button>
                </div>
                
                <div id="homepage">
                    <a href='../homepage.php'> <img height='45' src='../../img/backHome.png' alt='Return to Homepage'> </a><br>
                    <em style="text-align: center;">Ritorna alla Home</em>
                </div>

            </div>

            

        </div>
    </div>


    <div id="container1b">
        <div id="container2b">
            <div id="regole">
                <h2>Regole</h2>
                <img src="../../img/giochi/sasso%20carta%20forbici/regole.png" width="300" alt="">
                <p>
                    <strong style="color: green;">CARTA</strong> batte <strong style="color: red;">SASSO</strong>
                    <br>
                    <strong style="color: green;">SASSO</strong> batte <strong style="color: red;">FORBICI</strong>
                    <br>
                    <strong style="color: green;">FORBICI</strong> batte <strong style="color: red;">CARTA</strong>
                </p>
            </div>
          
        </div>
    </div>

</body>
</html>