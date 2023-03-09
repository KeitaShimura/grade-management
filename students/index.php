<?php
require_once(__DIR__ . '/../components/header.php');


$students = $db->query('SELECT * FROM students');

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
    <P>生徒一覧
    <p>
        <?php if (isset($_SESSION['status'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['status'];
            unset($_SESSION['status']); ?>
    </div>

<?php endif; ?>
<article>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>学年</th>
                <th>クラス</th>
                <th>学生番号</th>
                <th>氏名</th>
                <th>結果</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student) : ?>

                <tr id="tr<?php echo ($student['id']); ?>">
                    <td><?php echo ($student['id']); ?></td>
                    <td><?php echo ($student['year']); ?></td>
                    <td><?php echo ($student['class']) ?></td>
                    <td><?php echo ($student['number']) ?></td>
                    <td><?php echo ($student['name']); ?></td>
                    <td><a href="show.php?id=<?php echo htmlspecialchars($student['id']); ?>">結果</a></td>
                    <td><a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-primary">変更</a></td>
                    <td><!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Launch demo modal
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button id="delete_button" type="button" class="btn btn-danger" onclick="deleteStudent(<?php echo ($student['id']) ?>)">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>


            <?php endforeach; ?>
        </tbody>
    </table>
</article>
<script>
    function deleteStudent(id) {
        var delete_url = "destroy.php?id=" + id;
        var target = document.getElementById('delete_button');
        var tr = document.getElementById('tr' + id);

        var xhr = new XMLHttpRequest();

        xhr.open(
            "DELETE",
            delete_url,
        );
        xhr.send();

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                tr.remove();
            }
        }
    };
</script>
</body>

</html>