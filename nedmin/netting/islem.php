<?php 
ob_start();
session_start();
include 'baglan.php';

if (isset($_POST['admingiris'])) {
	$admin_kAdi=$_POST['admin_kAdi'];
	$admin_password=($_POST['admin_password']) ;

	$admin=$db -> prepare("SELECT * FROM admin where 
		admin_kAdi=:kAdi and admin_password=:password");
	$admin -> execute(array(
		'kAdi'=> $admin_kAdi,
		'password'=>$admin_password

	));

	$kod_girilen=$_POST['kod_girilen'];

	echo $sayac=$admin -> rowCount();
	if ($sayac==1 ) {
		if (!empty($kod_girilen) && $kod_girilen==$_SESSION['kod']) {
			$_SESSION['admin_kAdi']=$admin_kAdi;
			$_SESSION['admin_password']=$admin_password;

			header("Location:../production/index.php");
		}
		else{
			header("Location:../production/login.php?durum=eror");
			exit();
		}
		
	}
	else{
		header("Location:../production/login.php?durum=no");
		exit();
	}
	
}
if (isset($_POST['kullaniciduzenle'])) {

	$kullanici_id=$_POST['kullanici_id'];
	

	$ayarkaydet=$db->prepare("UPDATE kullanici SET 

		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_gsm=:kullanici_gsm,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce,
		kullanici_univ=:kullanici_univ,
		kullanici_bolum=:kullanici_bolum
		
		WHERE kullanici_id={$_POST['kullanici_id']}");
	$update=$ayarkaydet->execute(array(
		
		'kullanici_ad' => $_POST['kullanici_ad'],
		'kullanici_soyad' => $_POST['kullanici_soyad'],
		'kullanici_gsm' => $_POST['kullanici_gsm'],
		'kullanici_il' => $_POST['kullanici_il'],
		'kullanici_ilce' => $_POST['kullanici_ilce'],
		'kullanici_univ' => $_POST['kullanici_univ'],
		'kullanici_bolum' => $_POST['kullanici_bolum'],

	));

	if($update){
		Header("Location:../production/kullanici-islem.php?kullanici_id=$kullanici_id&durum=ok");
	}else{
		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}	
}

if ($_GET['kullanicisil']=="ok") {

	$sil=$db -> prepare("DELETE from kullanici where kullanici_id=:id");
	$kullanicisil=$sil -> execute(array('id' => $_GET['kullanici_id'] 
));

	$KullanıcıMesajSil=$db -> prepare("DELETE from mesaj where gonderenId=:id or cevaplayanId=:id");
	$Msil=$KullanıcıMesajSil -> execute(array('id' => $_GET['kullanici_id'] 
));

	if ($sil && $KullanıcıMesajSil ) {
		header("location:../production/kullanici-islem.php?sil=ok");
		
	}	
	else {
		header("location:../production/kullanici-islem.php?sil=no");
	}

	
}



if (isset($_POST['gorevduzenle'])) {

	$gorev_id=$_POST['gorev_id'];
	

	$ayarkaydet=$db->prepare("UPDATE gorev SET 

		gorev_baslik=:gorev_baslik,
		gorev_detay=:gorev_detay,
		gorev_kategori=:gorev_kategori,
		gorev_butce=:gorev_butce,
		gorev_yetenek=:gorev_yetenek

		
		WHERE gorev_id={$_POST['gorev_id']}");
	$update=$ayarkaydet->execute(array(
		
		'gorev_baslik' => $_POST['gorev_baslik'],
		'gorev_detay' => $_POST['gorev_detay'],
		'gorev_kategori' => $_POST['gorev_kategori'],
		'gorev_butce' => $_POST['gorev_butce'],
		'gorev_yetenek' => $_POST['gorev_yetenek'],
		
	));

	if($update){
		Header("Location:../production/gorev-islem.php?gorev_id=$gorev_id&durum=ok");
	}else{
		Header("Location:../production/gorev-duzenle.php?gorev_id=$gorev_id&durum=no");
	}	
}

if ($_GET['gorevsil']=="ok") {

	$sil=$db -> prepare("DELETE from gorev where gorev_id=:id");
	$gorevsil=$sil -> execute(array('id' => $_GET['gorev_id'] 
));
	if ($sil) {
		header("location:../production/gorev-islem.php?sil=ok");
		
	}	
	else {
		header("location:../production/gorev-islem.php?sil=no");
	}

	
}

if (isset($_POST['kategoriekle'])) {

	$ad=$_POST['kategori_ad'];

	$kontrol=$db -> prepare("SELECT * from kategori where kategori_ad=:ad");
	$sonuc=$kontrol -> execute(array('ad' => $ad
));
	echo $sayac=$kontrol -> rowCount();

	if ($sayac==1) {
		header("location:../production/kategori-ekle.php?ekle=eror");
	}

	else{
		$ekle=$db -> prepare("INSERT INTO kategori (kategori_ad) VALUES ('$ad')");
		$kategoriekle=$ekle -> execute(array(
		));
		if ($kategoriekle) {
			header("location:../production/kategori-islem.php?ekle=ok");
			
		}	
		else {
			header("location:../production/kategori-ekle.php?ekle=no");
		}

	}






?>


