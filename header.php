<?php 
include 'nedmin/netting/baglan.php';
ob_start();
session_start();
$kullanicisor=$db-> prepare("SELECT * FROM kullanici order by kullanici_id asc limit 5");
$kullanicisor -> execute(array(
));

$kategorisor=$db-> prepare("SELECT * FROM kategori ");
$kategorisor -> execute(array(
));

$gorevsor=$db-> prepare("SELECT * FROM gorev order by gorev_bitTarih asc limit 9");
$gorevsor -> execute(array(
));

$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda ");
$hakkimizdasor->execute(array(
	
));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);


$ayarsor=$db-> prepare("SELECT * FROM ayar");
$ayarsor -> execute(array(
));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

$kullanicigiris=$db-> prepare("SELECT * FROM kullanici where kullanici_id=:id");
$kullanicigiris->execute(array(
	'id'=> $_SESSION['kullanici_id']
));
$sayac=$kullanicigiris -> rowCount();
$kullanicigiriscek=$kullanicigiris->fetch(PDO :: FETCH_ASSOC);

if (isset($_GET['sef'])) {
		date_default_timezone_set('Europe/Istanbul');
		$tarih1= date('Y-m-d');
		$kategorigorevsor=$db->prepare("SELECT * FROM kategori where kategori_id=:id");
		$kategorigorevsor->execute(array(
			'id' => $_GET['sef']
		));
		$kategorgorevicek=$kategorigorevsor->fetch(PDO::FETCH_ASSOC);
		$kategori_ad=$kategorgorevicek['kategori_id'];

		$gorevkategorisorbastar=$db->prepare("SELECT * FROM gorev where kategori_id=:kategori_id and gorev_bitTarih >=:tarih ");
		$gorevkategorisorbastar->execute(array(
			'kategori_id' => $kategori_id,
			'tarih'=> $tarih1
		));
		$gorevkategorisorbittar=$db->prepare("SELECT * FROM gorev where kategori_id=:kategori_id and gorev_bitTarih <:tarih ");
		$gorevkategorisorbittar->execute(array(
			'kategori_id' => $kategori_id,
			'tarih'=> $tarih1
		));
		
		

	}else{
		date_default_timezone_set('Europe/Istanbul');
		$tarih= date('Y-m-d');
		$gorevkategorisorbastar=$db->prepare("SELECT * FROM gorev where gorev_bitTarih >=:tarih ");
		$gorevkategorisorbastar->execute(array(
			'tarih'=> $tarih
		));

		$gorevkategorisorbittar=$db->prepare("SELECT * FROM gorev where gorev_bitTarih <:tarih ");
		$gorevkategorisorbittar->execute(array(
			'tarih'=> $tarih
		));
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>İş Bende</title>

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='font-awesome\css\font-awesome.css' rel="stylesheet" type="text/css">
	<!-- Bootstrap -->
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
	
	<!-- Main Style -->
	<link rel="stylesheet" href="style.css?">
	
	<!-- owl Style -->
	<link rel="stylesheet" href="css\owl.carousel.css">
	<link rel="stylesheet" href="css\owl.transitions.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</head>
<body>
	<div id="wrapper">
		<div class="header"><!--Header -->
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-md-4 main-logo">
						<a href="index.php"><img src="images\logo.png" alt="logo" class="logo img-responsive"></a>

					</div>

					<div class="col-md-8">

						<div class="pushright">
							<div class="top">
								<?php if($_GET['mailonay']=="false" || $_GET['durum']=="bekleonay"){?>
									<a  class="btn btn-default btn-dark">Mail Onay Bekleniyor<span></a>
									<?php } 
									elseif($_GET['mailonay']=="fault"){?>
										<a href="#" id="reg" class="btn btn-default btn-dark">Böyle bir mail bulunamadı<span></a>
										<?php } 

										else {?>


											<?php if(!isset($_SESSION['kullanici_id'])){?>
												<a href="#" id="reg" class="btn btn-default btn-dark">Giriş Yap<span>-- yada --</span>Kayıt Ol</a>
											<?php } 
											else {?>
												<a href="profil.php" class="btn btn-default btn-dark"><?php echo
												$kullanicigiriscek['kullanici_ad']?><span> </span><?php echo
												$kullanicigiriscek['kullanici_soyad'] ?></a>
												<a href="logout.php" name="logout" title="Logout" class="btn btn-default btn-dark">Çıkış</a>

											<?php } ?>
										<?php } ?>

										<div class="regwrap" id="a">
											<div class="row">
												<div class="col-md-6 regform">
													<div class="title-widget-bg">
														<div class="title-widget">Giriş Yap</div>
													</div>
													<form action="nedmin/netting/islem.php" method="POST" role="form">
														<div class="form-group">
															<input type="text" class="form-control" name="kullanici_mail" id="username" placeholder="Kullanıcı Adınız(Mail Adresiniz)">
														</div>
														<div class="form-group">
															<input type="password" class="form-control" 
															name="kullanici_password" id="password" placeholder="Şifreniz">
														</div>
														<div>
															<img src="guvenlik.php" alt=""/>
															<br><br>
														</div>
														<div>
															<input class="form-control" type="text" name="guvenlik_kod" autocomplete="off" placeholder="Güvenlik Kodunu Giriniz.">
														</div><br>
														<div class="form-group">
															<button type="submit" name="kullanicigiris" class="btn btn-default btn-red btn-sm">Giriş</button>
														</div>
														<p class="change_link">
															<?php 
															if ($_GET['durum']=="no") {

																?>

																<b style="color:red;">Kullanıcı bulunamadı</b>

																<?php 

															} elseif ($_GET['durum']=="exit") {

																?>

																<b style="color:green;">Başarıyla çıkış yaptınız</b>

																<?php 

															}
															elseif ($_GET['durum']=="eror") {
																?>

																<b style="color:red;">Güvenlik kodu hatalı</b>

																<?php 

															}

															?>

														</p>

													</form>
												</div>
												<div class="col-md-6">
													<div class="title-widget-bg">
														<div class="title-widget">Kayıt Ol</div>
													</div>
													<p>
														Kayıt OL
													</p>
													<a href="register"><button class="btn btn-default btn-yellow">Şimdi Kayıt Ol</button></a>
													<button  class="btn btn-default btn-yellow" data-toggle="modal" data-target="#sifremiunuttum" type="submit" name="musterigiris" onclick="on()">Şifremi Unuttum</button>

												</div>
											</div>
										</div>


									</div>
								</div>
								<div class="col-sm-8 col-sm-pull-2">
									<ul class="small-menu"><!--small-nav -->

										<li><a href="gorevler.php" class="mychart">Görevler</a></li>
										<li><a  href="hakkimizda.php"  class="mychart" >Hakkımızda</a></li>
										<li><a href="iletisim.php" class="mychart">İletişim</a></li>

									</ul><!--small-nav -->	
								</div>
							</div>
						</div>
					</div>
					<div class="dashed"></div>

				</div><!--Header -->
				<!-- Modal Başlangıç -->


				<div class="modal fade" id="sifremiunuttum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="exampleModalLabel">Şifre Sıfırlama</h4>

							</div>
							<div class="modal-body">
								<form action="sifremi_unuttum.php" method="POST">
									<div class="form-group">
										<p><b>Uyarı:</b> Girdiğiniz mail adresi kayıtlarımızda varsa şifreniz mail adresinize gönderilecektir.</p>
									</div>
									<div class="form-group">
										<label for="recipient-name" class="col-form-label">Mail Adresiniz:</label>
										<input type="email" class="form-control" name="kullanici_mail" id="recipient-name">	
									</div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="off()">Kapat</button>
									<button type="submit" name="sifremiunuttum1" class="btn btn-primary">Şifre Talep Et</button>
									<?php 
									if ($_GET['durum']=="kullaniciyok") {

										?>
										<?php 
										$mm        = "Kullanıcı Bulunamdı";
										$mesaj     = "<script>alert('$mm')</script>";
										echo $mesaj;
										?>

										<?php 

									} elseif ($_GET['durum']=="basarili") {

										?>

										<?php 
										$mm        = "Şifre Talebiniz Alınmıştır Lütfen Mailinizi Kontrol Ediniz.";
										$mesaj     = "<script>alert('$mm')</script>";
										echo $mesaj;
										?>

										<?php 

									}
									elseif ($_GET['durum']=="Şifre Talebiniz Başarısız Oldu. Lütfen Tekrar Deneyiniz..!!!") {
										?>

										<?php 
										$mm        = "Kullanıcı Bulunamdı";
										$mesaj     = "<script>alert('$mm')</script>";
										echo $mesaj;
										?>

										<?php 

									}

									?>

								</form>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">


					function on(){
						document.getElementById("a").style.display = "none";
					}
					function off(){
						document.getElementById("a").style.display = "block";
					}

				</script>
<!-- Modal Bitiş -->