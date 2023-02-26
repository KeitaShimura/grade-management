<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$exams = $db->query("SELECT exams.id, tests.name AS test_name, students.name AS student_name, exams.kokugo, exams.sugaku, exams.eigo, exams.rika, exams.shakai, exams.goukei FROM exams INNER JOIN students ON exams.student_id = students.id INNER JOIN tests ON exams.test_id = tests.id");

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
    <h1>テスト一覧画面</h1>
    <form action="download.php" method="post">
        <button name="csvoutput" type="submit">CSV ダウンロード</button>
    </form>
    <?php if (isset($_SESSION['status'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['status'];
            unset($_SESSION['status']); ?>
        </div>

    <?php endif; ?>
    <article>
        <?php if ($exams) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>テスト</th>
                        <th>名前</th>
                        <th>国語</th>
                        <th>数学</th>
                        <th>英語</th>
                        <th>理科</th>
                        <th>社会</th>
                        <th>合計</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($exams as $exam) : ?>
                        <tr>
                            <td><?php echo $exam['id']; ?></td>
                            <td><?php echo $exam['test_name']; ?></td>
                            <td><?php echo $exam['student_name']; ?></td>
                            <td><?php echo $exam['kokugo']; ?></td>
                            <td><?php echo $exam['sugaku']; ?></td>
                            <td><?php echo $exam['eigo']; ?></td>
                            <td><?php echo $exam['rika']; ?></td>
                            <td><?php echo $exam['shakai']; ?></td>
                            <td><?php echo $exam['goukei']; ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>
        <?php else : ?>
            <h3 class="fs-3" style="text-align: center; margin: 50px 0 0 0;">テストは登録されていません</h3>
        <?php endif; ?>
    </article>
</body>

</html>