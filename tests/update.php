<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$test = $db->prepare("UPDATE tests SET year = :year, name = :name, updated_at=NOW() WHERE id = :id");
$test->bindParam(":year", $_POST['year']);
$test->bindParam(":name", $_POST['name']);
$test->bindParam(":id", $_POST['id']);

$test->execute();
$test->fetch();

return header("Location: index.php");

?>
