<?php
require_once(__DIR__ .'/../func/db_connect.php');
session_start();
require_once(__DIR__ . '/../auth/login_check.php');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php $realPath ="http://localhost/grade-management";?>

</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/grade-management/index.php">成績管理</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/grade-management/tests">テスト</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/grade-management/students">生徒</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/grade-management/exams">テスト結果</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" tabindex="-1"><?php echo $_SESSION['name'];?> /<?php echo $_SESSION['login_time'];?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/grade-management/auth/logout.php">ログアウト</a>
                    </li>
                 </ul>
            </div>
        </div>
    </nav>


</header>

