<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$students = $db->query('SELECT * FROM students');
session_start();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>成績管理 - 生徒一覧 - </title>
</head>

<body>
    <P>生徒一覧<p>
    <?php if (isset($_SESSION['status'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['status'];
            unset($_SESSION['status']); ?>
        </div>

    <?php endif; ?>
    <a href="../exams/index.php">テスト結果一覧</a>
    <a href="../exams/result.php">学期別テスト結果一覧</a>
    <a href="../exams/create.php">テスト結果登録</a>
    <a href="../tests/index.php">テスト一覧</a>
    <a href="../tests/create.php">テスト登録</a>
    <a href="index.php">生徒一覧</a>
    <a href="create.php">生徒登録</a>
    <article>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>学年</th>
                    <th>クラス</th>
                    <th>学生番号</th>
                    <th>氏名</th>
                    <th>編集</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) : ?>

                    <tr>
                        <td><?php echo ($student['id']); ?></td>
                        <td><?php echo ($student['year']); ?></td>
                        <td><?php echo ($student['class']) ?></td>
                        <td><?php echo ($student['number']) ?></td>
                        <td><?php echo ($student['name']); ?></td>
                        <td><a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-primary">変更</a></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</body>

</html>