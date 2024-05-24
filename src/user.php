<?php
    require_once("connect.php");

    echo $_GET["id"];
    //on accroche la valeur id de la requette a celle de la variable $id
    $id = strip_tags($_GET["id"]);
    //preparation de la requete sql
    $sql = "SELECT * FROM users WHERE id = :id";
    //demande la requete/envoie
    $query = $db->prepare($sql);

    $query->bindValue(":id", $id, PDO::PARAM_INT);

    $query->execute();

    $user = $query->fetch();
    // print_r($user);

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