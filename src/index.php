<?php

session_start();
//PHP connect

    require_once("connect.php");

    $sql = "SELECT * FROM users";

        //on prépare le requête 
    $query = $db->prepare($sql);
        //execution de la requete
    $query->execute();
        //recupération des données sous forme de tableau associatif
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($users);
    // echo "</pre>";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier CRUD PHP</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <?php 
        if(!empty($_SESSION["message"])){
            echo "<p>" . $_SESSION["message"] . "</p>";
            $_SESSION["message"] = "";
        }
    ?>
    <table>
        <thead>
            <td>ID</td>
            <td>Prénom</td>
            <td>Nom</td>
            <td>Actions</td>
        </thead>
        <tbody>
            <?php 
            // pour chaque utilisateur récupéré dans $users, on affiche une nouvelle ligne dans la table HTML
                foreach($users as $user){
                    //chaque utilisateur récupéré sera identifier en tant que $user dans le foreach
                ?>
                 <tr> 
                    <td><?=$user["id"]?></td>
                    <td><?=$user["first_name"]?></td>
                    <td><?=$user["last_name"]?></td>
                    <td>
                        <a href="user.php?id=<?=$user["id"]?>">Voir</a>
                        <a href="update.php?id=<?=$user["id"]?>">Mettre à jour</a>
                        <a href="delete.php?id=<?=$user["id"]?>">Supprimer</a>
                    </td>
                 </tr>
                <?php
                }
            ?>

            <a href="form.php">Ajoutez un utilisateur</a>
        </tbody>
    </table>
</body>
</html>