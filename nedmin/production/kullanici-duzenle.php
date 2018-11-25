<?php 

include 'header.php'; 

$kullanicisor=$db-> prepare("SELECT * FROM kullanici where kullanici_id=:id");
$kullanicisor -> execute(array(
  'id'=> $_GET['kullanici_id']
));

$kullanicicek=$kullanicisor -> fetch(PDO::FETCH_ASSOC);
echo $kullanicicek['kullanci_ad'];

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Düzenle <small>,
              <?php 

              if ($_GET['durum']=="no") {?>

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
            <br />



            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Adı <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="20" type="text" id="first-name" name="kullanici_ad" value="<?php echo $kullanicicek['kullanici_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Soyad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="20" type="text" id="first-name" name="kullanici_soyad" value="<?php echo $kullanicicek['kullanici_soyad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>



              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Telefon Numarası <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="11" type="text" id="first-name" name="kullanici_gsm" value="<?php echo $kullanicicek['kullanici_gsm'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı İl <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="15" type="text" id="first-name" name="kullanici_il" value="<?php echo $kullanicicek['kullanici_il'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı İlçe <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="20" type="text" id="first-name" name="kullanici_ilce" value="<?php echo $kullanicicek['kullanici_ilce'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Üniversite <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="40" type="text" id="first-name" name="kullanici_univ" value="<?php echo $kullanicicek['kullanici_univ'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Bölüm <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="30" type="text" id="first-name" name="kullanici_bolum"  value="<?php echo $kullanicicek['kullanici_bolum'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>" >

              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="kullaniciduzenle" class="btn btn-success">Güncelle</button>
                </div>
              </div>

            </form>



          </div>
        </div>
      </div>
    </div>



    <hr>
    <hr>
    <hr>



  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
