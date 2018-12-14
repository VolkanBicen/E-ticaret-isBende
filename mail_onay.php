

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();

$mail->isSMTP(); 
$gonderenmail=$_GET['m'];
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
$mail->Subject = "is bende onay ";
$mail->Body = "Lütfen Aşağıdaki linke tıklayrak mail onay gerçekleştiriniz\r\n http://localhost:8080/eticaret/onay.php?k=$gonderenmail";

if($mail->Send()){

	header("Location:index.php?durum=bekleonay");

}else {

	header("Location:index.php?durum=basarisizonay");

}

?>

