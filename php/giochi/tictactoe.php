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
    <link rel="stylesheet" href="../../css/giochi/tictactoe.css">
    <script src="../../js/giochi/tictactoe.js"></script>
    <title>Tic Tac Toe</title>
</head>
<body>
    <div id="container1">
        <div id="container2">

            <div id="nav">
                <p id="title">Tic Tac Toe</p>
                <div id='user'>
                    <strong><?php echo $_SESSION["user"] ?></strong>
                    <a id="profile_link" href="../profilo.php" title="Vai al profilo">
                        <img src="../../img/userPic2.png" alt="User profile icon">
                    </a>
                    <a id="logout" onclick="location.href='../requests/quit.php'"  href="#" title="Logout">
                        <img src="../../img/logout.png" alt="Logout icon">
                    </a>
                </div>
            </div>

            
            <div id="scelta">

                <h2>Scegli con cosa giocare!</h2>
                <button class="sceltaPlayer" id="X">X</button>
                <button class="sceltaPlayer" id="O">O</button>

            </div>

            <div id="griglia" hidden>
                <div id="msg">
                    <p></p>
                    <p>Clicca su una casella per fare la tua mossa!</p>
                    <button id="reset">Riavvia</button>
                </div>

                <table>
                    <tr>
                        <td class="grid" id="g1"></td>
                        <td class="grid" id="g2"></td>
                        <td class="grid" id="g3"></td>
                    </tr>
                    <tr>
                        <td class="grid" id="g4"></td>
                        <td class="grid" id="g5"></td>
                        <td class="grid" id="g6"></td>
                    </tr>
                    <tr>
                        <td class="grid" id="g7"></td>
                        <td class="grid" id="g8"></td>
                        <td class="grid" id="g9"></td>
                    </tr>
                </table>
            </div>
            <div id="esito" hidden>
            </div>
        </div>
    </div>


    <div id="homepage">
        <a href='../homepage.php'> <img height='45' src='../../img/backHome.png' alt='Return to Homepage'> </a><br>
        <em style="text-align: center;">Ritorna alla Home</em>
    </div>
    
</body>
</html>