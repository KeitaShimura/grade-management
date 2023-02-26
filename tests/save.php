<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$test = $db->prepare("INSERT INTO tests (year, name, created_at, updated_at) VALUES(:year, :name, NOW(), NOW())");
$test->bindParam(":year", $_POST['year']);
$test->bindParam(":name", $_POST['name']);
$test->execute();

return header("Location: index.php");
