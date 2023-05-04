<?php

$url = 'https://kayanasolusindo.com/api/v2/ocr/ktp';

$ch = curl_init();

$iamgePath = 'C:\xampp\htdocs\OCR-laravel-connector\ktp2.png';

$data = [
    'document' => curl_file_create($iamgePath),
];

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$res = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Error';
}

curl_close($ch);

var_dump($res);