<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$students = $db->prepare("SELECT * FROM students WHERE id = ?");
$students->execute(array($_REQUEST['id']));
$student = $students->fetch();

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
    <title>成績管理 - 生徒変更 - </title>
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
    <h1>生徒変更</h1>
    <a href="../exams/index.php">テスト結果一覧</a>
    <a href="../exams/result.php">学期別テスト結果一覧</a>
    <a href="../exams/create.php">テスト結果登録</a>
    <a href="../tests/index.php">テスト一覧</a>
    <a href="../tests/create.php">テスト登録</a>
    <a href="index.php">生徒一覧</a>
    <a href="create.php">生徒登録</a>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_COMPAT, 'UTF-8'); ?>">
        <p>学年</p>
        <select required name="year">
            <option type="hidden"><?php echo $student['class'] ?></option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
        <p>クラス</p>
        <input required type="number" min="1" max="10" name="class" value="<?php echo $student['class'] ?>">
        <p>学生番号</p>
        <input required type="number" min="1" max="10" name="number" value="<?php echo $student['number'] ?>">
        <p>氏名</p>
        <input required type="text" name="name" value="<?php echo $student['name'] ?>">

        <div>
            <input type="submit" class="btn btn-success" value="送信">
            <input type="reset" class="btn btn-danger" value="リセット">
        </div>
    </form>
    <form method="POST" action="destroy.php?id=<?php print($student['id']); ?>">
        <input type="submit" class="btn btn-danger" value="削除">
    </form>
    <a href="index.php">戻る</a>
</body>

</html>