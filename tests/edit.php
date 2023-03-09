<?php
require_once(__DIR__ . '/../components/header.php');

$tests = $db->prepare("SELECT * FROM tests WHERE id = ?");
$tests->execute(array($_REQUEST['id']));
$test = $tests->fetch();


$token = bin2hex(openssl_random_pseudo_bytes(24));
$_SESSION['token'] = $token;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>成績管理 - テスト変更 - </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <h1>テスト変更</h1>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php print($test['id']); ?>">
        <input required type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_COMPAT, 'UTF-8'); ?>">
        <select required name="year">
            <option type="hidden"><?php echo $test['year'] ?></option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
        <select required name="name">
            <option type="hidden"><?php echo $test['name'] ?></option>
            <option>前期中間テスト</option>
            <option>前期期末テスト</option>
            <option>後期中間テスト</option>
            <option>後期期末テスト</option>
        </select>
        <div>
            <input type="submit" class="btn btn-success" value="送信">
            <input type="reset" class="btn btn-danger" value="リセット">
        </div>
    </form>
    <form method="POST" action="destroy.php?id=<?php print($test['id']); ?>">
        <input type="submit" class="btn btn-danger" value="削除">
    </form>
    <a href="index.php">戻る</a>
</body>

</html>