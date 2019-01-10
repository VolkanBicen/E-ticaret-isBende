<head>
	<meta charset="UTF-8">
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
ob_start();
session_start();	
date_default_timezone_set('Europe/Istanbul');
include 'nedmin/netting/baglan.php';

if(isset($_POST['sifremiunuttum1'])){

	
	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
	$kullanicisor->execute(array(
		'mail'=>  $_POST['kullanici_mail']
	));
	$say=$kullanicisor->rowCount();
	$kullanici_mail=$_POST['kullanici_mail'];

	if ($say==0) {
		
		Header("Location:index.php?durum=kullaniciyok");
	}else{
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

		$uretilensifre=uniqid();
		$sifrekaydet=md5($uretilensifre);
		//Veritabanı kaydı

		$sifreguncelle=$db->prepare("UPDATE kullanici SET 

			kullanici_password=:kullanici_password

			WHERE kullanici_mail='$kullanici_mail'");

		$update=$sifreguncelle->execute(array(

			'kullanici_password' => $sifrekaydet
		));


		//veri tabanı kaydı bitiş


	//Mail gonderim başlat
		$yenisifre="Yeni Sifreniz :".$uretilensifre;

		

		$mail = new PHPMailer();

		$mail->isSMTP(); 
		$mail->CharSet="SET NAMES UTF8";   
		$mail->SMTPKeepAlive = true;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl'; 
		$mail->Port = 465; 
		$mail->Host = "smtp.gmail.com";
		$mail->Username = "infoisbende@gmail.com";
		$mail->Password = "volkan06";
		$mail->setFrom("infoisbende@gmail.com");
		$mail->addAddress($kullanici_mail);
		$mail->isHTML(true);
		$mail->Subject = "Sifre Yenileme Talebi";
		$mail->Body = $yenisifre;

		if($mail->Send()){

			header("Location:index.php?durum=basarili");
			

		}else {

			header("Location:index.php?durum=basarisiz");
			

		}
	//Mail Gonderim Bitir

	}




}
?>