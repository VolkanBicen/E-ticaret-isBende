<?php include 'header.php';
ob_start();
session_start();

$gorevsor=$db-> prepare("SELECT * FROM gorev where gorev_id=:id");
$gorevsor -> execute(array(
'id' => $_GET['id']
));

$gorevcek=$gorevsor->fetch(PDO::FETCH_ASSOC);

$teklifsor=$db-> prepare("SELECT * FROM teklif where gorev_id=:id and veren_id=:k_id");
$teklifsor -> execute(array(
'id' => $_GET['id'],
'k_id' => $_SESSION['kullanici_id']
));
$teklifcek=$teklifsor->fetch(PDO::FETCH_ASSOC);
$say=$teklifsor->rowCount();

$kullaniciteklifsor = $db->prepare("SELECT * FROM kullanici,teklif where  teklif.gorev_id=:g_id and teklif.veren_id=kullanici.kullanici_id");
$kullaniciteklifsor->execute(array(
'g_id'=>$_GET['id']
));
$sayac=$kullaniciteklifsor->rowCount();
$kullaniciteklifcek = $kullaniciteklifsor->fetchAll(PDO::FETCH_ASSOC);


$mesajgetir = $db->prepare("SELECT kullanici.kullanici_ad,kullanici.kullanici_soyad,mesaj.mesaj,mesaj.mesajId,mesaj.cevap FROM kullanici,mesaj where  mesaj.gorev_id=:g_id and mesaj.gonderenId=kullanici.kullanici_id");
$mesajgetir->execute(array(
'g_id'=>$_GET['id']
));
$sayacmesaj=$mesajgetir->rowCount();
$mesajgetircek = $mesajgetir->fetchAll(PDO::FETCH_ASSOC);



?>
<div class="container">
<div class="row">
<div class="col-md-12"><!--Main content-->

<br>
<br>
<div class="row prdct"><!--Products-->
<form action="nedmin/netting/islem.php" method="POST"  enctype="multipart/form-data">
<div class="col-md-5">
<div class="productwrapc">
<font face="Times New Roman">
<span ;class="smalltitle21" ><a style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevcek['gorev_butce'] ?>,00 ₺</a> </span></font>

<font face="Times New Roman">
<span ;class="smalltitle21"><a style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevcek['gorev_baslik'] ?></a> </span></font>

<font face="Times New Roman">
<span ;class="smalltitle21"><a   style="font-size:17px;color:#343a40"><br><br><?php echo $gorevcek['gorev_detay'] ?></a> </span></font>

<font face="Times New Roman">
<span ;class="smalltitle21"><a   style="color:ForestGreen;font-size:17px;"><br><br>Son Teslim Tarihi => <?php echo $gorevcek['gorev_bitTarih'] ?></a> </span></font>

<div class="form-group">
<div class="col-xs-12">
<br>
<?php

if (isset($gorevcek['gorev_ek'])) {?>

<input type="hidden" name="gorev_ek" value="<?php echo $gorevcek['gorev_ek']?>">
<input type="hidden" name="gorev_baslik" value="<?php echo  $gorevcek['gorev_baslik'] ?>">

<button class="btn btn-lg btn-success" name="download"  type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Görev Dosyasını İndir </button>

<?php } ?>

</div>
</div>
</div>
<?php
if ( $gorevcek['veren_id'] <> $_SESSION['kullanici_id'] ) {?>
<font face="Times New Roman">
<span ;class="smalltitle21" ><a  style="color:ForestGreen;font-size:18px;font-weight: bold;" > Soru & Cevap</a> </span></font>

<td> <textarea onkeydown="if(event.keyCode == 13) return false;" maxlength="299" style="resize:none" name="soru" class="form-control col-md-12 col-xs-12" rows="6" cols="50"></textarea> </td>

<input type="hidden" name="gonderenId" value="<?php echo $_SESSION['kullanici_id'] ?>">

<input type="hidden" name="cevaplayanId" value="<?php echo  $gorevcek['veren_id'] ?>">

<input type="hidden" name="gorev_id" value="<?php echo  $gorevcek['gorev_id'] ?>">

<div class="col-xs-12" >
<br>
<button class="btn btn-lg btn-success" name="sorucevap" type="submit">Gönder Cevaplasın</button>


</div>

<?php }
?>

</div>

<div class="col-md-1">

</div>

<div class="col-md-6">
<?php
if ( $gorevcek['veren_id'] <> $_SESSION['kullanici_id'] && $say==0) {?>
<div class="productwraptek">

<font face="Times New Roman">
<span ;class="smalltitle21" ><a  style="color:ForestGreen;font-size:18px;font-weight: bold;" > Hemen Teklif Ver</a></span></font>

<font face="Times New Roman">
<span ;class="smalltitle21"><a  style="font-weight: bold;font-size:15px;color: black"><br>

<label ><h4>Teklif Miktarınızı Yazınız</h4></label>
<input type="text"  pattern="\d*" class="form-control" name="gorev_teklif"  >

</a> </span></font>

<input type="hidden" name="veren_id" value="<?php echo $_SESSION['kullanici_id'] ?>">

<input type="hidden" name="gorev_id" value="<?php echo  $gorevcek['gorev_id'] ?>">

<div class="form-group">
<div class="col-xs-12">
<br>
<button class="btn btn-lg btn-success" name="teklifver"  type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Teklif Ver </button>

</div>
</div>

</div>
<?php }
?>
</div>

