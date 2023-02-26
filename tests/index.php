<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$tests = $db->query('SELECT * FROM tests');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if (isset($_SESSION['status'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['status'];
            unset($_SESSION['status']); ?>
        </div>

    <?php endif; ?>

    <a href="../exams/index.php">テスト結果一覧</a>
    <a href="../exams/result.php">成績一覧</a>
    <a href="../exams/create.php">テスト結果作成</a>
    <a href="index.php">テスト一覧</a>
    <a href="create.php">テスト結果</a>
    <a href="../students/index.php">生徒一覧</a>
    <a href="../students/create.php">生徒結果</a>
    <article>
        <?php if ($tests) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>学年</th>
                        <th>テスト名</th>
                        <th>編集</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($test = $tests->fetch()) : ?>

                        <tr id="tr<?php echo ($test['id']); ?>">
                            <td><?php echo ($test['id']) ?></td>
                            <td><?php echo ($test['year']); ?></td>
                            <td><?php echo ($test['name']); ?></td>
                            <td><a href="edit.php?id=<?php print($test['id']); ?>" class="btn btn-primary">変更</a></td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>テストはありません</p>
        <?php endif; ?>
    </article>
</body>

</html>