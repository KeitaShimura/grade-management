<?php
require_once(__DIR__ . "/../index.php");
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

        <?php if (isset($_SESSION['status'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['status'];
                unset($_SESSION['status']); ?>
            </div>

        <?php endif; ?>
        <div>
            <div class="mb-3">
                <input type="number" min="1" max="10" name="year" placeholder="学年">
            </div>
            <div class="mb-3">
                <select name="name">
                    <option hidden>テストを選択</option>
                    <option>前期中間テスト</option>
                    <option>前期期末テスト</option>
                    <option>後期中間テスト</option>
                    <option>後期期末テスト</option>
                </select>
            </div>
            <div>
                <input type="submit" class="btn btn-success" value="送信">
                <input type="reset" class="btn btn-danger" value="リセット">
            </div>
    </form>
</body>

</html>