<?php
require_once(__DIR__ .'../func/db_connect.php');

session_start();

$token = filter_input(INPUT_POST, 'token');

if (empty($_SESSION['token']) || $token !== $_SESSION['token']) {
    die('投稿失敗');
} else {
    $student = $db->prepare("UPDATE students SET year = :year, class = :class, number = :number, name = :name, updated_at=NOW() WHERE id = :id");
    $student->bindParam(":year", $_POST['year']);
    $student->bindParam(":class", $_POST['class']);
    $student->bindParam(":number", $_POST['number']);
    $student->bindParam(":name", $_POST['name']);
    $student->bindParam(":id", $_POST['id']);

    $student->execute();
    $student->fetch();

    $_SESSION['status'] = "テストを登録しました。";
    return header("Location: index.php");
}
