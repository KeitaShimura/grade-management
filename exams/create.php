<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$tests = $db->query('SELECT * FROM tests');
$students = $db->query('SELECT * FROM students');

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
    <title>成績管理 - テスト結果作成 - </title>
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
    <h1>テスト結果登録</h1>
    <a href="index.php">テスト結果一覧</a>
    <a href="result.php">学期別テスト結果一覧</a>
    <a href="create.php">テスト結果登録</a>
    <a href="../tests/index.php">テスト一覧</a>
    <a href="../tests/create.php">テスト登録</a>
    <a href="../students/index.php">生徒一覧</a>
    <a href="../students/create.php">生徒登録</a>
    <form method="POST" action="save.php">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_COMPAT, 'UTF-8'); ?>">
        <p>テスト</p>
        <select required name="test_id">
            <option type="hidden"></option>
            <?php foreach ($tests as $test) : ?>
                <option value="<?php echo $test['id'] ?>"><?php echo $test['year']; ?>年 / <?php echo $test['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <p>生徒</p>
        <select required name="student_id">
            <option type="hidden"></option>
            <?php foreach ($students as $student) : ?>
                <option value="<?php echo $student['id'] ?>"><?php echo $student['year']; ?>年 / <?php echo $student['class']; ?>組 / <?php echo $student['number']; ?>番 / <?php echo $student['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="form" style="text-align: center;">
            <label>国語</label>
            <input required type="number" min="0" max="100" name="kokugo" id="kokugo">
            <label>数学</label>
            <input required type="number" min="0" max="100" name="sugaku" id="sugaku">
            <label>英語</label>
            <input required type="number" min="0" max="100" name="eigo" id="eigo">
            <label>理科</label>
            <input required type="number" min="0" max="100" name="rika" id="rika">
            <label>社会</label>
            <input required type="number" min="0" max="100" name="shakai" id="shakai">
            <label>合計</label>
            <input required readonly type="number" min="0" max="100" name="goukei" id="goukei">
            <div>
                <input type="submit" class="btn btn-success" value="送信">
                <input type="reset" class="btn btn-danger" value="リセット">
            </div>
        </div>
    </form>
    <a href="index.php">戻る</a>
</body>

<script type="text/javascript">
    let kokugo, sugaku, eigo, rika, shakai, goukei;

    function calculation() {
        let kokugo_value = Number(kokugo.value);
        let sugaku_value = Number(sugaku.value);
        let eigo_value = Number(eigo.value);
        let rika_value = Number(rika.value);
        let shakai_value = Number(shakai.value);

        let sum = kokugo_value + sugaku_value + eigo_value + rika_value + shakai_value;
        if (isNaN(sum)) sum = "計算できません";
        goukei.value = sum;
    }

    window.addEventListener("load", () => {
        kokugo = document.getElementById("kokugo");
        sugaku = document.getElementById("sugaku");
        eigo = document.getElementById("eigo");
        rika = document.getElementById("rika");
        shakai = document.getElementById("shakai");
        goukei = document.getElementById("goukei");

        kokugo.addEventListener("keyup", calculation, false);
        sugaku.addEventListener("keyup", calculation, false);
        eigo.addEventListener("keyup", calculation, false);
        rika.addEventListener("keyup", calculation, false);
        shakai.addEventListener("keyup", calculation, false);
    });
</script>

</html>