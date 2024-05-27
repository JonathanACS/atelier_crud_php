<?php
    require_once("connect.php");

    const DBHOST = "db";
    const DBNAME = "atelier_crud";
    const DBUSER = "test";
    const DBPASS = "test";

    $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

    try {
        // essaie de connection 
        $db = new PDO($dsn, DBUSER, DBPASS);
        // echo "connexion réussi" . "<br>";
    } catch(PDOException $error) {
        //recupération message erreur
        echo "Echec de la connexion: " . $error->getMessage() . "<br>";
    }