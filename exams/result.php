<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

if (isset($_GET['test_name'])) {
    $exams = $db->prepare("SELECT students.number as student_number, students.name as student_name, kokugo, sugaku, eigo, rika, shakai, goukei FROM exams INNER JOIN tests ON exams.test_id = tests.id INNER JOIN students ON exams.student_id = students.id WHERE tests.name = ?");
    $exams->execute(array($_GET['test_name']));
    $exams = $exams->fetchAll();
}

$tests = $db->query("SELECT DISTINCT name FROM tests");


if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'student_number') {
        array_multisort(array_column($exams, 'student_number'), SORT_ASC, $exams);
    }

    if ($_GET['sort'] == 'kokugo') {
        array_multisort(array_column($exams, 'kokugo'), SORT_DESC, $exams);
    }

    if ($_GET['sort'] == 'sugaku') {
        array_multisort(array_column($exams, 'sugaku'), SORT_DESC, $exams);
    }

    if ($_GET['sort'] == 'eigo') {
        array_multisort(array_column($exams, 'eigo'), SORT_DESC, $exams);
    }

    if ($_GET['sort'] == 'rika') {
        array_multisort(array_column($exams, 'rika'), SORT_DESC, $exams);
    }

    if ($_GET['sort'] == 'shakai') {
        array_multisort(array_column($exams, 'shakai'), SORT_DESC, $exams);
    }

    if ($_GET['sort'] == 'goukei') {
        array_multisort(array_column($exams, 'goukei'), SORT_DESC, $exams);
    }
}

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
    <h1 class="fs-1" style="margin: 50px 0 0 40px;">テスト一覧画面</h1>
    <a href="index.php">テスト結果一覧</a>
    <a href="result.php">成績一覧</a>
    <a href="create.php">テスト結果作成</a>
    <a href="../tests/index.php">テスト一覧</a>
    <a href="../tests/create.php">テスト結果</a>
    <a href="../students/index.php">生徒一覧</a>
    <a href="../students/create.php">生徒結果</a>
    <ul class="nav justify-content-center">
        <?php foreach ($tests as $test) { ?>
            <a href="result.php?test_name=<?php echo $test['name']; ?>"><?php echo $test['name']; ?></a>&ensp;
        <?php } ?>
    </ul>

    <table class="table" style="margin:30px auto; text-align: center; border-top: 1px solid lightgray; width:80%;">
        <?php if (isset($_GET['test_name'])) { ?>

            <thead style="height: 50px;">
                <tr>
                    <th class="col-3" style="font-weight: bold;">学生番号<a href="result.php?sort=student_number&test_name=<?php echo $_GET['test_name']; ?>">▽</a></th>
                    <th class="col-3" style="font-weight: bold;">名前</th>
                    <th class="col-3" style="font-weight: bold;">国語<a href="result.php?sort=kokugo&test_name=<?php echo $_GET['test_name']; ?>">▽</a></th>
                    <th class="col-3" style="font-weight: bold;">数学<a href="result.php?sort=sugaku&test_name=<?php echo $_GET['test_name']; ?>">▽</a></th>
                    <th class="col-3" style="font-weight: bold;">英語<a href="result.php?sort=eigo&test_name=<?php echo $_GET['test_name']; ?>">▽</a></th>
                    <th class="col-3" style="font-weight: bold;">理科<a href="result.php?sort=rika&test_name=<?php echo $_GET['test_name']; ?>">▽</a></th>
                    <th class="col-3" style="font-weight: bold;">社会<a href="result.php?sort=shakai&test_name=<?php echo $_GET['test_name']; ?>">▽</a></th>
                    <th class="col-3" style="font-weight: bold;">合計<a href="result.php?sort=goukei&test_name=<?php echo $_GET['test_name']; ?>">▽</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exams as $exam) : ?>
                    <tr>
                        <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['student_number']); ?></td>
                        <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['student_name']); ?></td>
                        <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['kokugo']); ?></td>
                        <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['sugaku']); ?></td>
                        <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['eigo']); ?></td>
                        <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['rika']); ?></td>
                        <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['shakai']); ?></td>
                        <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['goukei']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php } else { ?>
            テストを選択してください。
        <?php } ?>

</body>

</html>