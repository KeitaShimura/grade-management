<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$test = $db->prepare("DELETE FROM students WHERE id = :id");
$test->bindParam(":id", $_GET['id']);

$test->execute();

return header("Location: index.php");
