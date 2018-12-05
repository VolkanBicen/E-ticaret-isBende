<?php 
include 'header.php';

?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<br>
			<br>
			<br>
		

			<div class="bigtitle">Hakkımızda</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9"><!--Main content-->

			<div class="title-bg">
				<div class="title">Misyon</div>
			</div>

			<blockquote><?php echo $hakkimizdacek['hakkimizda_misyon']; ?></blockquote>



			<div class="title-bg">
				<div class="title">Vizyon</div>
			</div>

			<blockquote><?php echo $hakkimizdacek['hakkimizda_vizyon']; ?></blockquote>

			<div class="title-bg">
				<div class="title"><?php echo $hakkimizdacek['hakkimizda_baslik']; ?></div>
			</div>
			<div class="page-content">
				<p>
					<blockquote><?php echo $hakkimizdacek['hakkimizda_icerik']; ?> </blockquote>
				</p>

			</div>




		</div>



	</div>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>