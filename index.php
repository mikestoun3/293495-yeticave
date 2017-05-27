<?php
// подключение файла с функциями
require_once 'functions.php';
// подключение файла с данными лотов
require_once 'lots_data.php';
// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');
// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";
// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');
// временная метка для настоящего времени
$now = time();
// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
$lot_time_difference = ($tomorrow - $now);
$lot_hours_remaining = floor($lot_time_difference/3600);
$lot_mins_remaining = floor(($lot_time_difference/60)-$lot_hours_remaining*60);
$lot_time_remaining = $lot_hours_remaining .":". $lot_mins_remaining;
if ($lot_mins_remaining < 10) {
    $lot_time_remaining = $lot_hours_remaining . ":0" . $lot_mins_remaining;
} else {
    $lot_time_remaining = $lot_hours_remaining . ":" . $lot_mins_remaining;
}
// массив категорий
$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?=includeTemplate('templates/header.php', []); ?>

<?=includeTemplate('templates/main.php', ['categories' => $categories, 'lots' => $lots, 'lot_time_remaining' => $lot_time_remaining]); ?>

<?=includeTemplate('templates/footer.php', []); ?>

</body>
</html>
