<?php 
include 'header.php'; 
//Belirli veriyi seçme işlemi
$gorevsor=$db->prepare("SELECT * FROM gorev");
$gorevsor->execute();
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Görev İşlemleri <small>,
              <?php 

              if ($_GET['durum']=="ok" || $_GET['sil']=="ok") {?>

                <b style="color:green;">İşlem Başarılı</b>

              <?php } 
              elseif ( $_GET['sil']=="no") { ?>

                <b style="color:green;">İşlem Başarılı</b>

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
                  <th>Kategori</th>
                  <th>Başlık</th>
                  <th>Detay</th>
                  <th>Ek</th>
                  <th>Başlangıç Tarihi</th>
                  <th>Bitiş Tarihi</th>
                  <th>Bütçe</th>
                  <th>Yetenek</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                while($gorevcek=$gorevsor->fetch(PDO::FETCH_ASSOC)) {?>

                  <tr>
                 
                   <td><?php echo substr($gorevcek['gorev_baslik'], 0, 10); ?>...</td>
                   <td><?php echo substr($gorevcek['gorev_detay'], 0, 10); ?>...</td>
                   <td><?php echo $gorevcek['gorev_ek'] ?></td>
                   <td><?php echo $gorevcek['gorev_basTarih'] ?></td>
                   <td><?php echo $gorevcek['gorev_bitTarih'] ?></td>
                   <td><?php echo $gorevcek['gorev_butce']  ?> TL </td>
                   <td><?php echo substr($gorevcek['gorev_yetenek'], 0, 10); ?>...</td>

                    <td><a href="gorev-duzenle.php?gorev_id=<?php echo $gorevcek['gorev_id'] ?>"><center><button class="btn btn-primary btn-xs">Düzenle</button></center></a></td>

                    <td><a href="../netting/islem.php?gorev_id=<?php echo $gorevcek['gorev_id'] ?>&gorevsil=ok"><center><button class="btn btn-danger btn-xs">Sil</button></center></a></td>
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
