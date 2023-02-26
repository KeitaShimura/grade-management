<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$student = $db->prepare("INSERT INTO students (year, class, number, name, created_at, updated_at) VALUES(:year, :class, :number, :name, NOW(), NOW())");
$student->bindParam(":year", $_POST['year']);
$student->bindParam(":class", $_POST['class']);
$student->bindParam(":number", $_POST['number']);
$student->bindParam(":name", $_POST['name']);
$student->execute();

return header("Location: index.php");
