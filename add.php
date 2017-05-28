<?php 
require_once 'functions.php'; 
require_once 'lots_data.php'; 

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"]; 

// если заполнено поле, если поле заполнено правильно 


// не заполнено, неправильно заполнено 
$data_error = []; 

if(isset($_POST['form_submit'])) {

    //проверка имени 
    if (!empty($_POST['lot-name'])) { 
    $data_new_lot['name'] = htmlspecialchars($_POST['lot-name']); 
    } else { 
    $data_error['name'] = 'Введите наименование лота'; 
    } 

    //проверка описания 
    if (!empty($_POST['message'])) { 
    $data_new_lot['description'] = htmlspecialchars($_POST['message']); 
    } else { 
    $data_error['message'] = 'Введите описание лота'; 
    } 

    //проверка начальной стоимости 
    if (empty($_POST['lot-rate']) || !is_numeric($_POST['lot-rate'])) { 
    $data_error['lot-rate'] = 'Некорректное значение'; 
    } else { 
    $data_new_lot['price'] = $_POST['lot-rate']; 
    } 

    //проверка шага стоимости 
    if (empty($_POST['lot-step']) || !is_numeric($_POST['lot-step']) || $_POST['lot-step'] < 0) { 
    $data_error['lot-step'] = 'Некорректное значение'; 
    } else { 
    $data_new_lot['step'] = $_POST['lot-step']; 
    } 

    //проверка даты 
    if (empty($_POST['lot-date'])) { 
    $data_error['lot-date'] = 'Введите дату'; 
    } else { 
    $data_new_lot['date'] = $_POST['lot-date']; 
    } 

    //проверка категорий 
    if (!in_array($_POST['category'], $categories)) { 
    $data_error['category'] = 'Некорректное значение'; 
    } else {
      $data_new_lot['category'] = $_POST['category'];
    }

    //проверка и размещение фото 
    if (isset($_FILES['lot-file'])) { 
    $file = $_FILES['lot-file']; 
    if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/png') { 
    $uploadedfile = move_uploaded_file($file['tmp_name'], 'img/' . $file['name']); 
    } else { 
    $data_error['lot-file'] = 'Загрузите фото в формате jpeg/png'; 
    } 
    } 
}
  $data_new_lot = []; 
?>


<!DOCTYPE html> 
<html lang="ru"> 
<head> 
<meta charset="UTF-8"> 
<title>Добавление лота</title> 
<link href="css/normalize.min.css" rel="stylesheet"> 
<link href="css/style.css" rel="stylesheet"> 
</head> 
<body> 

<?=includeTemplate('templates/lot_header.php', []); ?> 
<? if (count($data_error) == 0) {
  print includeTemplate('templates/add_main.php', $data_new_lot);
} else {
  print includeTemplate('templates/add_main.php', $data_error);
} ?>
<?=includeTemplate('templates/footer.php', []); ?> 

</body> 
</html>