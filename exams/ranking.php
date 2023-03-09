<?php
require_once(__DIR__ . '/../components/header.php');

$tests = $db->query("SELECT year, name FROM tests");
$tests = $tests->fetchAll();

$exams = $db->prepare("SELECT tests.name as test_name, students.name as student_name, kokugo, sugaku, eigo, rika, shakai, goukei FROM exams INNER JOIN tests ON exams.test_id = tests.id INNER JOIN students ON exams.student_id = students.id WHERE tests.name = ? AND tests.year = ? ORDER BY goukei DESC LIMIT 5");
$exams->execute(array($_GET['test_name'], $_GET['year']));
$exams = $exams->fetchAll();

$kokugo = $db->prepare("SELECT tests.name as test_name, students.name as student_name, kokugo, sugaku, eigo, rika, shakai, goukei FROM exams INNER JOIN tests ON exams.test_id = tests.id INNER JOIN students ON exams.student_id = students.id WHERE tests.name = ? AND tests.year = ? ORDER BY kokugo DESC LIMIT 5");
$kokugo->execute(array($_GET['test_name'], $_GET['year']));
$kokugo = $kokugo->fetchAll();

$sugaku = $db->prepare("SELECT tests.name as test_name, students.name as student_name, kokugo, sugaku, eigo, rika, shakai, goukei FROM exams INNER JOIN tests ON exams.test_id = tests.id INNER JOIN students ON exams.student_id = students.id WHERE tests.name = ? AND tests.year = ? ORDER BY sugaku DESC LIMIT 5");
$sugaku->execute(array($_GET['test_name'], $_GET['year']));
$sugaku = $sugaku->fetchAll();

$eigo = $db->prepare("SELECT tests.name as test_name, students.name as student_name, kokugo, sugaku, eigo, rika, shakai, goukei FROM exams INNER JOIN tests ON exams.test_id = tests.id INNER JOIN students ON exams.student_id = students.id WHERE tests.name = ? AND tests.year = ? ORDER BY eigo DESC LIMIT 5");
$eigo->execute(array($_GET['test_name'], $_GET['year']));
$eigo = $eigo->fetchAll();

$rika = $db->prepare("SELECT tests.name as test_name, students.name as student_name, kokugo, sugaku, eigo, rika, shakai, goukei FROM exams INNER JOIN tests ON exams.test_id = tests.id INNER JOIN students ON exams.student_id = students.id WHERE tests.name = ? AND tests.year = ? ORDER BY rika DESC LIMIT 5");
$rika->execute(array($_GET['test_name'], $_GET['year']));
$rika = $rika->fetchAll();

$shakai = $db->prepare("SELECT tests.name as test_name, students.name as student_name, kokugo, sugaku, eigo, rika, shakai, goukei FROM exams INNER JOIN tests ON exams.test_id = tests.id INNER JOIN students ON exams.student_id = students.id WHERE tests.name = ? AND tests.year = ? ORDER BY shakai DESC LIMIT 5");
$shakai->execute(array($_GET['test_name'], $_GET['year']));
$shakai = $shakai->fetchAll();

?>
<h1>テストランキング</h1>

<div>
    <a href="../index.php">トップに戻る</a>
    <a href="index.php">テスト一覧に戻る</a>
</div>

<div>
    <h2>学年ランキング</h2>
    <?php foreach ($tests as $test) { ?>
        <a href="ranking.php?test_name=<?php echo $test['name']; ?>"><?php echo $test['name']; ?></a>&ensp;
    <?php } ?>
</div>

<div>
    <h2>学年ランキング</h2>
    <a href="ranking.php?test_name=<?php echo $test['name']; ?>&year=1">1年生</a>
    <a href="ranking.php?test_name=<?php echo $test['name']; ?>&year=2">2年生</a>
    <a href="ranking.php?test_name=<?php echo $test['name']; ?>&year=3">3年生</a>
</div>

<p>テスト種類:<?php echo htmlspecialchars($_GET['year']); ?> 年<?php echo htmlspecialchars($_GET['test_name']); ?> </p>

