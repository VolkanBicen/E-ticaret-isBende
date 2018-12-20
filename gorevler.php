	<?php  
	include 'header.php';
	date_default_timezone_set('Europe/Istanbul');
	$tarih= date('Y-m-d');
	$gorevtarihsor=$db->prepare("SELECT * FROM gorev where gorev_bitTarih >:tarih ");
	$gorevtarihsor->execute(array(
		'tarih'=> $tarih
	));

	$gorevtarihbitsor=$db->prepare("SELECT * FROM gorev where gorev_bitTarih <:tarih ");
	$gorevtarihbitsor->execute(array(
		'tarih'=> $tarih
	));
	
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
											<li class="lastone"><a href="category.htm"><b><?php echo  $kategoricek['kategori_ad'] ?></b> </a></li>
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
												while($gorevtarihcek=$gorevtarihsor->fetch(PDO::FETCH_ASSOC)) 
													{?>
														<div class="col-md-4">
															<div class="productwrapg">
																<font face="Times New Roman">
																	<span ;class="smalltitle21" ><a href="teklif.php?id=<?php echo $gorevtarihcek['gorev_id']?>" style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevtarihcek['gorev_butce'] ?>,00 ₺</a> </span></font>

																	<font face="Times New Roman">
																		<span ;class="smalltitle21"><a href="teklif.php?id=<?php echo $gorevtarihcek['gorev_id']?>" style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevtarihcek['gorev_baslik'] ?></a> </span></font>
																		<font face="Times New Roman">
																			<span ;class="smalltitle21"><a  href="teklif.php?id=<?php echo $gorevtarihcek['gorev_id']?>" style="font-size:17px;color:#343a40"><br><br><?php echo  substr($gorevtarihcek['gorev_detay'] , 0, 100)?>...</a> </span></font>
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
																		while($gorevtarihbitcek=$gorevtarihbitsor->fetch(PDO::FETCH_ASSOC)) 
																			{?>
																				<div class="col-md-4">
																					<div class="productwrapg">

																						<font face="Times New Roman">
																							<span ;class="smalltitle21" ><a style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevtarihbitcek['gorev_butce'] ?>,00 ₺</a> </span></font>

																							<font face="Times New Roman">
																								<span ;class="smalltitle21"><a style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevtarihbitcek['gorev_baslik'] ?></a> </span></font>

																								<font face="Times New Roman">
																									<span ;class="smalltitle21"><a  style="font-size:17px;color:#343a40"><br><br><?php echo  substr($gorevtarihbitcek['gorev_detay'] , 0, 80)?>...</a> </span></font>


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