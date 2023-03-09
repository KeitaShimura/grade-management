<?php
require_once(__DIR__ .'/../func/db_connect.php');

session_start();

$token = filter_input(INPUT_POST, 'token');

if (empty($_SESSION['token']) || $token !== $_SESSION['token']) {
    die('投稿失敗');
} else {
    unset($_SESSION['status']);

    $student = $db->prepare("INSERT INTO students (year, class, number, name, created_at, updated_at) VALUES(:year, :class, :number, :name, NOW(), NOW())");
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES);
    $student->bindParam(":year", $_POST['year']);
    $student->bindParam(":class", $_POST['class']);
    $student->bindParam(":number", $_POST['number']);
    $student->bindParam(":name", $name);
    $student->execute();

    $_SESSION['status'] = "テストを登録しました。";
    return header("Location: index.php");
}
