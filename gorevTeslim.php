<?php include 'header.php';
date_default_timezone_set('Europe/Istanbul');
$tarih= date('Y-m-d');
$gorevsor=$db-> prepare("SELECT * FROM gorev where gorev_id=:id");
$gorevsor -> execute(array(
	'id' => $_GET['id']
));

$gorevcek=$gorevsor->fetch(PDO::FETCH_ASSOC);

$gorevyapansor=$db->prepare("SELECT * from gorev,kullanici WHERE gorev_id=:id and gorev.yapan_id=kullanici.kullanici_id ");
$gorevyapansor->execute(array(
	'id' => $_GET['id']
	
)); 
$gorevyapancek=$gorevyapansor->fetch(PDO::FETCH_ASSOC)
?>
<div class="container">
	<form action="nedmin/netting/islem.php" method="POST"  enctype="multipart/form-data">
		<h2>Teklif Sipariş Tablosu</h2>
		<p>Lütfen Teklifinizi onayayınız.</p>

		<div class="col-md-6">
			<ul class="pricemus">
				<li class="headermus">Görev Detay</li>
				<li class="greymus">
					<a href="product.htm" ><?php echo  $gorevyapancek['gorev_baslik'] ?></a> 
				</li>
				<li>
					<?php echo ($gorevyapancek['gorev_detay'])?></li>
					<li>

						<font face="Times New Roman">
							<span><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" > <?php echo  $gorevyapancek['gorev_butce'] ?>,00 ₺</a> </span></font></li>
							<font face="Times New Roman">
								<span ><a href="" style="color:ForestGreen;font-size:20px;font-weight: bold;bottom:10%;" >Bitiş Tarihi :  <?php echo  $gorevyapancek['gorev_bitTarih'] ?></a> </span></font><br><br><br>
								<?php

								if (isset($gorevcek['gorev_ek'])) {?>

									<input type="hidden" name="gorev_ek" value="<?php echo $gorevcek['gorev_ek']?>">
									<input type="hidden" name="gorev_baslik" value="<?php echo  $gorevcek['gorev_baslik'] ?>">


									<button class="btn btn-lg btn-success" name="download"  type="submit" style="size: 10px"><i class="glyphicon glyphicon-ok-sign"></i> Görev Dosyasını İndir </button>

								<?php } ?>
								<?php 
								if ($gorevcek['veren_id'] == $_SESSION['kullanici_id'] and $gorevcek['puandurumu']==0 ){?>


									<li>
										<input type="hidden" name="kullanici_id" value="<?php echo $gorevyapancek['kullanici_id']?>">
										<input type="hidden" name="gorev_id" value="<?php echo $gorevyapancek['gorev_id']?>">
										<input type="text" class="form-control" name="puan" id="first_name" pattern="[0-9]" ><br>
										<button class="btn btn-lg btn-success" name="puanver"  type="submit" style="size: 10px"><i class="glyphicon glyphicon-ok-sign"></i>Puan ver </button>

									</li>
								<?php  } elseif ( $gorevcek['puandurumu']==1 ) {?>
									<font face="Times New Roman">
										<span ><a   style="color:blue ;font-size:17px;"><br> <br> Puan Verildi <br> <br></a> </span>



									</font>
								<?php }?>
								<?php 
								if ($gorevcek['veren_id'] == $_SESSION['kullanici_id'] and $gorevcek['teslimedildi']==1){?>
									<li>
										<input type="hidden" name="gorev_id" value="<?php echo $gorevyapancek['gorev_id']?>"><input class="btn btn-lg btn-success" type="submit" name="teslimaldim" value="Teslim Aldım	">
									</li>

								<?php }?>
								



							</ul>
						</div>

						<div class="col-md-6">
							<ul class="pricemus">
								<li class="headermus" style="background-color:#4CAF50">Geliştirici Bilgileri</li>
								<li class="greymus">
									<?php echo  $gorevyapancek['kullanici_ad'] ?>&nbsp;&nbsp;<?php echo  $gorevyapancek['kullanici_soyad'] ?>
								</li>
								<li>
									E-Mail : <?php echo  $gorevyapancek['kullanici_mail'] ?>
								</li>
								<li>
									GSM : <?php echo  $gorevyapancek['kullanici_gsm'] ?>
								</li>
								<li>Üviversite : <?php echo  $gorevyapancek['kullanici_univ'] ?> </li>
								<li>
									<?php 
									if ($gorevcek['yapan_id'] == $_SESSION['kullanici_id'] ){?>

										<input type="hidden" name="gorev_id" value="<?php echo $gorevyapancek['gorev_id']?>">
										<input class="btn btn-lg btn-success" type="submit" name="teslimettim" value="Teslim Ettim"><br><br>
									</form>
								
									<?php }?>
								</li>

							</ul>
						</div>

					</div>
					<?php include 'footer.php' ?>





