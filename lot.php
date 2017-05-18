<?php
// подключение файла с функциями
require_once 'functions.php';

// подключение файла с данными лотов
require_once 'lots_data.php';

$err404 = false;
$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!isset($goods[$id])) {
    $err404 = true;
    return header("HTTP/1.1 404 Not Found");
}

$current_lot = $lots[$lotId];

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$current_lot['name']?></title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?=includeTemplate('templates/lot_header.php', []); ?>

<?=includeTemplate('templates/lot_main.php', ['lot' => $current_lot, 'bets' => $bets]); ?>

<?=includeTemplate('templates/footer.php', []); ?>

</body>
</html>
