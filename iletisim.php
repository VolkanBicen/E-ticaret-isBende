<?php include 'header.php' ?>

<div class="container">
	
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">
		
	</div>

	
	<div class="title-bg">
		<div class="title">Bize Ulaş</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<p class="page-content">
				Bize aşağıdaki bilgilerden ulaşabilirsiniz yada  form maili kullanabilirsiniz.
			</p>
			<ul class="contact-widget">
				<li class="fphone"><?php echo  $ayarcek['ayar_tel'] ?></li>
				<li class="fmobile"><?php echo  $ayarcek['ayar_gsm'] ?></li>
				<li class="fmail lastone"><?php echo  $ayarcek['ayar_mail'] ?></li>
			</ul>
		</div>
		<div class="col-md-7 col-md-offset-1">
			
			<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
			<div id="googlemaps" class="google-map google-map-footer">
				
				<iframe
				width="400"
				height="300"
				frameborder="0" style="border:0"
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3114.5906013406466!2d39.19389431483517!3d38.68127587960452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4076c0453873446b%3A0x8944e73c644c7182!2sF%C4%B1rat+%C3%9Cniversitesi%2C+Teknoloji+Fak%C3%BCltesi!5e0!3m2!1str!2str!4v1543968443687" allowfullscreen>
			</iframe>

		</div>
	</div>
</div>

<div class="title-bg">
	<div class="title">İletişim Formu</div>

</div>
	 <?php 

              if ($_GET['durum']=="mailbasarili") {?>

                <b style="color:green;">İşlem Başarılı</b>

              <?php } 
              elseif ( $_GET['durum']=="mailbasarisiz") { ?>

                <b style="color:green;">İşlem Başarısız</b>

              <?php
              }

              ?>
<div class="qc">
	<form action="gmail-smtp.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

		
		<div class="form-group">
			<label for="name">Ad Soyad<span>*</span></label>
			<input type="text" name="adsoyad" class="form-control" id="adsoyad">
		</div>
		<div class="form-group">
			<label for="email">Mail<span>*</span></label>
			<input type="email" name="email" class="form-control" id="email">
		</div>
		<div class="form-group">
			<label for="text">Mesaj<span>*</span></label>
			<textarea name="mesaj" class="form-control" id="mesaj"></textarea>
		</div>

		
		<button type="submit" name="mailgonder" class="btn btn-default btn-red btn-sm">Formu Gönder</button>
	</form>
</div>
<div class="spacer"></div>

</div>

<?php include 'footer.php' ?>





