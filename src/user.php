<?php

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
    //déconnexion
    require_once("disconnect.php");

    }

    // print_r($user);
    } else {
    header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>utilisateur <?= $user["first_name"] . " " . $user["last_name"]?></title>
</head>
<body>
    <h1>Page de <?= $user["first_name"] . " " . $user["last_name"]?></h1>


    <a href="index.php">retour</a>
</body>
</html>