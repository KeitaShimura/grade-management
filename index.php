<?php
require_once(__DIR__ .'/func/db_connect.php');
require_once(__DIR__ . '/components/header.php');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>成績管理 - トップ - </title>
</head>

<body>
    <a href="exams/index.php">テスト結果一覧</a>
    <a href="exams/result.php">学期別テスト結果一覧</a>
    <a href="exams/create.php">テスト結果登録</a>
    <a href="tests/index.php">テスト一覧</a>
    <a href="tests/create.php">テスト登録</a>
    <a href="students/index.php">生徒一覧</a>
    <a href="students/create.php">生徒登録</a>
</body>

</html>