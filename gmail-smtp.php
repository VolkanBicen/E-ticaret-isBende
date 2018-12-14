<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();

$mail->isSMTP();
$gonderenmail="vbicen2@gmail.com";
$mail->CharSet="SET NAMES UTF8";  
$mail->SMTPKeepAlive = true;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //ssl
$mail->Port = 465; //25 , 465 , 587
$mail->Host = "smtp.gmail.com";
$mail->Username = "vbicen1@gmail.com";
$mail->Password = "@@v0lkan-6606";
$mail->setFrom("vbicen1@gmail.com");
$mail->addAddress($gonderenmail);
$mail->isHTML(true);
$mail->Subject =  "From: ".$_POST["adsoyad"]."<".$_POST["email"].">\r\n";
$mail->Body = "<h1>".$_POST["mesaj"]."</h1>";

if ($mail->send())
	header("Location:iletisim.php?durum=mailbasarili");
exit();
else
	header("Location:iletisim.php?durum=mailbasarisiz");
exit();


?>


