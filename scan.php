<?php

$target_dir = 'C:\\xampp\htdocs\\OCR-laravel-connector\\';

$document = $_FILES['document'];

if(!isset($document)) {
    echo 'File Not Found';
}

$file_name = $document['name'];
$file_temp = $document['tmp_name'];
$file_size = $document['size'];
$file_error = $document['error'];

$target_file = $target_dir . uniqid() . basename($file_name);

if($file_error == UPLOAD_ERR_OK) {
    move_uploaded_file($file_temp, $target_file);
} else {
    echo 'Terajdi kesalahan saat mengunggah file';
}

$url = 'https://kayanasolusindo.com/api/v2/ocr/ktp';

$ch = curl_init();
$data = [
    'document' => curl_file_create($target_file),
];
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     //"Authentication: Bearer $token",
// ]);

$res = curl_exec($ch);
curl_close($ch);
$res = json_decode($res, true);

var_dump($res);

?>