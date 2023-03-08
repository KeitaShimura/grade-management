<?php

if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {

    $_SESSION['time'] = time();

    $users = $db->prepare('SELECT * FROM teachers WHERE id = ?');
    $users->execute(array($_SESSION['id']));
    $user = $users->fetch();
} else {
    header('Location: login.php');
    exit();
}
?>