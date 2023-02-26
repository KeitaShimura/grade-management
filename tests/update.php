<?php
require_once(__DIR__ . "/../index.php");

$statement = $this->PDO->prepare("UPDATE tests SET year = :year, name = :name, updated_at=NOW() WHERE id = :id");
$statement->bindParam(":year", $_GET['year']);
$statement->bindParam(":name", $_GET['name']);
$statement->bindParam(":id", $_GET['id']);

if ($statement->execute()) {
    return $statement->fetch();
} else {
    return false;
}
?>
