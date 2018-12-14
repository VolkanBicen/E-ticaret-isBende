
<?php include 'header.php';  ?>

<?php  
$eposta=$_GET['k'];

$mailsor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail and 
		uye_onay=:onay ");
	$mailsor -> execute(array(
		'mail' => $eposta,
		'onay' => 0
	));
	$girissayac=$mailsor->rowCount();
	if($girissayac==1){

$onayla=$db->prepare("UPDATE kullanici SET 

	uye_onay=:onay

	WHERE kullanici_mail=:gmail");

$update=$onayla->execute(array(

	'onay' => 1,
	'gmail'=> $_GET['k']
));


if($update){
	Header("Location:index.php?mailonay=true");

	exit();
}
else{

	Header("Location:index.php?mailonay=false");
	exit();
}	
}
else{
		
		Header("Location:index.php?mailonay=fault");
		exit();
	}

?>









