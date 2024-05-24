<?php

require_once("connect.php");

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];

$sql = "INSERT INTO users (first_name, last_name) VALUES (:first_name, :last_name)";

$query = $db->prepare($sql);
$query->bindValue(":first_name", $first_name);
$query->bindValue(":last_name", $last_name);

$query->execute();