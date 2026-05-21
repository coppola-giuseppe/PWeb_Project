<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();
    require "../utility/dbparams.php";
    try{
        if(empty($_SESSION["user"]) || empty($_POST["oldPass"]) ||empty($_POST["newPass1"]) || empty($_POST["newPass2"]) )
                throw new Exception("Completa tutti i campi.", 0);

        $oldPass = $_POST["oldPass"];
        $newPass = $_POST["newPass1"];
        $pdo = new PDO(connection, user, pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $username = $_SESSION["user"];
        $sql =" SELECT Password FROM users WHERE Username = :username";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->execute();

        $passAttuale = $statement->fetchColumn();
        if(!password_verify($oldPass, $passAttuale))
            throw new Exception("La password inserita non corrisponde a quella attuale.", 1);
        
        if($_POST["newPass1"] !== $_POST["newPass2"])
            throw new Exception("Le password non corrispondono.",3);

        $uppercase = preg_match('{[A-Z]+}', $newPass);
        $lowercase = preg_match('{[a-z]+}', $newPass);
        $number    = preg_match('{[0-9]+}', $newPass);  
        $lenght    = preg_match('{\S{8,}}', $newPass);
        $special   = preg_match('{\W}', $newPass);
        $space   =  !preg_match('{\s+}', $newPass);
        if(!$uppercase || !$lowercase || !$number || !$lenght || !$special || !$space)
            throw new Exception("La password è nel formato sbagliato.", 2);

        

        $newPassHash = password_hash($newPass, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET Password = :password WHERE Username = :username";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $newPassHash);
        $statement->execute();

        $esito = [
            "ok" => true
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