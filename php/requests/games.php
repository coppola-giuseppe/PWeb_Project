<?php
    require "../utility/dbparams.php";
    try{
        if(empty($_POST["utente"]) || empty($_POST["gioco"]) || empty($_POST["result"]))
                throw new Exception("Errore nella richiesta", 0);
        
        $username = $_POST["utente"];
        $gioco = $_POST["gioco"];
        $esito = $_POST["result"];
        $pdo = new PDO(connection, user, pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(*) FROM games WHERE Username = :username";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $count = $statement->fetchColumn();
        //se <10 inserisco e basta, se =10 rimuovo la partita più vecchia e poi inserisco
        if($count < 10){
            $sql = "INSERT INTO games VALUES (:username, CURRENT_TIMESTAMP, :gioco, :esito); ";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(":username", $username);
            $statement->bindParam(":gioco", $gioco);
            $statement->bindParam(":esito", $esito);
            $statement->execute();

            $esito = [
                "ok" => true,
                "msg" => "Tabella aggiornata."
            ];

        }
        else{
            $sql = "DELETE FROM games 
                    WHERE Username = :username
                    AND Data = (
                        SELECT Data
                        FROM (SELECT * FROM games) as t
                        WHERE Username = :username
                        ORDER BY Data
                        LIMIT 1
                        );";

            $statement = $pdo->prepare($sql);
            $statement->bindParam(":username", $username);
            $statement->execute();
            
            $sql = "INSERT INTO games VALUES (:username, CURRENT_TIMESTAMP, :gioco, :esito); ";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(":username", $username);
            $statement->bindParam(":gioco", $gioco);
            $statement->bindParam(":esito", $esito);
            $statement->execute();

            $esito = [
                "ok" => true,
                "msg" => "Tabella aggiornata."
            ];
        }

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