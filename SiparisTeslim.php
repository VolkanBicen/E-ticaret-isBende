<?php include 'header.php';
date_default_timezone_set('Europe/Istanbul');
$tarih= date('Y-m-d');


$gorevyapansor=$db->prepare("SELECT * from gorev,kullanici WHERE gorev_id=38 and gorev.yapan_id=kullanici.kullanici_id");
$gorevyapansor->execute(array(
	
)); 
$gorevyapancek=$gorevyapansor->fetch(PDO::FETCH_ASSOC)
?>
<div class="container">
	<h2>Teklif Sipariş Tablosu</h2>
	<p>Lütfen Teklifinizi onayayınız.</p>

	<div class="col-md-6">
		<ul class="price">
			<li class="header">Görev Detay</li>
			<li class="grey">
				<a href="product.htm" ><?php echo  $gorevyapancek['gorev_baslik'] ?></a> 
			</li>
			<li>
				<?php echo  substr($gorevyapancek['gorev_detay'] , 0, 100)?>...</li>
				<li>

					<font face="Times New Roman">
						<span><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" > <?php echo  $gorevyapancek['gorev_butce'] ?>,00 ₺</a> </span></font></li>
						<li><input type="submit" name="arama" value="Dosya Ek">
							<input type="submit" name="arama" value="Puan Ver">
						</li>
						<li><input type="checkbox" name="vehicle3" value="Boat" checked>Teslim Aldım<br>
						</li>
						<li class="grey"><a href="#" class="button">Sign Up</a></li>
					</ul>
				</div>

				<div class="col-md-6">
					<ul class="price">
						<li class="header" style="background-color:#4CAF50">Geliştirici Bilgileri</li>
						<li class="grey">
							<?php echo  $gorevyapancek['kullanici_ad'] ?><?php echo  $gorevyapancek['kullanici_soyad'] ?>
						</li>
						<li>
							E-Mail : <?php echo  $gorevyapancek['kullanici_mail'] ?>
						</li>
						<li>
							GSM : <?php echo  $gorevyapancek['kullanici_gsm'] ?>
						</li>
						<li>Üviversite : <?php echo  $gorevyapancek['kullanici_univ'] ?> </li>
						<li>
							<input type="checkbox" name="vehicle3" value="Boat" checked>Teslim Ettim<br><br>
							<input type="checkbox" name="vehicle3" value="Boat" checked>Ek Zaman İstiyorum<br>
						</li>
						<li class="grey"><a href="#" class="button">Sign Up</a></li>
					</ul>
				</div>
			</div>
			<?php include 'footer.php' ?>





