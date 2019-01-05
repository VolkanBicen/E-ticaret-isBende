	<?php  
	include 'header.php'; 
	include 'nedmin/netting/baglan.php';
	

	if (isset($_POST['arama'])) {
		date_default_timezone_set('Europe/Istanbul');
		$tarih2= date('Y-m-d');

		 $aranan=trim($_POST['aranan']);


		

		$gorevkategoribastararamasor=$db->prepare("SELECT * FROM gorev where gorev_baslik like '%$aranan%' and gorev_bitTarih >=:tarih");
		$gorevkategoribastararamasor->execute(array(
			'tarih'=> $tarih2
		));


		$gorevkategoribittararamasor=$db->prepare("SELECT * FROM gorev where gorev_baslik like '%$aranan%' and gorev_bitTarih <:tarih");
		$gorevkategoribittararamasor->execute(array(
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
											<li class="lastone"><a href="gorevler-<?=($kategoricek["kategori_ad"])?>"><?php echo  $kategoricek['kategori_ad'] ?></a></li>
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
												while($gorevkategoribastararamacek=$gorevkategoribastararamasor->fetch(PDO::FETCH_ASSOC)) 
													{?>
														<div class="col-md-4">
															<div class="productwrapg">

																<font face="Times New Roman">
																	<span ;class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevkategoribastararamacek['gorev_butce'] ?>,00 ₺</a> </span></font>
																	


																	<font face="Times New Roman">
																		<span ;class="smalltitle21"><a href="product.htm" style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevkategoribastararamacek['gorev_baslik'] ?></a> </span></font>

																		<font face="Times New Roman">
																			<span ;class="smalltitle21"><a  href="product.htm" style="font-size:17px;color:#343a40"><br><br><?php echo  substr($gorevkategoribastararamacek['gorev_detay'] , 0, 100)?>...</a> </span></font>


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
																		while($gorevkategoribittararamacek=$gorevkategoribittararamasor->fetch(PDO::FETCH_ASSOC)) 
																			{?>
																				<div class="col-md-4">
																					<div class="productwrapg">

																						<font face="Times New Roman">
																							<span ;class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevkategoribittararamacek['gorev_butce'] ?>,00 ₺</a> </span></font>

																							<font face="Times New Roman">
																								<span ;class="smalltitle21"><a href="product.htm" style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevkategoribittararamacek['gorev_baslik'] ?></a> </span></font>

																								<font face="Times New Roman">
																									<span ;class="smalltitle21"><a  href="product.htm" style="font-size:17px;color:#343a40"><br><br><?php echo  substr($gorevkategoribittararamacek['gorev_detay'] , 0, 100)?>...</a> </span></font>


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