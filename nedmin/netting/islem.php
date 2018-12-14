<?php 
ob_start();
session_start();
include 'baglan.php';


if (isset($_POST['kullanicikaydet'])) {

	$kullanici_ad=htmlspecialchars($_POST['kullanici_ad']); echo "<br>";
	$kullanici_soyad=htmlspecialchars($_POST['kullanici_soyad']); echo "<br>";

	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); echo "<br>";
	$kullanici_gsm=htmlspecialchars($_POST['kullanici_gsm']); echo "<br>";
	$kullanici_passwordone=trim($_POST['kullanici_passwordone']); echo "<br>";
	$kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); echo "<br>";

	$kullanici_il=htmlspecialchars($_POST['kullanici_il']); echo "<br>";
	$kullanici_ilce=htmlspecialchars($_POST['kullanici_ilce']); echo "<br>";
	$kullanici_adres=htmlspecialchars($_POST['kullanici_adres']); echo "<br>";

	$kullanici_univ=htmlspecialchars($_POST['kullanici_univ']); echo "<br>";
	$kullanici_bolum=htmlspecialchars($_POST['kullanici_bolum']); echo "<br>";
	$kullanici_derece=htmlspecialchars($_POST['kullanici_derece']); echo "<br>";
	

	if ($kullanici_passwordone==$kullanici_passwordtwo) {
		

		$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail");
		$kullanicisor->execute(array(
			'mail' => $kullanici_mail
		));

			//dönen satır sayısını belirtir
		$say=$kullanicisor->rowCount();



		if ($say==0) {

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
				kullanici_adres=:kullanici_adres,
				kullanici_univ=:kullanici_univ,
				kullanici_bolum=:kullanici_bolum,
				kullanici_derece=:kullanici_derece
				
				");
			$insert=$kullanicikaydet->execute(array(
				'kullanici_ad' => $kullanici_ad,
				'kullanici_soyad' => $kullanici_soyad,
				'kullanici_mail' => $kullanici_mail,
				'kullanici_gsm' => $kullanici_gsm,
				'kullanici_password' => $kullanici_password,
				'kullanici_il' => $kullanici_il,
				'kullanici_ilce' => $kullanici_ilce,
				'kullanici_adres' => $kullanici_adres,
				'kullanici_univ' => $kullanici_univ,
				'kullanici_bolum' => $kullanici_bolum,
				'kullanici_derece' => $kullanici_derece,
				

			));

			if ($insert) {
				header("Location:../../mail_onay.php?m=$kullanici_mail");
				
				exit();

			} else {


				header("Location:../../register.php?durum=basarisiz");
				exit();
			}

		} else {

			header("Location:../../register.php?durum=mukerrerkayit");
			exit();

		}
	}
}
if (isset($_POST['kullanicigiris'])) {

	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_password=md5($_POST['kullanici_password']);

	$kullanicigirissor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail and 
		kullanici_password=:password  and 
		uye_onay=:onay ");
	$kullanicigirissor -> execute(array(
		'mail' => $kullanici_mail,
		'password' => $kullanici_password,
		'onay' => 1
		
	));
	
	$guvenlik_kod=$_POST['guvenlik_kod'];
	$girissayac=$kullanicigirissor->rowCount();
	$kullanicigiriscek=$kullanicigirissor->fetch(PDO :: FETCH_ASSOC);
	if($girissayac==1){
		if (!empty($guvenlik_kod) && $guvenlik_kod==$_SESSION['kodgiris']) {
			$_SESSION['kullanici_id']=$kullanicigiriscek['kullanici_id'];

			header("Location:../../?durum=basariligiris");
			exit();
			
		}
		else{
			
			header("Location:../../?durum=eror");
			exit();
		}
	}

	else{
		
		header("Location:../../?durum=no");
		exit();
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
			$_SESSION['admin_kAdi']= $admin_kAdi;
			header("Location:../production/index.php");
			exit();
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
		exit();
	}else{
		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
		exit();
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
		exit();
	}else{
		Header("Location:../production/gorev-duzenle.php?gorev_id=$gorev_id&durum=no");
		exit();
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
		exit();
	}else{
		Header("Location:../production/kategori-duzenle.php?kategori_id=$kategori_id&durum=no");
		exit();
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
		exit();
		
	}	
	else {
		header("location:../production/kullanici-islem.php?sil=no");
		exit();
	}

	
}

if ($_GET['gorevsil']=="ok") {

	$sil=$db -> prepare("DELETE from gorev where gorev_id=:id");
	$gorevsil=$sil -> execute(array('id' => $_GET['gorev_id'] 
));
	if ($sil) {
		header("location:../production/gorev-islem.php?sil=ok");
		exit();
		
	}	
	else {
		header("location:../production/gorev-islem.php?sil=no");
		exit();
	}

	
}