<h2>総合トップ5</h2>
<table>
    <tr>
        <th>順位</th>
        <th>テスト名</th>
        <th>名前</th>
        <th>国語</th>
        <th>数学</th>
        <th>英語</th>
        <th>理科</th>
        <th>社会</th>
        <th>合計</th>
    </tr>
    <?php for ($i = 0; $i < count($exams); $i++) { ?>
        <?php
        if ($i == 0) {
            $color = 'red';
        } elseif ($i == 1) {
            $color = 'orange';
        } else {
            $color = 'grey';
        } ?>
        <tr>
            <td><?php if ($i < 3) {
                    echo '<i class="fa-solid fa-crown" style="color:' . $color . '"></i>';
                } ?> <?php echo htmlspecialchars($i + 1); ?> </td>
            <td><?php echo htmlspecialchars($exams[$i]['test_name']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['student_name']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['kokugo']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['sugaku']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['eigo']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['rika']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['shakai']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['goukei']); ?></td>
        </tr>
    <?php } ?>
</table>

<h2>国語トップ5</h2>
<table>
    <tr>
        <th>順位</th>
        <th>テスト名</th>
        <th>名前</th>
        <th>国語</th>
        <th>数学</th>
        <th>英語</th>
        <th>理科</th>
        <th>社会</th>
        <th>合計</th>
    </tr>
    <?php for ($i = 0; $i < count($kokugo); $i++) { ?>
        <?php
        if ($i == 0) {
            $color = 'red';
        } elseif ($i == 1) {
            $color = 'orange';
        } else {
            $color = 'grey';
        } ?>
        <tr>
            <td><?php if ($i < 3) {
                    echo '<i class="fa-solid fa-crown" style="color:' . $color . '"></i>';
                } ?> <?php echo htmlspecialchars($i + 1); ?> </td>
            <td><?php echo htmlspecialchars($exams[$i]['test_name']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['student_name']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['kokugo']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['sugaku']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['eigo']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['rika']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['shakai']); ?></td>
            <td><?php echo htmlspecialchars($exams[$i]['goukei']); ?></td>
        </tr>
    <?php } ?>
</table>

<h2>数学トップ5</h2>
<table>
    <tr>
        <th>順位</th>
        <th>テスト名</th>
        <th>名前</th>
        <th>国語</th>
        <th>数学</th>
        <th>英語</th>
        <th>理科</th>
        <th>社会</th>
        <th>合計</th>
    </tr>
    <?php for ($i = 0; $i < count($sugaku); $i++) { ?>
        <?php
        if ($i == 0) {
            $color = 'red';
        } elseif ($i == 1) {
            $color = 'orange';
        } else {
            $color = 'grey';
        } ?>
        <tr>
            <td><?php if ($i < 3) {
                    echo '<i class="fa-solid fa-crown" style="color:' . $color . '"></i>';
                } ?> <?php echo htmlspecialchars($i + 1); ?> </td>
            <td><?php echo htmlspecialchars($sugaku[$i]['test_name']); ?></td>
            <td><?php echo htmlspecialchars($sugaku[$i]['student_name']); ?></td>
            <td><?php echo htmlspecialchars($sugaku[$i]['kokugo']); ?></td>
            <td><?php echo htmlspecialchars($sugaku[$i]['sugaku']); ?></td>
            <td><?php echo htmlspecialchars($sugaku[$i]['eigo']); ?></td>
            <td><?php echo htmlspecialchars($sugaku[$i]['rika']); ?></td>
            <td><?php echo htmlspecialchars($sugaku[$i]['shakai']); ?></td>
            <td><?php echo htmlspecialchars($sugaku[$i]['goukei']); ?></td>
        </tr>
    <?php } ?>
</table>

