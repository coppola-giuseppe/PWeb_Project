<?php
    require "../utility/dbparams.php";
    try{
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(empty($_POST["user"]) || empty($_POST["pass"]))
            throw new Exception("Controlla di aver inserito tutti i dati!", 0);

        $username = $_POST["user"];
        $password = $_POST["pass"];
        $pdo = new PDO(connection, user, pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT Username, Password FROM users WHERE Username = :username";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $dati = $statement->fetch();
        
        if (!$dati)
            throw new Exception ("Username non presente", 1);
        else{
            if(password_verify($password, trim($dati["Password"]))){
                
                $_SESSION["user"] = $username;

                $esito = [
                    'esito' => 'Accesso avvenuto!',

                    'accesso' => true,
                    
                    'utente' => $username
                ];
            }
            else
                throw new Exception ("Password errata",1);
        }
    }
        catch(Exception $e){
            $esito = [
                'esito' => 'Accesso fallito! -> '. $e->getMessage(),

                'accesso' => false,
                
                'errore' => $e->getCode()
            ];
        }
        finally {
            echo json_encode($esito);
            $pdo = null;
        }
?>