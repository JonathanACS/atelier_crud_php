<?php
// require_once("connect.php");

if($_POST) {
    
    if(isset($_POST["id"]) && !empty($_POST["id"])
    && isset($_POST["first_name"]) && !empty($_POST["first_name"])
    && isset($_POST["last_name"]) && !empty($_POST["last_name"])
    ){
        require_once("connect.php");

        $id = strip_tags($_POST["id"]);

        $first_name = strip_tags($_POST["first_name"]);
        $last_name = strip_tags($_POST["last_name"]);

        $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $query->bindValue(":last_name", $last_name, PDO::PARAM_STR);

        $query->execute();
        header("Location: index.php");
    }else{
        echo "Remplissez le formulaire";
    }
}

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
    <title>Modifier <?= $user["first_name"] . " " . $user["last_name"]?></title>
</head>
<body>

    <h1>Modifier <?= $user["first_name"] . " " . $user["last_name"]?></h1>

    <form method="post">

        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" value="<?= $user["first_name"] ?>" required>

        <label for="last_name">Nom</label>
        <input type="text" name="last_name" value="<?= $user["last_name"] ?>" required>
        <input type="hidden" name="id" value="<?= $user["id"] ?>" required>

        <button>Modifier</button>
    </form>
    <a href="index.php">Retour</a>
    <!-- <?php print_r($_POST);?> -->
</body>
</html>