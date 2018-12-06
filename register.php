<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Kullanıcı Kaydı</div>
							<p >Kullanıcı kayıt işlemlerini aşağıda ki form aracılığı ile gerçekleştirebilirsiniz.</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<form action="nedmin/netting/islem.php" method="POST" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title">Kayıt Bilgileri</div>
				</div>

				<?php 

				if ($_GET['durum']=="farklisifre") {?>

					<div class="alert alert-danger">
						<strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
					</div>
					
				<?php } elseif ($_GET['durum']=="eksiksifre") {?>

					<div class="alert alert-danger">
						<strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
					</div>
					
				<?php } elseif ($_GET['durum']=="mukerrerkayit") {?>

					<div class="alert alert-danger">
						<strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
					</div>
					
				<?php } elseif ($_GET['durum']=="basarisiz") { ?>

					<div class="alert alert-danger">
						<strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
					</div>
					
				<?php }
				?>


				


				
					<div class="form-group">
						<div class="col-sm-12">
							<input type="text" class="form-control" required="" name="kullanici_ad"  placeholder="Ad Giriniz">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="text" class="form-control"  required="" name="kullanici_soyad" placeholder="Soyadınızı Giriniz...">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="email" class="form-control"  required="" name="kullanici_mail" placeholder="Mail Giriniz...">
						</div>
					</div>
				
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" pattern="\d{11}" class="form-control"  required="" name="kullanici_gsm" placeholder="Telefon Numarası Giriniz...">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-6">
						<input type="password" minlength="6" ="" class="form-control" name="kullanici_passwordone"    placeholder="Şifrenizi Giriniz...">
					</div>
					<div class="col-sm-6">
						<input type="password" minlength="6" class="form-control" name="kullanici_passwordtwo"   placeholder="Şifrenizi Tekrar Giriniz...">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="kullanici_il" placeholder="İl Giriniz...">
					</div>
				</div>
				

				<button type="submit" name="kullanicikaydet" class="btn btn-default btn-red">Kayıt İşlemini Yap</button>
			</div>
			
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title"></div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="kullanici_ilce" placeholder="İlçe Giriniz...">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="kullanici_adres" placeholder="Adres Giriniz...">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="kullanici_univ" placeholder="Üniversite Giriniz...">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" class="form-control"  required="" name="kullanici_bolum" placeholder="Bölüm Giriniz...">
					</div>
				</div>

			<div class="form-group">
					<div class="col-sm-12">
						<input type="text"  class="form-control"  required="" name="kullanici_derece" placeholder="Derece Giriniz...">
					</div>
				</div>
				
			</div>
		</div>
	</div>
</form>
<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>