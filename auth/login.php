<?php
require_once(__DIR__ . '/../func/db_connect.php');
session_start();
$error=null;

if (isset($_COOKIE['email'])) {
    if ($_COOKIE['email'] != '') {
        $_POST['email'] = $_COOKIE['email'];
        $_POST['password'] = $_COOKIE['password'];
        $_POST['save'] = 'on';
    }
}

if (!empty($_POST)) {
    if ($_POST['email'] != '' && $_POST['password'] != '') {
        $login = $db->prepare('SELECT * FROM teachers WHERE email=? AND password =?');
        $login->execute(array(
            $_POST['email'],
            sha1($_POST['password'])
        ));
        $teacher = $login->fetch();

        if ($teacher) {
            $_SESSION['id'] = $teacher['id'];
            $_SESSION['name'] = $teacher['name'];
            $_SESSION['login_time'] = date('y年m月d日 H時i分', time());
            $_SESSION['time'] = time();

            if ($_POST['save'] == 'on') {
                setcookie('email', $_POST['email'], time() + 60 * 60 * 24 * 14);
                setcookie('password', $_POST['password'], time() + 60 * 60 * 24 * 14);
            }

            header('Location: ../index.php');
            exit();
        } else {
            $error['login'] = 'failed';
        }
    } else {
        $error['login'] = 'blank';
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>

<body>
    <h1>ログイン</h1>
    <div id="lead">
        <form action="" method="post">
            <dl>
                <dt>メールアドレス</dt>
                <dd>
                    <input type="text" name="email" size="35" maxlength="255" value="<?php if (isset($_POST['email'])) {
                                                                                            echo htmlspecialchars($_POST['email'], ENT_QUOTES);
                                                                                        } ?>" />
                    <?php if (isset($error['login'])) : ?>
                        <?php if ($error['login'] == 'blank') : ?>
                            <p class="error">※ メールアドレスとパスワードを入力してください</p>
                        <?php endif; ?>
                        <?php if ($error['login'] == 'failed') : ?>
                            <p class="error">※ ログインに失敗しました</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </dd>
                <dt>パスワード</dt>
                <dd>
                    <input type="password" name="password" size="35" maxlength="255" value="<?php if (isset($_POST['password'])) {
                                                                                                echo htmlspecialchars($_POST['password'], ENT_QUOTES);
                                                                                            } ?>" />
                </dd>
                <dt>ログイン情報の記録</dt>
                <input id="save" type="checkbox" name="save" value="on" />
                <label for="save">次回から自動的にログイン</label>
                <div>
                    <input type="submit" value="ログインする" />
                </div>
            </dl>
        </form>
    </div>
</body>

</html>