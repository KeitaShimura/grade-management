<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

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
