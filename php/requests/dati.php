<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    require "../utility/dbparams.php";
    try{
        if(empty($_SESSION["user"]))
                throw new Exception("Errore nella richiesta", 0);
        $pdo = new PDO(connection, user, pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $username = $_SESSION["user"];
        $sql =" SELECT Username, Email FROM users WHERE Username = :username";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->execute();
        
        $dati = $statement->fetchAll();

        $sql =" SELECT Data, Gioco, Esito FROM games WHERE Username = :username ORDER BY Data DESC";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $games = $statement->fetchAll();

        $esito = [
          "ok" => true,
          "user" => $dati[0][0],  
          "email" => $dati[0][1],
          "partite" => $games,
        ];

    }
    catch (Exception $e){
        $esito = [
            "ok" => false,
            "error" => $e->getCode(),
            "msg"=> $e->getMessage()
        ];
    }
    finally{
        echo json_encode($esito);
        $pdo = null;
    }
?>