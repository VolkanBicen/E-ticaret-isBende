
<?php
include 'nedmin/netting/baglan.php';


$yeteneksor=$db-> prepare("SELECT * FROM yetenek where yetenekId=:id");
  $yeteneksor -> execute(array(
    'id'=> $_GET['id']
  ));
  $yetenekcek=$yeteneksor -> fetch(PDO::FETCH_ASSOC);
 




$kullanicimailsor = $db->prepare("SELECT kullanici_mail FROM kullanici inner join kullaniciyetenek on kullaniciyetenek.kullaniciId = kullanici.kullanici_id where kullaniciyetenek.yetenekid =:id");
$kullanicimailsor->execute(array(
	'id'=> $_GET['id']
));
$kullanicimailcek = $kullanicimailsor->fetchAll(PDO::FETCH_ASSOC);



;



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();

$mail->isSMTP(); 
$gorev_yetenek_id=$_GET['id'];
$veri="vbicen2@gmail.com";
$mail->CharSet="SET NAMES UTF8";   
$mail->SMTPKeepAlive = true;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //ssl
$mail->Port = 465; //25 , 465 , 587
$mail->Host = "smtp.gmail.com";
$mail->Username = "vbicen1@gmail.com";
$mail->Password = "@@v0lkan-6606";
$mail->setFrom("vbicen1@gmail.com");
foreach ($kullanicimailcek as $bb) { 
		$mail->addBCC($bb['kullanici_mail']);
	}
  

$mail->isHTML(true);
$mail->Subject = "is bende gorev ";
$mail->Body = $yetenekcek['yetenekadi']." yeteneğinize ait yeni bir görev yüklenmiştir..";

if($mail->Send()){

	header("Location:profil.php");

}else {

	header("Location:index.php?durum=basarisizonay");

}

?>

