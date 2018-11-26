<?php 
ob_start();
session_start();
include 'baglan.php';


if (isset($_POST['kullanicikaydet'])) {


	echo $kullanici_ad=htmlspecialchars($_POST['kullanici_ad']); echo "<br>";
	echo $kullanici_soyad=htmlspecialchars($_POST['kullanici_soyad']); echo "<br>";

	echo $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); echo "<br>";
	echo $kullanici_gsm=htmlspecialchars($_POST['kullanici_gsm']); echo "<br>";
	echo $kullanici_passwordone=trim($_POST['kullanici_passwordone']); echo "<br>";
	echo $kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); echo "<br>";

	echo $kullanici_il=htmlspecialchars($_POST['kullanici_il']); echo "<br>";
	echo $kullanici_ilce=htmlspecialchars($_POST['kullanici_ilce']); echo "<br>";

	echo $kullanici_univ=htmlspecialchars($_POST['kullanici_univ']); echo "<br>";
	echo $kullanici_bolum=htmlspecialchars($_POST['kullanici_bolum']); echo "<br>";
	echo $kullanici_derece=htmlspecialchars($_POST['kullanici_derece']); echo "<br>";
	echo $kullanici_durum=htmlspecialchars($_POST['kullanici_durum']); echo "<br>";

	if ($kullanici_passwordone==$kullanici_passwordtwo) {
		echo "parola";
		if (strlen($kullanici_passwordone)>=6) {
			echo "6";


			$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
			));

			//dönen satır sayısını belirtir
			$say=$kullanicisor->rowCount();



			if ($say==0) {
				echo "say";
				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$kullanici_password=md5($kullanici_passwordone);



			//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
					kullanici_ad=:kullanici_ad,
					kullanici_soyad=:kullanici_soyad,
					kullanici_mail=:kullanici_mail,
					kullanici_gsm=:kullanici_gsm,
					kullanici_password=:kullanici_password,
					kullanici_il=:kullanici_il,
					kullanici_ilce=:kullanici_ilce,
					kullanici_univ=:kullanici_univ,
					kullanici_bolum=:kullanici_bolum,
					kullanici_derece=:kullanici_derece,
					kullanici_durum=:kullanici_durum
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_ad' => $kullanici_ad,
					'kullanici_soyad' => $kullanici_soyad,
					'kullanici_mail' => $kullanici_mail,
					'kullanici_gsm' => $kullanici_gsm,
					'kullanici_password' => $kullanici_password,
					'kullanici_il' => $kullanici_il,
					'kullanici_ilce' => $kullanici_ilce,
					'kullanici_univ' => $kullanici_univ,
					'kullanici_bolum' => $kullanici_bolum,
					'kullanici_derece' => $kullanici_derece,
					'kullanici_durum' => $kullanici_durum

				));

				if ($insert) {
					echo "başarılı";

					header("Location:../../index.php?durum=loginbasarili");


				//Header("Location:../production/genel-ayarlar.php?durum=ok");

				} else {

					echo "başarılı";
					//header("Location:../../register.php?durum=basarisiz");
				}

			} else {

				header("Location:../../register.php?durum=mukerrerkayit");



			}






		}
	}
}


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


if (isset($_POST['kategoriduzenle'])) {

	$kategori_id=$_POST['kategori_id'];
	

	$ayarkaydet=$db->prepare("UPDATE kategori SET 

		kategori_ad=:kategori_ad
		
		WHERE kategori_id={$_POST['kategori_id']}");
	$update=$ayarkaydet->execute(array(
		
		'kategori_ad' => $_POST['kategori_ad'],
		
	));

	if($update){
		Header("Location:../production/kategori-islem.php?kategori_id=$kategori_id&durum=ok");
	}else{
		Header("Location:../production/kategori-duzenle.php?kategori_id=$kategori_id&durum=no");
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


if ($_GET['kategorisil']=="ok") {

	$sil=$db -> prepare("DELETE from kategori where kategori_id=:id");
	$kategorisil=$sil -> execute(array('id' => $_GET['kategori_id'] 
));
	if ($sil) {
		header("location:../production/kategori-islem.php?sil=ok");
		
	}	
	else {
		header("location:../production/kategori-islem.php?sil=no");
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
	

	
	
}


if ($_GET['mesajsil']=="ok") {

	$sil=$db -> prepare("DELETE from mesaj where mesajId=:id");
	$mesajsil=$sil -> execute(array('id' => $_GET['mesajId'] 
));
	if ($sil) {
		header("location:../production/mesaj-islem.php?sil=ok");
		
	}	
	else {
		header("location:../production/mesaj-islem.php?sil=no");
	}

	
}

?>