<?php
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
$intro = trim(filter_var($_POST['intro'], FILTER_SANITIZE_STRING));
$text = trim($_POST['text']);

$error = '';
if (strlen($title) <= 3) {
    $error = 'Введите название статьи';
} else if (strlen($intro) <= 10) {
    $error = 'Введите интро для статьи не меньше 10 символов';

} else if (strlen($text) <= 20) {
    $error = 'Введите текст статьи не меньше 20 символов';

}

if ($error != '') {
    echo $error;
    exit();
}


require_once '../mysql_connect.php';

$sql = 'INSERT INTO articles(title, intro, text, date, author) VALUES(?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$title, $intro, $text, time(), $_COOKIE['login']]);

echo 'ready';