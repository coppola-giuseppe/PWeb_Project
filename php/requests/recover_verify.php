<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    include "../utility/dbparams.php";
    try{
        if($_SERVER["REQUEST_METHOD"] != "POST")
            throw new Exception("Metodo di richiesta errato", 0);
        if(empty($_POST["action"]))
            throw new Exception("Tipo di richiesta non specificata.", 1);

        switch ($_POST["action"]) {

            case 'checkCredentials': // Guardo se la coppia username/email è presente e ritorno l'esito
                
                if(empty($_POST["username"]) || empty($_POST["email"]))
                    throw new Exception("Completa tutti i campi.", 2);
                if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                    throw new Exception("Inserisci un'email valida.", 3);

                $user = $_POST["username"];
                $email = $_POST["email"];
                $pdo = new PDO(connection, user, pass);
                $sql = "SELECT Domanda FROM users WHERE Username = :username AND Email = :email";
                $statement = $pdo->prepare($sql);
                $statement->bindParam(":username", $user);
                $statement->bindParam(":email", $email);
                $statement->execute();
                if($domanda = $statement->fetch()){
                    $_SESSION["temporaryUser"] = $_POST["username"];
                    $esito = [
                        "ok" => true,
                        "domanda" => $domanda["Domanda"],
                    ];
                }
                else{
                    session_unset();
                    session_destroy();
                    throw new Exception("Username e/o email errati.", 4);
                }
                break;
            
            case 'verifyAnswer': // Verifico se la risposta data dall'utente corrisponde con la risposta salvata nel database
                if(empty($_SESSION["temporaryUser"]))
                    throw new Exception("Sessione scaduta.", 5);
                $user = $_SESSION["temporaryUser"];
                if(empty($_POST["risposta"]))
                    throw new Exception("La risposta non può essere nulla.", 6);
                $risposta = $_POST["risposta"];
                $pdo = new PDO(connection, user, pass);
                $sql = "SELECT COUNT(*) FROM users WHERE Username = :username AND Risposta = :risposta";
                $statement = $pdo->prepare($sql);
                $statement->bindParam(":username", $user);
                $statement->bindParam(":risposta", $risposta);
                $statement->execute();
                $count = $statement->fetchColumn();

                if($count == 1){
                    $_SESSION["risposta"] = true;
                    $esito =[
                        "ok" => true,
                    ];
                }
                else
                    throw new Exception("Risposta errata.", 7);
                break;
            case 'updatePass': // Aggiorno la password dell'utente
                if(empty($_SESSION["temporaryUser"]))
                    throw new Exception("Sessione scaduta.", 5);
                $user = $_SESSION["temporaryUser"];

                if(empty($_POST["pass"]) || empty($_POST["passConf"]) )
                    throw new Exception("La password non può essere vuota.", 8);

                if($_POST["pass"] !== $_POST["passConf"])
                    throw new Exception("Le password non corrispondono.",9);

                $pass = $_POST["pass"];
                $uppercase = preg_match('{[A-Z]+}', $pass);
                $lowercase = preg_match('{[a-z]+}', $pass);
                $number    = preg_match('{[0-9]+}', $pass);  
                $lenght    = preg_match('{\S{8,}}', $pass);
                $special   = preg_match('{\W}', $pass);
                $space   =  !preg_match('{\s+}', $pass);
                if(!$uppercase || !$lowercase || !$number || !$lenght || !$special || !$space)
                    throw new Exception("Password nel formato sbagliato.", 10);

                $pdo = new PDO(connection, user, pass);
                $sql = "UPDATE users SET Password = :password WHERE Username = :username";
                $statement = $pdo->prepare($sql);
                $password = password_hash($pass, PASSWORD_BCRYPT);
                $statement->bindParam(":username", $user);
                $statement->bindParam(":password", $password);
                $statement->execute();

                $esito = [
                    "ok" => true,
                    "updateMsg" => "Password aggiornata con successo."
                ];
            }
    }
    catch(Exception $e){
        $esito = [
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