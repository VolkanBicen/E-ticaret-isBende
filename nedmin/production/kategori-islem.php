<?php 
include 'header.php';

$kategorisor=$db -> prepare("SELECT * FROM kategori");
$kategorisor -> execute();

?>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Kategori İşlemleri <small>,
							<?php 

							if ($_GET['durum']=="ok" || $_GET['ekle']=="ok" || $_GET['sil']=="ok") {?>

								<b style="color:green;">İşlem Başarılı</b>

							<?php } 
							elseif ($_GET['sil']=="no") {
								?>

								<b style="color:red;">İşlem Başarısız</b>

								<?php
							}

							?>

						</small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>

							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">


						<!-- Div İçerik Başlangıç -->

						<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Kategori Adı</th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</thead>

							<tbody>

								<?php 

								while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {?>

									<tr>
										<td><?php echo $kategoricek['kategori_ad'] ?></td>

										<td><center><a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>"><button class="btn btn-primary btn-xs">Düzenle</button></center></a></td>

										<td><center><a href="../netting/islem.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kategorisil=ok"><button class="btn btn-danger btn-xs">Sil</button></center></a></td>

									</tr>
								<?php  }
								?>
							</tbody>
						</table>
						<!-- Div İçerik Bitişi -->
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- /page content -->










<?php include 'footer.php'; ?>