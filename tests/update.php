<?php
require_once(__DIR__ . "/../index.php");

$statement = $db->prepare("UPDATE tests SET year = :year, name = :name, updated_at=NOW() WHERE id = :id");
$statement->bindParam(":year", $_POST['year']);
$statement->bindParam(":name", $_POST['name']);
$statement->bindParam(":id", $_POST['id']);

$statement->execute();
$statement->fetch();


?>
