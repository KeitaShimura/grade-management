<?php

if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {

    $_SESSION['time'] = time();

    $teachers = $db->prepare('SELECT * FROM teachers WHERE id = ?');
    $teachers->execute(array($_SESSION['id']));
    $teachers = $teachers->fetch();
} else {
    header('Location: auth/login.php');
    exit();
}
?>