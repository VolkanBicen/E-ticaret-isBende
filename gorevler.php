	<?php  
	include 'header.php';
	date_default_timezone_set('Europe/Istanbul');
	$tarih= date('Y-m-d');
	
	if (isset($_GET['sef'])) {
		date_default_timezone_set('Europe/Istanbul');
		$tarih1= date('Y-m-d');
		$kategorigorevsor=$db->prepare("SELECT * FROM kategori where kategori_id=:id");
		$kategorigorevsor->execute(array(
			'id' => $_GET['sef']
		));
		$kategorgorevicek=$kategorigorevsor->fetch(PDO::FETCH_ASSOC);
		$kategori_ad=$kategorgorevicek['kategori_id'];

		$gorevkategorisorbastar=$db->prepare("SELECT * FROM gorev where gorev_kategori=:gorev_kategori and gorev_bitTarih >=:tarih ");
		$gorevkategorisorbastar->execute(array(
			'gorev_kategori' => $kategori_ad,
			'tarih'=> $tarih1

		));
		$gorevkategorisorbittar=$db->prepare("SELECT * FROM gorev where gorev_kategori=:gorev_kategori and gorev_bitTarih <=:tarih ");
		$gorevkategorisorbittar->execute(array(
			'gorev_kategori' => $kategori_ad,
			'tarih'=> $tarih1
		));




	}else{
		date_default_timezone_set('Europe/Istanbul');
		$tarih= date('Y-m-d');
		$gorevkategorisorbastar=$db->prepare("SELECT * FROM gorev where gorev_bitTarih >=:tarih ");
		$gorevkategorisorbastar->execute(array(
			'tarih'=> $tarih
		));
		$gorevkategorisorbittar=$db->prepare("SELECT * FROM gorev where gorev_bitTarih <=:tarih ");
		$gorevkategorisorbittar->execute(array(
			'tarih'=> $tarih
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
									<p align="right">
										<font face="Times New Roman">
											<br>
											<input type="text" placeholder="Görev yaz" size="65">
											<input type="submit" value="ARA">

											<button class="btn btn-c2" href="/gorev/yukle" style="font-weight: "><i class="fas fa-thumbtack" ></i> Görev İlanı Yükle</button></font>

										</p>
									</div>

									<div class="title" style="">
										<font face="Times New Roman">
											<center>
												<div class="title"><b>Aktif Görevler</b></div></center></font>
												<br>
											</div>
											<div class="row prdct"><!--Products-->
												<?php 
												while($gorevkategoricekbastar=$gorevkategorisorbastar->fetch(PDO::FETCH_ASSOC)) 
													{?>
														<div class="col-md-4">
															<div class="productwrapg">

																<font face="Times New Roman">
																	<span class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevkategoricekbastar['gorev_butce'] ?>,00 ₺</a> </span></font>



																	<font face="Times New Roman">
																		<span class="smalltitle21"><a href="product.htm" style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevkategoricekbastar['gorev_baslik'] ?></a> </span></font>

																		<font face="Times New Roman">
																			<span ;class="smalltitle21"><a  href="product.htm" style="font-size:17px;color:#343a40"><br><?php echo  substr($gorevkategoricekbastar['gorev_detay'] , 0, 100)?>...</a> </span></font>

																			<font face="Times New Roman">
																				<span class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:13px;font-weight: bold;position: absolute;bottom:10%;" >Bitiş Tarihi :  <?php echo  $gorevkategoricekbastar['gorev_bitTarih'] ?></a> </span></font>


																			</div>

																		</div>
																		<?php 
																	}
																	?>
																</div>
																<div class="row">
																	<div class="col-lg-12 text-center">
																		<button class="btn btn-light border border-dark" data-len="6" data-loadmore="/ajax/loadmore/finishedtask" data-target="#finish-task-list-container" data-page="2">Daha Fazla Göster</button>
																	</div>
																</div>
																<div class="title" style="">
																	<font face="Times New Roman">
																		<center>
																			<div class="title"><br> <b>Bu Ayda Yapılan Görevler</b></div></center></font>
																			<br>
																		</div>

																		<div class="row prdct"><!--Products-->
																			<?php 
																			while($gorevkategoricekbittar=$gorevkategorisorbittar->fetch(PDO::FETCH_ASSOC)) 
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

																							<div class="row">
																								<div class="col-lg-12 text-center">
																									<button class="btn btn-light border border-dark" data-len="6" data-loadmore="/ajax/loadmore/finishedtask" data-target="#finish-task-list-container" data-page="2">Daha Fazla Göster</button>
																								</div>
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