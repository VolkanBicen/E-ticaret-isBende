
<?php 

include 'header.php'; 

$gorevsor=$db-> prepare("SELECT * FROM gorev where gorev_id=:id");
$gorevsor -> execute(array(
  'id'=> $_GET['gorev_id']
));

$gorevcek=$gorevsor -> fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Görev Düzenle <small>,
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



            
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">



              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Görev Başlık <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="20" type="text" id="first-name" name="gorev_baslik" value="<?php echo $gorevcek['gorev_baslik'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Görev Detay <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <td> <textarea maxlength="299" style="resize:none" name="gorev_detay" class="form-control col-md-7 col-xs-12" rows="3" cols="30"><?php echo $gorevcek['gorev_detay']?></textarea> </td>

                </div>
              </div>

           

              <?php
              $zaman=explode(" ",$gorevcek['gorev_basTarih']);
              ?>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Görev Başlangıç Tarihi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="date" id="first-name" name="gorev_basTarih" disabled="" value="<?php echo $zaman[0]?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

             <?php
              $zaman=explode(" ",$gorevcek['gorev_bitTarih']);
              ?>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Görev Bitiş Tarihi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="date" id="first-name" name="gorev_bitTarih" disabled="" value="<?php echo $zaman[0]?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Görev Bütçe <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="9" type="text" id="first-name" name="gorev_butce" value="<?php echo $gorevcek['gorev_butce'] ?> TL " required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Görev Yetenek <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input maxlength="20" type="text" id="first-name" name="gorev_yetenek"  value="<?php echo $gorevcek['gorev_yetenek'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <input type="hidden" name="gorev_id" value="<?php echo $gorevcek['gorev_id'] ?>" >

              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="gorevduzenle" class="btn btn-success">Güncelle</button>
                </div>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
