<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$kullanicisor=$db->prepare("SELECT * FROM kullanici");
$kullanicisor->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı İşlemleri <small>,
              <?php 

              if ($_GET['durum']=="ok" || $_GET['sil']=="ok") {?>

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
                  <th>Kayıt Tarih</th>
                  <th>Ad</th>
                  <th>Soy ad</th>
                  <th>Mail Adresi</th>
                  <th>Telefon</th>
                  <th>Şehir</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) 
                  {?>

                  <tr>
                    <td><?php echo $kullanicicek['kullanici_zaman'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_ad'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_soyad'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_mail'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_gsm'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_il'] ?></td>
                    <td><center><a href="kullanici-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></center></a></td>
                      <td><center><a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'];?>&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></center></a>
                    </td>
                  </tr>
                <?php 
                 }
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
