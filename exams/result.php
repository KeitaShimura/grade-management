<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$tests = $db->query("SELECT DISTINCT name FROM tests");

$exams = $db->prepare("SELECT students.number as student_number, students.name as student_name, kokugo, sugaku, eigo, rika, shakai, goukei FROM exams INNER JOIN tests ON exams.test_id = tests.id INNER JOIN students ON exams.student_id = students.id WHERE tests.name = ?");
$exams->execute(array($_GET['test_name']));
$exams = $exams->fetchAll();


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
    <ul class="nav justify-content-center">
        <?php foreach ($tests as $test) { ?>
            <a href="result.php?test_name=<?php echo $test['name']; ?>"><?php echo $test['name']; ?></a>&ensp;
        <?php } ?>
    </ul>

    <table class="table" style="margin:30px auto; text-align: center; border-top: 1px solid lightgray; width:80%;">
        <thead style="height: 50px;">
            <tr>
                <th class="col-3" style="font-weight: bold;">学生番号</th>
                <th class="col-3" style="font-weight: bold;">名前</th>
                <th class="col-3" style="font-weight: bold;">国語</th>
                <th class="col-3" style="font-weight: bold;">数学</th>
                <th class="col-3" style="font-weight: bold;">英語</th>
                <th class="col-3" style="font-weight: bold;">理科</th>
                <th class="col-3" style="font-weight: bold;">社会</th>
                <th class="col-3" style="font-weight: bold;">合計</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exams as $exam) : ?>
                <tr>
                    <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['student_number']); ?></td>
                    <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['student_name']); ?></td>
                    <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['sugaku']); ?></td>
                    <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['kokugo']); ?></td>
                    <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['eigo']); ?></td>
                    <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['rika']); ?></td>
                    <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['shakai']); ?></td>
                    <td class="col-3" style="text-align: left; vertical-align: middle;"><?php print($exam['goukei']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</body>

</html>