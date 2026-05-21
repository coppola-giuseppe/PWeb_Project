<?php
if (session_status() == PHP_SESSION_NONE)
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
    <meta name="viewport" content="width=device-width, initial-scale=1.00">
    <link rel="icon" href="../img/playHub_logo.png"  type="image/png">
    <link rel="stylesheet" href="../css/background.css">
    <link rel="stylesheet" href="../css/homepage.css">
    <title>Homepage</title>
</head>
<body>

<div id='container'>
    <div id="nav">
        <img src="../img/playHub_croppedLogo.png" id="imgLogo" alt="" height="100">
        <div id='utente'>
            <div id="nomeutente"><strong><?php echo $_SESSION["user"] ?></strong></div>
            
            <div id="profile_link"><a title="Vai al profilo" href="./profilo.php"><img width="35" src="../img/userPic2.png" alt="User profile icon"></a></div>
            
            <div id="logout"><a  title="Logout" onclick="location.href='./requests/quit.php'"  href="#" >
                <img width="35" src="../img/logout.png" alt="Logout icon">
            </a></div>
        </div>
    </div>

    <div id="raccolta">

        <div class="games" id="impiccato">
            <img src="../img/giochi/impiccato/impiccato.png" alt="impiccatoIMG">
            <a href="../php/giochi/impiccato.php"><p class="descrizione"> Impiccato</p></a>
        </div>

        <div class="games" id="memory">
            <img src="../img/giochi/tictactoe/tictactoe.png" alt="TicTacToeIMG">
            <a href="../php/giochi/tictactoe.php"><p class="descrizione"> Tic Tac Toe</p></a>
        </div>

        <div class="games" id="sassoCarta">
            <img src="../img/giochi/sasso%20carta%20forbici/sassoCartaForbici.png" alt="SassoCartaForbiciIMG">
            <a href="../php/giochi/sassoCartaForbici.php"><p class="descrizione"> Sasso Carta Forbici</p></a>
        </div>
   
    </div>
</div>


    
</body>
</html>