if ($_GET['kategorisil']=="ok") {

	$sil=$db -> prepare("DELETE from kategori where kategori_id=:id");
	$kategorisil=$sil -> execute(array('id' => $_GET['kategori_id'] 
));
	if ($sil) {
		header("location:../production/kategori-islem.php?sil=ok");
		exit();
		
	}	
	else {
		header("location:../production/kategori-islem.php?sil=no");
		exit();
	}

}

if (isset($_POST['kategoriekle'])) {

	$ad=$_POST['kategori_ad'];

	$kontrol=$db -> prepare("SELECT * from kategori where kategori_ad=:ad");
	$sonuc=$kontrol -> execute(array('ad' => $ad
));
	echo $sayac=$kontrol -> rowCount();

	if ($sayac==0) {

		$ekle=$db -> prepare("INSERT INTO kategori (kategori_ad) VALUES ('$ad')");
		$kategoriekle=$ekle -> execute(array(
		));
		if ($kategoriekle) {
			header("location:../production/kategori-islem.php?ekle=ok");
			exit();
			
		}	
		else {
			header("location:../production/kategori-ekle.php?ekle=no");
			exit();
		}		
	}

	else{
		
		header("location:../production/kategori-ekle.php?ekle=eror");
		exit();
	}
	
}

if ($_GET['mesajsil']=="ok") {

	$sil=$db -> prepare("DELETE from mesaj where mesajId=:id");
	$mesajsil=$sil -> execute(array('id' => $_GET['mesajId'] 
));
	if ($sil) {
		header("location:../production/mesaj-islem.php?sil=ok");
		exit();
		
	}	
	else {
		header("location:../production/mesaj-islem.php?sil=no");
		exit();
	}
	
}

if (isset($_POST['adminekle'])) {

	$ad=$_POST['admin_kAdi'];
	$adminpass=$_POST['Yadmin_password'];
	$oturumpassword=$_POST['oturum_password'];

	$kontrol=$db -> prepare("SELECT * from admin where admin_kAdi=:ad");
	$sonuc=$kontrol -> execute(array('ad' => $ad
));
	$sayac=$kontrol -> rowCount();

	

	if ($sayac==0) {
		if ($oturumpassword==$_SESSION['admin_password']) {

			$ekle=$db -> prepare("INSERT INTO admin (admin_kAdi,admin_password) VALUES ('$ad','$adminpass')");
			$adminekle=$ekle -> execute(array(
			));

			if ($adminekle) {
				header("location:../production/admin-islem.php?ekle=ok");
				exit();

			}	
			else {
				header("location:../production/admin-islem.php?ekle=no");
				exit();
			}
		}
		else{
			header("location:../production/admin-islem.php?ekle=eror");
			exit();
		}

		
	}
	else{
		header("location:../production/admin-islem.php?ekle=hata");
		exit();
	}
}