<div class="col-md-1">

</div>

<div class="col-md-6">

<div class="productwraptek">

<font face="Times New Roman">
<span ;class="smalltitle21" ><a  style="color:ForestGreen;font-size:18px;font-weight: bold;" > Verilmiş Teklifler</a></span></font>

<p>
<font face="Times New Roman" size="3" color="blue">


	<?php
if ($gorevcek['veren_id'] == $_SESSION['kullanici_id'] && $sayac!=0 ){

	foreach ($kullaniciteklifcek as $bb) { ?>
		<font face="Times New Roman">
			<span ;class="smalltitle21"><a style="color:ForestGreen;font-size:17px;"><br>

				<input type="radio" style="height:17px; width:17px;" name="kabul[]" 
				value="<?php echo  $gorevcek['gorev_id'] ?>"/>

<input type="hidden" name="yapan_id" value="<?php echo  $bb['kullanici_id'] ?>">
				<?php echo $bb['kullanici_ad']." ". $bb['kullanici_soyad']. "&emsp; ". $bb['kullanici_univ']. "&emsp;". $bb['teklif_miktar'] .",00 ₺"?></a> </span></font>

			<?php }
			
			?>
			<div class="col-xs-12" >
				<br>
				<input class="btn btn-lg btn-success" type="submit" name="teklifkabul" value="Teklifi Kabul Et">
			</div>
			<?php
		}
		
		else{

			foreach ($kullaniciteklifcek as $bb) { ?>

				<font face="Times New Roman">
					<span ;class="smalltitle21"><a style="color:ForestGreen;font-size:17px;"><br>


						<?php echo $bb['kullanici_ad']." ". $bb['kullanici_soyad']. "&emsp; ". $bb['kullanici_univ']. "&emsp;"?></a> </span></font>
					<?php }


				} 

			?>
</font>
</p>

</div>

</div>

<div class="col-md-1">

</div>
</form>
<form action="nedmin/netting/islem.php" method="POST"  enctype="multipart/form-data">
<div class="col-md-6">

<font face="Times New Roman">
<span ;class="smalltitle21" ><a  style="color:ForestGreen;font-size:18px;font-weight: bold;" > Soru & Cevap</a></span></font>
<p>
<font face="Times New Roman" size="2" color="blue">
<ul>

<?php

if ( $gorevcek['veren_id'] <> $_SESSION['kullanici_id'] ) {
foreach ($mesajgetircek as $bb) { ?>

<font face="Times New Roman">
<span ><a   style="color:blue ;font-size:17px;"><br ><?php echo "=> " ?> <?php echo $bb['kullanici_ad']. " ". $bb['kullanici_soyad']."<br>" ?></a> </span>

<span ><a   style="color:blue ;font-size:17px;"> &emsp; <?php echo "# " ?>   <?php echo $bb['mesaj'] ?> <br></a> </span>
<span ><a style="color:red ;font-size:17px;"> &emsp;&emsp; <?php echo $bb['cevap'] ?> <br></a> </span>
</font>

<?php
}
}
else{

foreach ($mesajgetircek as $bb) { ?>

<font face="Times New Roman">
<span ><a   style="color:blue ; font-size:17px;"><br ><?php echo "Kimden => " ?> <?php echo $bb['kullanici_ad']. " ". $bb['kullanici_soyad'] ?></a> &emsp; &emsp;<input type="radio" style="height:17px; width:17px;" name="sec[]" value="<?php echo $bb['mesajId'] ?>"/> <br></span>
 
<span ><a   style="color:blue ; font-size:17px;"> &emsp; <?php echo "# " ?>   <?php echo $bb['mesaj'] ?></a> </span><br>
<span ><a style="color:red ;font-size:17px;"> &emsp;&emsp;    <?php echo $bb['cevap'] ?> <br></a> </span>
</font>

<?php
}

?>
<?php if ($sayacmesaj!=0) {?>

<td> <textarea  required="required" onkeydown="if(event.keyCode == 13) return false;" maxlength="299" style="resize:none" name="soru_cevap" class="form-control col-md-12 col-xs-12" rows="2" cols="50"></textarea> </td>
<input type="hidden" name="gorev_id" value="<?php echo  $gorevcek['gorev_id'] ?>">
      <div class="col-xs-12" >
            <br>
             <input class="btn btn-lg btn-success" type="submit" name="yolla" value="Cevap Ver">
          </div>
 <?php         }

?>

 <?php          
}
?>

</ul>
</font>
</p>

</div>

</div>
</div><!--Main content-->
</div>
</div>

<br>
<br>
<br>
</form>
<?php include 'footer.php'; ?>