	<?php  
	include 'header.php'; 
	?>
	<div class="container">
		
		<div class="main-slide">
			<div id="sync1" class="owl-carousel">
				<?php 

				while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) 
					{?>
						<div class="item">
							<div class="slide-desc">
								<div class="inner">

									<div class="productwrapbb">
										
											<h1>
												
												<?php echo $kullanicicek['kullanici_ad'] ?> <?php echo $kullanicicek['kullanici_soyad'] ?> </h1> 
											
										</div>
										<p> 
											<div class="productwrapaa">
												<span class="smalltitle3" >
													<b><?php echo $kullanicicek['kullanici_bio'] ?></b>

													
												</span>
											</div>
										</p>



									</div>

								</div>
								<div class="slide-type-1">
									<img  src="foto<?php echo  $kullanicicek['kullanici_foto'] ?> "alt="" style="width: 250px ; height: 250px" class="avatar img-circle img-thumbnail">

								</div>
							</div>
							<?php 
						}
						?>

					</div>
				</div>
			</div>



			<div class="f-widget featpro">
				<div class="container">
					<div class="title-widget-bg">
						<div class="title-widget">KATEGORİLER</div>
						<div class="carousel-nav">
							<a class="prev"></a>
							<a class="next"></a>
						</div>
					</div>
					<div id="product-carousel" class="owl-carousel owl-theme">
						<?php 
						while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) 
							{?>
								<div class="item">
									<div class="productwrap">
										<div class="pr-img">

											<a href="product.htm"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>

										</div>
										<span class="smalltitle"><a href="product.htm"><?php echo  $kategoricek['kategori_ad'] ?></a> </span>

									</div>
								</div>
								<?php 
							}
							?>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="row">
						<div class="col-md-12"><!--Main content-->
							<div class="title-bg">
								<div class="title">Görevler</div>
							</div>
							<div class="row prdct"><!--Products-->
								<?php 
								while($gorevcek=$gorevsor->fetch(PDO::FETCH_ASSOC)) 
									{?>
										<div class="col-md-4">
											<div class="productwrap">
												<span 

												;class="smalltitle2"><a href="product.htm"><?php echo  $gorevcek['gorev_baslik'] ?></a> </span>
												<br>
												<span class="smalltitle2"><a href="product.htm"><?php echo  $gorevcek['gorev_detay'] ?></a> </span>
											</div>
										</div>
										<?php 
									}
									?>
								</div><!--Products-->
								<div class="spacer"></div>
							</div><!--Main content-->

						</div>
					</div>

					<?php include 'footer.php'; ?>