if (isset($_POST['genelayarkaydet'])) {

	$ayarkaydet=$db->prepare("UPDATE ayar SET 

		ayar_baslik=:ayar_baslik,
		ayar_aciklama=:ayar_aciklama,
		ayar_keywords=:ayar_keywords,
		ayar_yazar=:ayar_yazar
		
		WHERE ayar_id=1");
	$update=$ayarkaydet->execute(array(
		
		'ayar_baslik' => $_POST['ayar_baslik'],
		'ayar_aciklama' => $_POST['ayar_aciklama'],
		'ayar_keywords' => $_POST['ayar_keywords'],
		'ayar_yazar' => $_POST['ayar_yazar'],
		
	));

	if($update){
		Header("Location:../production/genel-ayar.php?durum=ok");
		exit();
	}else{
		Header("Location:../production/genel-ayar.php?durum=no");
		exit();
	}	
}

if (isset($_POST['sosyalmedyakaydet'])) {

	$ayarkaydet=$db->prepare("UPDATE ayar SET 

		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_youtube=:ayar_youtube
		
		
		WHERE ayar_id=1");
	$update=$ayarkaydet->execute(array(
		
		'ayar_facebook' => $_POST['ayar_facebook'],
		'ayar_twitter' => $_POST['ayar_twitter'],
		'ayar_youtube' => $_POST['ayar_youtube'],
		
		
	));

	if($update){
		Header("Location:../production/sosyal-medya.php?durum=ok");
		exit();
	}else{
		Header("Location:../production/sosyal-medya.php?durum=no");
		exit();
	}	
}

if (isset($_POST['hakkimizdakaydet'])) {

	$ayarkaydet=$db->prepare("UPDATE hakkimizda SET 

		hakkimizda_baslik=:hakkimizda_baslik,
		hakkimizda_icerik=:hakkimizda_icerik,
		hakkimizda_misyon=:hakkimizda_misyon,
		hakkimizda_vizyon=:hakkimizda_vizyon

		WHERE hakkimizda_id=0");
	$update=$ayarkaydet->execute(array(
		
		'hakkimizda_baslik' => $_POST['hakkimizda_baslik'],
		'hakkimizda_icerik' => $_POST['hakkimizda_icerik'],
		'hakkimizda_misyon' => $_POST['hakkimizda_misyon'],
		'hakkimizda_vizyon' => $_POST['hakkimizda_vizyon'],
		
		
	));

	if($update){
		Header("Location:../production/hakkimizda.php?durum=ok");
		exit();
	}else{
		Header("Location:../production/hakkimizda.php?durum=no");
		exit();
	}	
}
if (isset($_FILES['dosya'])) {


	if (!empty($_FILES)) {
		$hata = $_FILES['dosya']['error'];
		if($hata != 0) {
			Header("Location:../../profil.php?durum=no");
			exit();
		} else {
			$name = $_FILES['dosya']["name"];
			$benzersizsayi1=rand(20000,32000);
			$benzersizsayi2=rand(20000,32000);
			$benzersizad=$benzersizsayi1.$benzersizsayi2;

			$dizin = '../../foto/';
			$yuklenecek_dosya = $dizin .$benzersizad. basename($_FILES['dosya']['name']);

			if (move_uploaded_file($_FILES['dosya']['tmp_name'], $yuklenecek_dosya))
			{
				$id=$_SESSION['kullanici_id'];

				$kullanici_fotoyol="/".$benzersizad.$name;
				$fotokaydet=$db->prepare("UPDATE kullanici SET 

					kullanici_foto=:kullanici_foto

					WHERE kullanici_id=$id");
				$update=$fotokaydet->execute(array(

					'kullanici_foto' => $kullanici_fotoyol,

				));
				if($update){
					Header("Location:../../profil.php");
					exit();
				}else{
					Header("Location:../../profil.php?durum=no");
					exit();
				}

			} else {
				Header("Location:../../profil.php?durum=no");
				exit();
			}

		}
	}
}

switch ($_POST['profilgüncelle']) {

	case 'bio':

	$sayackelime=0;
	$i=0;
	$metin=$_POST['kullanici_bio'];
	$dizi=explode(" ",$metin);
	$uzunluk=strlen($metin);
 $fh = fopen("yasakkelimeler.txt","r"); //aciyoruz ve okuma yaptırıyoruz 
 while($ddd = fgets($fh,900)) { 
 	for ($j=0; $j < $uzunluk ; $j++) { 

 		if (trim($ddd)==trim($dizi[$j])) {
 			$sayackelime=$sayackelime+1;

 		}
 	}
 }

 if ($sayackelime==0) {
 	$id=$_SESSION['kullanici_id'];
 	$guncelle=$db->prepare("UPDATE kullanici SET 
 		kullanici_bio=:kullanici_bio
 		WHERE kullanici_id=$id");
 	$update=$guncelle->execute(array(
 		'kullanici_bio' => $metin,
 	));
 	if($update){
 		Header("Location:../../profil.php");
 		exit();
 	}else{
 		Header("Location:../../profil.php?durum=no");
 		exit();
 	}
 	break;
 }
 else{
 	Header("Location:../../profil.php?durum=no");
 	exit();
 	break;
 }


 case 'genel':


 $id=$_SESSION['kullanici_id'];
 $guncelle=$db->prepare("UPDATE kullanici SET 
 	kullanici_ad=:kullanici_ad,
 	kullanici_soyad=:kullanici_soyad,
 	kullanici_mail=:kullanici_mail,
 	kullanici_gsm=:kullanici_gsm,
 	kullanici_il=:kullanici_il,
 	kullanici_ilce=:kullanici_ilce,
 	kullanici_adres=:kullanici_adres
 	WHERE kullanici_id=$id");
 $update=$guncelle->execute(array(
 	'kullanici_ad' => $_POST['kullanici_ad'],
 	'kullanici_soyad' => $_POST['kullanici_soyad'],
 	'kullanici_mail' => $_POST['kullanici_mail'],
 	'kullanici_gsm' => $_POST['kullanici_gsm'],
 	'kullanici_il' => $_POST['kullanici_il'],
 	'kullanici_ilce' => $_POST['kullanici_ilce'],
 	'kullanici_adres' => $_POST['kullanici_adres'],
 ));
 if($update){
 	Header("Location:../../profil.php");
 	exit();
 }else{
 	Header("Location:../../profil.php?durum=no");
 	exit();

 }

 break;

 case 'uptegitim':
 $id=$_SESSION['kullanici_id'];
 $guncelle=$db->prepare("UPDATE kullanici SET 
 	kullanici_univ=:kullanici_univ,
 	kullanici_bolum=:kullanici_bolum,
 	kullanici_derece=:kullanici_derece

 	WHERE kullanici_id=$id");
 $update=$guncelle->execute(array(
 	'kullanici_univ' => $_POST['kullanici_univ'],
 	'kullanici_bolum' => $_POST['kullanici_bolum'],
 	'kullanici_derece' => $_POST['kullanici_derece'],

 ));
 if($update){
 	Header("Location:../../profil.php");
 	exit();
 }else{
 	Header("Location:../../profil.php?durum=no");
 	exit();
 }

 break;

 case 'gorev':

 $id=$_SESSION['kullanici_id'];
 $gorev_kategori=$_POST['gorev_kategori'];
 $gorev_baslik=$_POST['gorev_baslik'];
 $gorev_detay=$_POST['gorev_detay'];
 $gorev_bitTarih=$_POST['gorev_bitTarih']; 
 $gorev_il=$_POST['gorev_il'];
 $gorev_butce=$_POST['gorev_butce']; 
 $gorev_ek=$kullanici_fotoyol; 

 if (!empty($_FILES)) {

 	$hata = $_FILES['gorev_ek']['error'];

 	if($hata != 0) {

 		$ekle=$db -> prepare("INSERT INTO gorev (veren_id,gorev_kategori,gorev_baslik,gorev_detay
 			,gorev_il,gorev_bitTarih,gorev_butce) 

 			VALUES ( '$id' ,'$gorev_kategori','$gorev_baslik','$gorev_detay','$gorev_il','$gorev_bitTarih','$gorev_butce')");
 		$gorevekle=$ekle -> execute(array(
 		));

 		if ($gorevekle) {
 			Header("Location:../../profil.php");
 			exit();

 		}	
 		else {
 			Header("Location:../../profil.php?durum=no");
 			exit();
 		}

 	} else {

 		$filename = $_FILES['gorev_ek']["name"];
 		$rndsayi1=rand(20000,32000);
 		$rndsayi2=rand(20000,32000);
 		$rndad=$rndsayi1.$rndsayi2;

 		$yol = '../../foto/';
 		$path = $yol .$rndad. basename($_FILES['gorev_ek']['name']);

 		if (move_uploaded_file($_FILES['gorev_ek']['tmp_name'], $path))
 		{

 			$gorev_dosya="/".$rndad.$filename;

 			$ekle=$db -> prepare("INSERT INTO gorev (veren_id,gorev_kategori,gorev_baslik,gorev_detay
 				,gorev_il,gorev_ek,gorev_bitTarih,gorev_butce) 

 				VALUES ( '$id' ,'$gorev_kategori','$gorev_baslik','$gorev_detay','$gorev_il','$gorev_dosya','$gorev_bitTarih','$gorev_butce')");
 			$gorevekle=$ekle -> execute(array(
 			));

 			if ($gorevekle) {
 				Header("Location:../../profil.php");
 				exit();

 			}	
 			else {
 				Header("Location:../../profil.php?durum=no");
 				exit();
 			}

 		}

 	}
 }
 
 break;

 case 'uptpass':
 $id=$_SESSION['kullanici_id'];

 $kontrol=$db -> prepare("SELECT kullanici_password from kullanici where kullanici_id=:id");
 $sonuc=$kontrol -> execute(array('id' => $id
));
 $kontrolcek=$kontrol->fetch(PDO::FETCH_ASSOC);

 if ($_POST['new_password']==$_POST['new_password_t'] && md5($_POST['old_password']) == $kontrolcek['kullanici_password'] ) {


 	$guncelle=$db->prepare("UPDATE kullanici SET 
 		kullanici_password=:kullanici_password


 		WHERE kullanici_id=$id");
 	$update=$guncelle->execute(array(
 		'kullanici_password' => md5($_POST['new_password']),

 	));
 	if($update){
 		Header("Location:../../profil.php");
 		exit();
 	}else{
 		Header("Location:../../profil.php?durum=no");
 		exit();
 	}
 	
 }
 else{

 	Header("Location:../../profil.php?durum=eror");
 	exit();
 }
 
 break;
}

?>

