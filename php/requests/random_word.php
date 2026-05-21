<?php
    require "../utility/dbparams.php";

    try{
        if($_SERVER["REQUEST_METHOD"] != "POST")
            throw new Exception("Metodo di richiesta errato", 0);
        
        $pdo = new PDO(connection, user, pass);
        $idWord = rand(1, 467); //scelgo un numero a caso che corrisponde a una parola nel database
        $sql = "SELECT Parola FROM words WHERE Id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id", $idWord);
        $statement->execute();

        $word = $statement->fetchColumn();

        $esito=[
            "ok" => true,
            "parola" => $word,
            "id" => $idWord
        ];

    }
    catch (Exception $e) {
        $esito=[
            "ok" => false,
            "errorMsg" => $e->getMessage(),
            "errorCode" => $e->getCode()
        ];

    }
    finally{
        echo json_encode($esito);
        $pdo = null;
    }
?>