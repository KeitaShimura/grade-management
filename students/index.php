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
                    <td><!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                                        <form id="save-data" name="task_form" onsubmit="update()">
                                            <input type="hidden" id="id" name="id" value="<?php echo $student['id']; ?>">
                                            <input type="hidden" id="token" name="token" value="<?= htmlspecialchars($token, ENT_COMPAT, 'UTF-8'); ?>">
                                            <p>学年</p>
                                            <select id="year" required name="year">
                                                <option type="hidden"><?php echo $student['class'] ?></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                            <p>クラス</p>
                                            <input required id="class" type="number" min="1" max="10" name="class" value="<?php echo $student['class'] ?>">
                                            <p>学生番号</p>
                                            <input required id="number" type="number" min="1" max="10" name="number" value="<?php echo $student['number'] ?>">
                                            <p>氏名</p>
                                            <input required id="name" type="text" name="name" value="<?php echo $student['name'] ?>">

                                            <div>
                                                <button>Save changes</button>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button id="delete_button" type="button" class="btn btn-success" onclick="update()">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Launch static backdrop modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
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
                    <td>
                </tr>


            <?php endforeach; ?>
        </tbody>
    </table>
</article>
<script>
    function update() {
        const id = document.task_form.id.value;
        const year = document.task_form.year.value;
        const className = document.task_form.class.value;
        const number = document.task_form.number.value;
        const name = document.task_form.name.value;

        const data = new FormData();
        data.append('id', id);
        data.append('year', year);
        data.append('class', className);
        data.append('number', number);
        data.append('name', name);

        const xml = new XMLHttpRequest();
        xml.open('POST', 'update.php', true);
        xml.send(data);

        xml.onreadystatechange = function() {
            if (xml.readyState == 4 && xml.status == 200) {
                console.log(xml.responseText);
            }
        }
    }

    function deleteStudent(id) {
        var delete_url = "destroy.php?id=" + id;
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