<h2>英語トップ5</h2>
<table>
    <tr>
        <th>順位</th>
        <th>テスト名</th>
        <th>名前</th>
        <th>国語</th>
        <th>数学</th>
        <th>英語</th>
        <th>理科</th>
        <th>社会</th>
        <th>合計</th>
    </tr>
    <?php for ($i = 0; $i < count($eigo); $i++) { ?>
        <?php
        if ($i == 0) {
            $color = 'red';
        } elseif ($i == 1) {
            $color = 'orange';
        } else {
            $color = 'grey';
        } ?>
        <tr>
            <td><?php if ($i < 3) {
                    echo '<i class="fa-solid fa-crown" style="color:' . $color . '"></i>';
                } ?> <?php echo htmlspecialchars($i + 1); ?> </td>
            <td><?php echo htmlspecialchars($eigo[$i]['test_name']); ?></td>
            <td><?php echo htmlspecialchars($eigo[$i]['student_name']); ?></td>
            <td><?php echo htmlspecialchars($eigo[$i]['kokugo']); ?></td>
            <td><?php echo htmlspecialchars($eigo[$i]['sugaku']); ?></td>
            <td><?php echo htmlspecialchars($eigo[$i]['eigo']); ?></td>
            <td><?php echo htmlspecialchars($eigo[$i]['rika']); ?></td>
            <td><?php echo htmlspecialchars($eigo[$i]['shakai']); ?></td>
            <td><?php echo htmlspecialchars($eigo[$i]['goukei']); ?></td>
        </tr>
    <?php } ?>
</table>

<h2>理科トップ5</h2>
<table>
    <tr>
        <th>順位</th>
        <th>テスト名</th>
        <th>名前</th>
        <th>国語</th>
        <th>数学</th>
        <th>英語</th>
        <th>理科</th>
        <th>社会</th>
        <th>合計</th>
    </tr>
    <?php for ($i = 0; $i < count($rika); $i++) { ?>
        <?php
        if ($i == 0) {
            $color = 'red';
        } elseif ($i == 1) {
            $color = 'orange';
        } else {
            $color = 'grey';
        } ?>
        <tr>
            <td><?php if ($i < 3) {
                    echo '<i class="fa-solid fa-crown" style="color:' . $color . '"></i>';
                } ?> <?php echo htmlspecialchars($i + 1); ?> </td>
            <td><?php echo htmlspecialchars($rika[$i]['test_name']); ?></td>
            <td><?php echo htmlspecialchars($rika[$i]['student_name']); ?></td>
            <td><?php echo htmlspecialchars($rika[$i]['kokugo']); ?></td>
            <td><?php echo htmlspecialchars($rika[$i]['sugaku']); ?></td>
            <td><?php echo htmlspecialchars($rika[$i]['eigo']); ?></td>
            <td><?php echo htmlspecialchars($rika[$i]['rika']); ?></td>
            <td><?php echo htmlspecialchars($rika[$i]['shakai']); ?></td>
            <td><?php echo htmlspecialchars($rika[$i]['goukei']); ?></td>
        </tr>
    <?php } ?>
</table>

<h2>社会トップ5</h2>
<table>
    <tr>
        <th>順位</th>
        <th>テスト名</th>
        <th>名前</th>
        <th>国語</th>
        <th>数学</th>
        <th>英語</th>
        <th>理科</th>
        <th>社会</th>
        <th>合計</th>
    </tr>
    <?php for ($i = 0; $i < count($shakai); $i++) { ?>
        <?php
        if ($i == 0) {
            $color = 'red';
        } elseif ($i == 1) {
            $color = 'orange';
        } else {
            $color = 'grey';
        } ?>
        <tr>
            <td><?php if ($i < 3) {
                    echo '<i class="fa-solid fa-crown" style="color:' . $color . '"></i>';
                } ?> <?php echo htmlspecialchars($i + 1); ?> </td>
            <td><?php echo htmlspecialchars($shakai[$i]['test_name']); ?></td>
            <td><?php echo htmlspecialchars($shakai[$i]['student_name']); ?></td>
            <td><?php echo htmlspecialchars($shakai[$i]['kokugo']); ?></td>
            <td><?php echo htmlspecialchars($shakai[$i]['sugaku']); ?></td>
            <td><?php echo htmlspecialchars($shakai[$i]['eigo']); ?></td>
            <td><?php echo htmlspecialchars($shakai[$i]['rika']); ?></td>
            <td><?php echo htmlspecialchars($shakai[$i]['shakai']); ?></td>
            <td><?php echo htmlspecialchars($shakai[$i]['goukei']); ?></td>
        </tr>
    <?php } ?>
</table>

</body>


</body>

</html>