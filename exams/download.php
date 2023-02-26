<?php
try {
    $db = new PDO('mysql:dbname=grademanagement; host=127.0.0.1; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo 'DB接続エラー:' . $e->getMessage();
}

$exams = $db->query("SELECT exams.id, tests.name AS test_name, students.name AS student_name, exams.kokugo, exams.sugaku, exams.eigo, exams.rika, exams.shakai, exams.goukei FROM exams INNER JOIN students ON exams.student_id = students.id INNER JOIN tests ON exams.test_id = tests.id");

$csv = 'ID, テスト, 名前, 国語, 数学, 英語, 理科, 社会, 合計';

if (isset($_POST['csvoutput'])) {

    $now = new DateTime();
    $fileName = 'exams-'.$now->format('Ymd').".csv";

    $csvstr = "";

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . $fileName);
    header("Content-Transfer-Encoding: binary");

    $csvstr .= mb_convert_encoding("ID", "SJIS", "UTF-8") . ",";
    $csvstr .= mb_convert_encoding("テスト", "SJIS", "UTF-8") . ",";
    $csvstr .= mb_convert_encoding("名前", "SJIS", "UTF-8") . ",";
    $csvstr .= mb_convert_encoding("国語", "SJIS", "UTF-8") . ",";
    $csvstr .= mb_convert_encoding("数学", "SJIS", "UTF-8") . ",";
    $csvstr .= mb_convert_encoding("英語", "SJIS", "UTF-8") . ",";
    $csvstr .= mb_convert_encoding("理科", "SJIS", "UTF-8") . ",";
    $csvstr .= mb_convert_encoding("社会", "SJIS", "UTF-8") . ",";
    $csvstr .= mb_convert_encoding("合計", "SJIS", "UTF-8") . "\r\n";

    foreach ($exams as $exam) :
        $row = mb_convert_encoding($exam, "SJIS", "UTF-8");

        $csvstr .= $exam['id'] . ",";
        $csvstr .= mb_convert_encoding($exam['test_name'], "SJIS", "UTF-8") . ",";
        $csvstr .= mb_convert_encoding($exam['student_name'], "SJIS", "UTF-8") . ",";
        $csvstr .= $exam['kokugo'] . ",";
        $csvstr .= $exam['sugaku'] . ",";
        $csvstr .= $exam['eigo'] . ",";
        $csvstr .= $exam['rika'] . ",";
        $csvstr .= $exam['shakai'] . ",";
        $csvstr .= $exam['goukei'] . "\r\n";
    endforeach;

    echo $csvstr;
    exit();
}
