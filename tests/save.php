<?php
require_once(__DIR__ .'../func/db_connect.php');

session_start();

$token = filter_input(INPUT_POST, 'token');

if (empty($_SESSION['token']) || $token !== $_SESSION['token']) {
    die('投稿失敗');
} else {
    unset($_SESSION['status']);

    $test = $db->prepare("INSERT INTO tests (year, name, created_at, updated_at) VALUES(:year, :name, NOW(), NOW())");
    $test->bindParam(":year", $_POST['year']);
    $test->bindParam(":name", $_POST['name']);
    $test->execute();

    $_SESSION['status'] = "テストを登録しました。";
    return header("Location: index.php");
}
