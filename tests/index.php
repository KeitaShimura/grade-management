<?php
require_once(__DIR__ .'../func/db_connect.php');

$tests = $db->query('SELECT * FROM tests');

session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>成績管理 - テスト一覧 - </title>
</head>

<body>
    <h1>テスト一覧</h1>
    <?php if (isset($_SESSION['status'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['status'];
            unset($_SESSION['status']); ?>
        </div>
    <?php endif; ?>

    <a href="../exams/index.php">テスト結果一覧</a>
    <a href="../exams/result.php">学期別テスト結果一覧</a>
    <a href="../exams/create.php">テスト結果登録</a>
    <a href="index.php">テスト一覧</a>
    <a href="create.php">テスト登録</a>
    <a href="../students/index.php">生徒一覧</a>
    <a href="../students/create.php">生徒登録</a>

    <article>
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
    </article>
</body>

</html>