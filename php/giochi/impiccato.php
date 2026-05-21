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
    <title>Impiccato</title>
    <link rel="stylesheet" href="../../css/background.css">
    <link rel="stylesheet" href="../../css/giochi/impiccato.css">
    <script src="../../js/giochi/impiccato.js"></script>
</head>
<body>
    <div id="container1">
        <div id="container2">
            <div id="title">Gioco dell'Impiccato</div>
            <div id='utente'>
                <strong><?php echo $_SESSION["user"] ?></strong>
                <a id="profile_link" href="../profilo.php" title="Vai al profilo">
                    <img src="../../img/userPic2.png" alt="User profile icon">
                </a>
                <a id="logout" onclick="location.href='../requests/quit.php'"  href="#" title="Logout" >
                    <img src="../../img/logout.png" alt="Logout icon">
                </a>
            </div>

            <div id="img">
                <img src="../../img/giochi/impiccato/start.jpg" id="errore0" width="500" alt="">
            </div>

            <div id="words">
            
                <table id="alfabeto">
                    <tr>
                        <td id="a">a</td>
                        <td id="b">b</td>
                        <td id="c">c</td>
                        <td id="d">d</td>
                        <td id="e">e</td>
                        <td id="f">f</td>
                        <td id="g">g</td>
                    </tr>
                    <tr>
                        <td id="h">h</td>
                        <td id="i">i</td>
                        <td id="l">l</td>
                        <td id="m">m</td>
                        <td id="n">n</td>
                        <td id="o">o</td>
                        <td id="p">p</td>
                        
                    </tr>
                    <tr>
                        <td id="q">q</td>
                        <td id="r">r</td>
                        <td id="s">s</td>
                        <td id="t">t</td>
                        <td id="u">u</td>
                        <td id="v">v</td>
                        <td id="z">z</td>

                    </tr>
                </table>

                <p id="parola"></p>

                <div id="messaggio" hidden></div>

                <div id="startButton">
                    <input type="button" value="Inizia a giocare!" id="start">
                </div>

                <div id="playAgain" hidden>
                    <input type="button" value="Gioca ancora!" class="reset" id="again">
                </div>

                <div id="stopButton" hidden>
                    <input type="button" value="Arrenditi :(" class="reset" id="reset">
                </div>

                
            
            </div>
        </div>
    </div>
    <div id="homepage">
        <a href='../homepage.php'> <img height='30' src='../../img/backHome.png' alt='Return to Homepage'> </a><br>
        <em style="text-align: center;">Ritorna alla Home</em>
    </div>
</body>
</html>