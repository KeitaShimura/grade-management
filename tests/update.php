<?php
require_once(__DIR__ . "/../index.php");

$test = $db->prepare("UPDATE tests SET year = :year, name = :name, updated_at=NOW() WHERE id = :id");
$test->bindParam(":year", $_POST['year']);
$test->bindParam(":name", $_POST['name']);
$test->bindParam(":id", $_POST['id']);

$test->execute();
$test->fetch();

return header("Location: index.php");

?>
