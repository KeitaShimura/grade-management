<?php
require_once(__DIR__ . "/../index.php");

$test = $db->prepare("DELETE FROM tests WHERE id = :id");
$test->bindParam(":id", $_GET['id']);

$test->execute();

return header("Location: index.php");
