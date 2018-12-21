	<?php  
	include 'header.php'; 
	include 'nedmin/netting/baglan.php';
	

	if (isset($_POST['arama'])) {
		date_default_timezone_set('Europe/Istanbul');
		$tarih2= date('Y-m-d');

		$aranan=trim($_POST['aranan']);


		

		$gorevaramabastar=$db->prepare("SELECT * FROM gorev where  gorev_baslik like '%$aranan%' and gorev_bitTarih >=:tarih ");
		$gorevaramabastar->execute(array(
			
			'tarih'=> $tarih2

		));

		$gorevaramabittar=$db->prepare("SELECT * FROM gorev where gorev_baslik  like '%$aranan%' and gorev_bitTarih <=:tarih ");
		$gorevaramabittar->execute(array(

			'tarih'=> $tarih2

		));

	}


	?>

	<div class="container">
		<div class="row">
			<div class="col-md-12"><!--Main content-->
				
				<div class="col-md-3"><!--Main content-->
					<div class="title" style="">
						<font face="Times New Roman">
							<center><br>
								<div class="title">KATEGORİLER</div></center></font>
							</div>
							<div class="categorybox">
								<ul>
									<?php 
									while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) 
										{?>
											<li class="lastone"><a href="gorevler-<?=($kategoricek["kategori_id"])?>"><?php echo  $kategoricek['kategori_ad'] ?></a></li>
											<?php 
										}
										?>

									</ul>
								</div>
							</div>

							<div id="task-container" class="col-lg-9">
								<div class="col-md-auto p-2 bg-c2 align-self-center">
									<form action="arama.php" method="POST">
										<p align="right">
											<font face="Times New Roman">
												<br>
												<input type="text" name="aranan" placeholder="Görev yaz" size="65">
												<input type="submit" name="arama" value="ARA">

											</p>

										</div>
									</form>
									<div class="title" style="">
										<font face="Times New Roman">
											<center>
												<div class="title"><b>Aktif Görevler</b></div></center></font>
												<br>
											</div>

											<div class="row prdct"><!--Products-->
												<?php 

												 $sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.
												 $sorgu=$db->prepare("SELECT * FROM gorev");
												 $sorgu->execute();
												 $toplam_icerik=$sorgu->rowCount();
												 $toplam_sayfa = ceil($toplam_icerik / $sayfada);
												 $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
												 if($sayfa < 1) $sayfa = 1; 
												 if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
												 $limit = ($sayfa - 1) * $sayfada;

												 

												 

												 while($gorevkategoricekbastar=$gorevaramabastar->fetch(PDO::FETCH_ASSOC)) 
												 	{?>
												 		<div class="col-md-4">
												 			<div class="productwrapg">

												 				<font face="Times New Roman">
												 					<span class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevkategoricekbastar['gorev_butce'] ?>,00 ₺</a> </span></font>



												 					<font face="Times New Roman">
												 						<span class="smalltitle21"><a href="product.htm" style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevkategoricekbastar['gorev_baslik'] ?></a> </span></font>

												 						<font face="Times New Roman">
												 							<span ;class="smalltitle21"><a  href="product.htm" style="font-size:17px;color:#343a40"><br><br><?php echo  substr($gorevkategoricekbastar['gorev_detay'] , 0, 100)?>...</a> </span></font>

												 							<font face="Times New Roman">
												 								<span class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:13px;font-weight: bold;position: absolute;bottom:10%;" >Bitiş Tarihi :  <?php echo  $gorevkategoricekbastar['gorev_bitTarih'] ?></a> </span></font>


												 							</div>

												 						</div>
												 						<?php 
												 					}
												 					?>
												 				</div>
												 				<div align="right" class="col-md-12">
												 					<ul class="pagination">

												 						<?php

												 						$s=0;

												 						while ($s < $toplam_sayfa) {

												 							$s++; ?>

												 							<?php 

												 							if ($s==$sayfa) {?>

												 								<li class="active">

												 									<a href="gorevler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

												 								</li>

												 							<?php } else {?>


												 								<li>

												 									<a href="gorevler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

												 								</li>

												 							<?php   }

												 						}

												 						?>

												 					</ul>
												 				</div>

												 				<div class="title" style="">
												 					<font face="Times New Roman">
												 						<center>
												 							<div class="title"><br> <b>Bu Ayda Yapılan Görevler</b></div></center></font>
												 							<br>
												 						</div>

												 						<div class="row prdct"><!--Products-->
												 							<?php 

												 $sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.
												 $sorgu=$db->prepare("SELECT * FROM gorev");
												 $sorgu->execute();
												 $toplam_icerik=$sorgu->rowCount();
												 $toplam_sayfa = ceil($toplam_icerik / $sayfada);
												 $sayfa = isset($_GET['sayfa1']) ? (int) $_GET['sayfa1'] : 1;
												 if($sayfa < 1) $sayfa = 1; 
												 if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
												 $limit = ($sayfa - 1) * $sayfada;

												 
												 while($gorevkategoricekbittar=$gorevaramabittar->fetch(PDO::FETCH_ASSOC)) 
												 	{?>
												 		<div class="col-md-4">
												 			<div class="productwrapg">

												 				<font face="Times New Roman">
												 					<span ;class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevkategoricekbittar['gorev_butce'] ?>,00 ₺</a> </span></font>

												 					<font face="Times New Roman">
												 						<span ;class="smalltitle21"><a href="product.htm" style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevkategoricekbittar['gorev_baslik'] ?></a> </span></font>


												 						<font face="Times New Roman">
												 							<span ;class="smalltitle21"><a  href="product.htm" style="font-size:17px;color:#343a40"><br><br><?php echo  substr($gorevkategoricekbittar['gorev_detay'] , 0, 100)?>...</a> </span></font>

												 							<font face="Times New Roman">
												 								<span class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:13px;font-weight: bold;position: absolute;bottom:10%;" >Bitiş Tarihi :  <?php echo  $gorevkategoricekbittar['gorev_bitTarih'] ?></a> </span></font>







												 							</div>
												 						</div>
												 						<?php 
												 					}
												 					?>

												 				</div>

												 				<div align="right" class="col-md-12">
												 					<ul class="pagination">

												 						<?php

												 						$s=0;

												 						while ($s < $toplam_sayfa) {

												 							$s++; ?>

												 							<?php 

												 							if ($s==$sayfa) {?>

												 								<li class="active">

												 									<a href="gorevler?sayfa1=<?php echo $s; ?>"><?php echo $s; ?></a>

												 								</li>

												 							<?php } else {?>


												 								<li>

												 									<a href="gorevler?sayfa1=<?php echo $s; ?>"><?php echo $s; ?></a>

												 								</li>

												 							<?php   }

												 						}

												 						?>

												 					</ul>
												 				</div>

												 			</div><!--Products-->
												 			<div class="spacer"></div>
												 		</div><!--Main content-->

												 	</div>
												 </div>
												 <br>
												 <br>
												 <br>
												 <?php include 'footer.php'; ?>