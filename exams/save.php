<?php
require_once(__DIR__ .'../func/db_connect.php');

session_start();

$token = filter_input(INPUT_POST, 'token');
if (empty($_SESSION['token']) || $token !== $_SESSION['token']) {
    die('投稿失敗');
} else {
    unset($_SESSION['status']);

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

    $_SESSION['status'] = "テスト結果を登録しました。";
    return header("Location: index.php");
}
