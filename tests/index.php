<?php
require_once(__DIR__ . '/../components/header.php');

$tests = $db->query('SELECT * FROM tests');

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
    <article>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>学年</th>
                    <th>テスト名</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($test = $tests->fetch()) : ?>

                    <tr id="tr<?php echo ($test['id']); ?>">
                        <td><?php echo ($test['id']) ?></td>
                        <td><?php echo ($test['year']); ?></td>
                        <td><?php echo ($test['name']); ?></td>
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
                                                <input type="hidden" id="id" name="id" value="<?php echo $test['id']; ?>">
                                                <p>学年</p>
                                                <select required name="year">
                                                    <option type="hidden"><?php echo $test['year'] ?></option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                                <select required name="name">
                                                    <option type="hidden"><?php echo $test['name'] ?></option>
                                                    <option>前期中間テスト</option>
                                                    <option>前期期末テスト</option>
                                                    <option>後期中間テスト</option>
                                                    <option>後期期末テスト</option>
                                                </select>
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
                                            <button id="delete_button" type="button" class="btn btn-danger" onclick="deleteTest(<?php echo ($test['id']) ?>)">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>
    </article>
    <script>
        function update() {
            const id = document.task_form.id.value;
            const year = document.task_form.year.value;
            const name = document.task_form.name.value;

            const data = new FormData();
            data.append('id', id);
            data.append('year', year);
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

        function deleteTest(id) {
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