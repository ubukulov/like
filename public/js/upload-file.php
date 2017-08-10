<?php
$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/temp/';

//Получаем расширение файла
$ext = substr($_FILES['upload_file']['name'], strpos($_FILES['upload_file']['name'], '.'), strlen($_FILES['upload_file']['name']) - 1);

//Генерируем название файла с расширением
$file = substr_replace(sha1(microtime(true)), '', 12).$ext;

$file_types = array('.jpg', '.gif', '.bmp', '.png', '.JPG', '.BMP', '.GIF', '.PNG', '.jpeg', '.JPEG');

//проверяем расширение файла
if (!in_array($ext, $file_types)) {
    echo "<p>Данный формат файлов не поддерживается</p>";
} else {
       //перемещаем во временную папку
    if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $upload_dir.$file)) {
        echo $file;
    } else {
        echo "error";
    }
}