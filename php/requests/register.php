<?php
    require "../utility/dbparams.php";
    try{
        
        if(empty($_POST["user"]) || empty($_POST["pass"]) || empty($_POST["email"]) ||
            empty($_POST["passConf"]) || empty($_POST["domanda"]) || empty($_POST["risposta"]))
                throw new Exception("Inserire tutti i campi richiesti.", 0);

        $username = $_POST["user"];
        if(strlen($username) > 24){
            throw new Exception("Il nome utente non può superare i 24 caratteri", 6);
        }
        $pass = $_POST["pass"];
        $uppercase = preg_match('{[A-Z]+}', $pass);
        $lowercase = preg_match('{[a-z]+}', $pass);
        $number    = preg_match('{[0-9]+}', $pass);  
        $lenght    = preg_match('{\S{8,}}', $pass);
        $special   = preg_match('{\W}', $pass);
        $space   =  !preg_match('{\s+}', $pass);
        if(!$uppercase || !$lowercase || !$number || !$lenght || !$special || !$space)
            throw new Exception("Password nel formato sbagliato", 1);

        if($_POST["pass"] !== $_POST["passConf"])
        throw new Exception("Le password non corrispondono",2);
        
        $pdo = new PDO (connection, user, pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $password = password_hash($_POST["pass"], PASSWORD_BCRYPT);

        $dom = ["","Nome del tuo primo animale domestico?",
                "Qual è la tua squadra preferita?", "Soprannome da bambino?","Qual è la tua città natale?",
                "Nome del tuo migliore amico?", "Titolo del tuo libro preferito?"];
        $domanda = $dom[$_POST["domanda"]];
        $risposta = $_POST["risposta"];

        $sql = "SELECT COUNT(*) FROM users WHERE Username = :username";
        
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->execute();
        $count = $statement->fetchColumn();
        
        if($count != 0)
            throw new Exception("Username inserito già presente",3);

        $email = $_POST["email"];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new Exception("L'email inserita non è valida", 4);

        $sql = "SELECT COUNT(*) FROM users WHERE Email = :email";
        
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":email", $email);
        $statement->execute();
        $count = $statement->fetchColumn();

        if($count != 0)
            throw new Exception("L'email inserita risulta già presente.",5);

        $sql = "INSERT INTO users VALUES (:username, :password, :domanda, :risposta, :email);";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":domanda", $domanda);
        $statement->bindParam(":risposta", $risposta);
        $statement->bindParam(":email", $email);
        $statement->execute();

        $esito = [
            "ok" => true,
            "msg" => "Registrazione avvenuta con successo!"
        ];
    
    }
    catch(Exception $e){
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