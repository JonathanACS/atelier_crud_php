<?php
//on vérifie que qu'il y'a bien une id dans l'url et que l'utilisateur correspendant existe
if(isset($_GET["id"]) && !empty($_GET["id"])){

require_once("connect.php");

    // echo $_GET["id"];
    //Enlever obligatoirement le "echo $_GET["id"];" sinon cela crée un bug

    //on accroche la valeur id de la requette a celle de la variable $id
    $id = strip_tags($_GET["id"]);

    //preparation de la requete sql
    $sql = "SELECT * FROM users WHERE id = :id";

    //demande la requete/envoie
    $query = $db->prepare($sql);

    //on accroche la valeur id de la requette à celle de la variable $id
    $query->bindValue(":id", $id, PDO::PARAM_INT);

    //lancement de la fonction
    $query->execute();

    $user = $query->fetch();
    
    //On utilise " !$user " verifie si l'utilisateur existe
    if(!$user) {
        header("Location: index.php");

    }else{
        //on gère la suppréssion de l'utilisateur
        $sql = "DELETE FROM users WHERE id = :id";

        $query = $db->prepare($sql);

        //on accroche la valeur id de la requette à celle de la variable $id
        $query->bindValue(":id", $id, PDO::PARAM_INT);

        //lancement de la fonction
        $query->execute();
        header("Location: index.php");
    }

    // print_r($user);
    } else {
        header("Location: index.php");
    }
?>