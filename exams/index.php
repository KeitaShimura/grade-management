<?php
require_once(__DIR__ . "/../index.php");

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
                            <td><?php echo ($test['year']); ?></td>
                            <td><?php echo ($test['name']); ?></td>
                            <td id="delete_button"><a href="edit.php?id=<?php print($test['id']); ?>">削除</a></td>
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