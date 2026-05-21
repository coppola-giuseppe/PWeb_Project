<?php
//Chiude la sessione e riporta l'utente alla pagina di login
session_start();
session_unset();
session_destroy();
header("Location: ../../index.php");
?>