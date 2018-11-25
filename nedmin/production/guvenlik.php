<?php
ob_start();
session_start();
header('Content-type: image/png');
$resim = ImageCreate(100, 30);
$arka = ImageColorAllocate($resim, rand(0,250), rand(0,250), rand(0,250)); // Güvenli kodu metin rengi
$rand = ImageColorAllocate($resim, rand(200,255), rand(200,255), rand(200,255));
ImageFill($resim, 0, 0, $arka);

$kod=md5(rand(0,999999));
$kod_son=substr($kod, -6);

$_SESSION['kod']=$kod_son;
ImageString($resim, 100, 10, 10, $kod_son, $rand);
ImagePng($resim);
ImageDestroy($resim);

?>