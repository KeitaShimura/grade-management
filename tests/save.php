<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

session_start();

$error = [];

if ($_POST['year'] === "学年を選択") {
    $error[] = "学年を選択してください。";
}

if ($_POST['name'] === "テストを選択") {
    $error[] = "テストを選択してください。";
}

if (count($error) > 0) {
    $_SESSION['status'] = $error;
    return header("Location: create.php", true, 307);
} else {
    unset($_SESSION['status']);

    $test = $db->prepare("INSERT INTO tests (year, name, created_at, updated_at) VALUES(:year, :name, NOW(), NOW())");
    $test->bindParam(":year", $_POST['year']);
    $test->bindParam(":name", $_POST['name']);
    $test->execute();

    $_SESSION['status'] = "テストを登録しました。";
    return header("Location: index.php");
}
