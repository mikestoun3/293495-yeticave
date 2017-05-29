<?php
// подключение файла с функциями
require_once 'functions.php';

// подключение файла с данными лотов
require_once 'lots_data.php';

// проверка id
$lotId = $_GET['id'];
if(!isset($lotId) || !isset($lots[$lotId])) {
    return header("HTTP/1.0 404 Not Found");
}

$current_lot = $lots[$lotId];

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['buyer-name' => 'Иван', 'buyer-price' => 11500, 'buyer-ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['buyer-name' => 'Константин', 'buyer-price' => 11000, 'buyer-ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['buyer-name' => 'Евгений', 'buyer-price' => 10500, 'buyer-ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['buyer-name' => 'Семён', 'buyer-price' => 10000, 'buyer-ts' => strtotime('last week')]
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
