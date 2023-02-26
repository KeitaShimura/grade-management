<?php
require_once(__DIR__ . "/../index.php");

$statement = $db->prepare("INSERT INTO tests (year, name, created_at, updated_at) VALUES(:year, :name, NOW(), NOW())");
$statement->bindParam(":year", $_POST['year']);
$statement->bindParam(":name", $_POST['name']);
$statement->execute();

$_SESSION['status'] = "テスト結果を登録しました。";
return header("Location: index.gitphp");
