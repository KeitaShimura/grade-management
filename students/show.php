<?php

require_once(__DIR__ . '/../func/db_connect.php');
$title = 'トップページ';
$error = null;
if (!empty($_GET)) {
    if ($_GET['id'] == '') {
        $error['id'] = 'blank';
    }

    if (empty($error)) {
        $student = $db->prepare('SELECT * FROM students WHERE id=?');
        $student->execute(array($_GET['id']));
        $student = $student->fetch();

        $exams = $db->prepare('SELECT E.*,T.name as t_name,S.name as s_name,S.number as s_number,S.id as s_id FROM exams AS E INNER JOIN tests as T ON E.test_id=T.id INNER JOIN students as S ON E.student_id=S.id WHERE student_id=? ORDER BY E.id ASC ');
        $exams->execute(array($_GET['id']));
        $exams = $exams->fetchAll();
    } else {
        header('Location:index.php');
        exit();
    }
}
?>

<h1><?php echo htmlspecialchars($student['name']); ?>の成績</h1>

<a href="index.php">生徒一覧に戻る</a>

<table>
    <tr>
        <th>ID</th>
        <th>テスト名</th>
        <th>学生番号</th>
        <th>名前</th>
        <th><a href="index.php?sort_key=kokugo&test_id=<?php echo htmlspecialchars($test_id); ?>">国語</a></th>
        <th><a href="index.php?sort_key=sugaku&test_id=<?php echo htmlspecialchars($test_id); ?>">数学</a></th>
        <th><a href="index.php?sort_key=eigo&test_id=<?php echo htmlspecialchars($test_id); ?>">英語</a></th>
        <th><a href="index.php?sort_key=rika&test_id=<?php echo htmlspecialchars($test_id); ?>">理科</a></th>
        <th><a href="index.php?sort_key=shakai&test_id=<?php echo htmlspecialchars($test_id); ?>">社会</a></th>
        <th><a href="index.php?sort_key=total&test_id=<?php echo htmlspecialchars($test_id); ?>">合計</a></th>
        <th>変更</th>
        <th>削除</th>
    </tr>
    <?php foreach ($exams as $exam) { ?>
        <tr>
            <td><?php echo htmlspecialchars($exam['id']); ?></td>
            <td><?php echo htmlspecialchars($exam['t_name']); ?></td>
            <td><?php echo htmlspecialchars($exam['s_number']); ?></td>
            <td><?php echo htmlspecialchars($exam['s_name']); ?></td>
            <td><?php echo htmlspecialchars($exam['kokugo']); ?></td>
            <td><?php echo htmlspecialchars($exam['sugaku']); ?></td>
            <td><?php echo htmlspecialchars($exam['eigo']); ?></td>
            <td><?php echo htmlspecialchars($exam['rika']); ?></td>
            <td><?php echo htmlspecialchars($exam['shakai']); ?></td>
            <td><?php echo htmlspecialchars($exam['goukei']); ?></td>
            <td><a href="edit.php?id=<?php echo htmlspecialchars($exam['id']); ?>">変更</td>
            <td><a href="delete.php?id=<?php echo htmlspecialchars($exam['id']); ?>">削除</td>
        </tr>
    <?php } ?>
</table>
</body>
</body>



</body>

</html>