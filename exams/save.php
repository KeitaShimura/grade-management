<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}


$exam = $db->prepare("INSERT INTO exams (test_id, student_id, kokugo, sugaku, eigo, rika, shakai, goukei, created_at, updated_at) VALUES(:test_id, :student_id, :kokugo, :sugaku, :eigo, :rika, :shakai, :goukei, NOW(), NOW())");
$exam->bindParam(":test_id", $_POST['test_id']);
$exam->bindParam(":student_id", $_POST['student_id']);
$exam->bindParam(":kokugo", $_POST['kokugo']);
$exam->bindParam(":sugaku", $_POST['sugaku']);
$exam->bindParam(":eigo", $_POST['eigo']);
$exam->bindParam(":rika", $_POST['rika']);
$exam->bindParam(":shakai", $_POST['shakai']);
$exam->bindParam(":goukei", $_POST['goukei']);

$exam->execute();

return header("Location: index.php");
