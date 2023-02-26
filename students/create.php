<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

session_start();

$token = bin2hex(openssl_random_pseudo_bytes(24));
$_SESSION['token'] = $token;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>テスト登録画面</h1>
    <form method="POST" action="save.php">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_COMPAT, 'UTF-8'); ?>">
        <input type="number" min="1" max="10" name="year" placeholder="学年">
        <input type="number" min="1" max="10" name="class" placeholder="クラス">
        <input type="number" min="1" max="10" name="number" placeholder="学年">
        <input type="text" name="name" placeholder="名前">
        <div>
            <input type="submit" class="btn btn-success" value="送信">
            <input type="reset" class="btn btn-danger" value="リセット">
        </div>
    </form>
</body>

</html>