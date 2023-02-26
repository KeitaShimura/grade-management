<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$students = $db->query('SELECT * FROM students');

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
    <article>
        <?php if ($students) : ?>
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
        <?php else : ?>
            <p>テストはありません</p>
        <?php endif; ?>
    </article>
</body>

</html>