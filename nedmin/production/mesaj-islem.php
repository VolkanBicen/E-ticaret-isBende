<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$mesajsor=$db->prepare("SELECT * FROM mesaj");
$mesajsor->execute();

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Mesaj İşlemleri <small>,
              <?php 

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">İşlem Başarılı</b>

              <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız</b>

              <?php }

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
                  <th>Gönderen Adı</th>
                  <th>Cevaplayan Adı</th>
                  <th>Mesaj İçerik</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                while($mesajcek=$mesajsor->fetch(PDO::FETCH_ASSOC)) {?>
                  <tr>

                    <?php 
                    ob_start();
                    session_start();
                    include '../netting/baglan.php';
                    $gonderenid=$mesajcek['gonderenId'];
                    $gonderenad=$db-> prepare("SELECT kullanici_ad FROM kullanici where kullanici_id=:gonderenId");
                    $gonderenad->execute(array(
                      'gonderenId'=> $gonderenid
                    ));
                    $gonderenadcek=$gonderenad->fetch(PDO :: FETCH_ASSOC);

                    $aliciid=$mesajcek['cevaplayanId'];
                    $aliciadi=$db-> prepare("SELECT kullanici_ad FROM kullanici where kullanici_id=:aliciId");
                    $aliciadi->execute(array(
                      'aliciId'=> $aliciid
                    ));
                    $aliciadcek=$aliciadi->fetch(PDO :: FETCH_ASSOC);

                    ?>
                    <td><?php echo $gonderenadcek['kullanici_ad'] ?></td>
                    <td><?php echo $aliciadcek['kullanici_ad'] ?></td>

                   <td> <textarea maxlength="299" style="resize:none" name="mesaj" class="form-control col-md-7 col-xs-12" rows="3" cols="30"><?php echo $mesajcek['mesaj']?></textarea> </td>

                    

                    <td><a href="../netting/islem.php?mesajId=<?php echo $mesajcek['mesajId'] ?>&mesajsil=ok"><center><button class="btn btn-danger btn-xs">Sil</button></center></a></td>
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
