<?php

try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');

    $exams_table = 'CREATE TABLE IF NOT EXISTS exams (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        test_id INT(11) NOT NULL,
        student_id INT(11) NOT NULL,
        kokugo VARCHAR(20) NOT NULL,
        sugaku VARCHAR(20) NOT NULL,
        eigo VARCHAR(20) NOT NULL,
        rika VARCHAR(20) NOT NULL,
        shakai VARCHAR(20) NOT NULL,
        goukei VARCHAR(20) NOT NULL,
        created_at DATETIME,
        updated_at DATETIME
    )';
    
    $students_table = 'CREATE TABLE IF NOT EXISTS students (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        year INT(11) NOT NULL,
        class INT(11) NOT NULL,
        number INT(11) NOT NULL,
        name VARCHAR(20) NOT NULL,
        created_at DATETIME,
        updated_at DATETIME
    )';
    
    $tests_table = 'CREATE TABLE IF NOT EXISTS tests (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        year INT(11) NOT NULL,
        name VARCHAR(20) NOT NULL,
        created_at DATETIME,
        updated_at DATETIME
    )';

$db->query($exams_table);
$db->query($students_table);
$db->query($tests_table);

} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}