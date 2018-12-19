  <?php  
  include 'header.php'; 
  ob_start();
  session_start();
  $kullanicisor=$db-> prepare("SELECT * FROM kullanici where kullanici_id=:id");
  $kullanicisor -> execute(array(
    'id'=> $_SESSION['kullanici_id']
  ));

  $kullanicicek=$kullanicisor -> fetch(PDO::FETCH_ASSOC);


  date_default_timezone_set('Europe/Istanbul');
  $tarih= date('Y-m-d');
  $gorevtarihsor=$db->prepare("SELECT * FROM gorev where gorev_bitTarih >:tarih and veren_id=:id ");
  $gorevtarihsor->execute(array(
    'tarih'=> $tarih,
    'id'=> $_SESSION['kullanici_id']
  ));

  $gorevtarihbitsor=$db->prepare("SELECT * FROM gorev where gorev_bitTarih <:tarih and yapan_id=:id ");
  $gorevtarihbitsor->execute(array(
    'tarih'=> $tarih,
    'id'=> $_SESSION['kullanici_id']
  ));

  $gorevgecmissor=$db->prepare("SELECT * FROM gorev where gorev_bitTarih <:tarih and veren_id=:id ");
  $gorevgecmissor->execute(array(
    'tarih'=> $tarih,
    'id'=> $_SESSION['kullanici_id']
  ));

  $kullaniciyeteneksor = $db->prepare("SELECT yetenekadi FROM yetenek inner join kullaniciyetenek on kullaniciyetenek.yetenekId = yetenek.yetenekId where kullaniciyetenek.kullaniciid =:id");
  $kullaniciyeteneksor->execute(array(
    'id'=> $_SESSION['kullanici_id']
  ));

  $kullaniciyetenekcek = $kullaniciyeteneksor->fetchAll(PDO::FETCH_ASSOC);



 $yetenekcek=$db-> prepare("SELECT * FROM yetenek");
  $yetenekcek->execute();
  $results = $yetenekcek->fetchAll(PDO::FETCH_ASSOC);
  
  ?>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>



  <div class="container bootstrap snippet">
    <br>
    <br>


    <div class="row">
      <div class="col-sm-3"><!--left col-->

        <div class="text-center">

          <h4><b><?php echo $kullanicicek['kullanici_ad']?> <?php echo $kullanicicek['kullanici_soyad']?></b></h4>

          <form action="nedmin/netting/islem.php" method="POST"  enctype="multipart/form-data">



            <img  src="foto<?php echo  $kullanicicek['kullanici_foto'] ?> " style="max-width: 200px ; max-height: 200px" class="avatar img-circle img-thumbnail">
            <h6>Farklı bir fotoğraf kaydet</h6>

            <div class="text-center">
             <input type="file" class="text-center center-block file-upload" name="dosya" />
             <input type="submit" value="Gönder" />
           </div>
         </form>
         <form action="nedmin/netting/islem.php" method="POST">
           <br><td> <textarea onkeydown="if(event.keyCode == 13) return false;" maxlength="299" style="resize:none" name="kullanici_bio" class="form-control col-md-12 col-xs-12" rows="6" cols="50"><?php echo $kullanicicek['kullanici_bio']?></textarea> </td>
           <div class="col-xs-12" >
            <br>
            <button class="btn btn-lg btn-success" name="profilgüncelle" value="bio" type="submit">Kaydet</button>
          </div>
        </form>
      </div></hr><br>

    </div>

    <div class="col-sm-7">
      <ul class="nav nav-tabs">
        <li class="active">
          <a data-toggle="tab" href="#profil"><b>Profilim</b></a></li>
          <li><a data-toggle="tab" href="#bilgigüncelle"><b>Bilgilerimi Güncelle</b></a></li>
          <li><a data-toggle="tab" href="#sifre"><b>Password İşlemleri</b></a></li>
          <li><a data-toggle="tab" href="#egitim"><b>Eğitim Bilgilerim</b></a></li>
          <li><a data-toggle="tab" href="#gorev"><b>Görev Yükle</b></a></li>
          <li><a data-toggle="tab" href="#yetenek"><b>Yeteneklerim</b></a></li>
          <li><a data-toggle="tab" href="#aktifgorev"><b>Aktif Açılan Görevler</b></a></li>
          <li><a data-toggle="tab" href="#gorevgecmis"><b>Açılan Görev Geçmişi</b></a></li>
          <li><a data-toggle="tab" href="#bitengorev"><b>Bitirdiğim Görevler</b></a>
          </li>
        </ul>



        <div class="tab-content">

          <div class="tab-pane active" id="profil">

            <hr>
            <form class="form"  method="post" >


              <?php 

              if ($_GET['durum']=="no") {?>

                <b style="color:red;">Bir Hata Oluştu.İşlem Başarısız</b>

              <?php }

              elseif ($_GET['durum']=="eror") {?>

                <b style="color:red;">İşlem Başarısız.(Eski şire ile yeni şifre aynı değil)</b>

              <?php }

              ?>

            </form>

          </div>





          <div class="tab-pane" id="bilgigüncelle">
            <hr>
            <form class="form" action="nedmin/netting/islem.php" method="post" autocomplete="off">

              <div class="form-group">
                <div class="col-xs-6">
                  <label for="first_name"><h4>Adın</h4></label>
                  <input type="text" class="form-control" name="kullanici_ad" id="first_name" value="<?php echo $kullanicicek['kullanici_ad']?>">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-6">
                  <label for="last_name"><h4>Soyadın</h4></label>
                  <input type="text" class="form-control" name="kullanici_soyad" id="last_name" value="<?php echo $kullanicicek['kullanici_soyad']?>">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-6">
                  <label for="phone"><h4>Telefon Numaran</h4></label>
                  <input type="phone" class="form-control" name="kullanici_gsm" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" 
                  value="<?php echo $kullanicicek['kullanici_gsm']?>">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-6">
                  <label ><h4>Email</h4></label>
                  <input type="email" class="form-control" name="kullanici_mail" id="email" value="<?php echo $kullanicicek['kullanici_mail']?>" >
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label><h4>Şehir</h4></label>
                  <input type="text" class="form-control" name="kullanici_il" value="<?php echo $kullanicicek['kullanici_il']?>" >
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label ><h4>İlçe</h4></label>
                  <input type="text" class="form-control" name="kullanici_ilce" value="<?php echo $kullanicicek['kullanici_ilce']?>">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label ><h4>Adres</h4></label>
                  <td> <textarea maxlength="299" style="resize:none" name="kullanici_adres" class="form-control col-md-12 col-xs-12" rows="6" cols="50"><?php echo $kullanicicek['kullanici_adres']?></textarea> </td>
                </div>
              </div>

              <div class="form-group" >
                <div class="col-xs-12">
                  <br>
                  <button class="btn btn-lg btn-success" name="profilgüncelle" value="genel" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                  <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                </div>
              </div>
            </form>
            <hr>
          </div><!--/tab-pane-->


          <div class="tab-pane" id="sifre">
            <hr>
            <form class="form" action="nedmin/netting/islem.php" method="post" autocomplete="off">

              <div class="form-group">
                <div class="col-xs-12">
                  <label for="password"><h4>Eski Şifren </h4></label>
                  <input type="password" minlength="6" class="form-control" name="old_password" >
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-6">
                  <br>
                  <br>
                  <label for="password"><h4>Yeni Şifren </h4></label>
                  <input type="password" minlength="6" class="form-control" name="new_password" >
                </div>
              </div>

              <div class="form-group">

                <div class="col-xs-6">
                  <br>
                  <br>
                  <label for="password2"><h4>Yeni Şifreni Tekrar Gir</h4></label>
                  <input type="password" minlength="6" class="form-control" name="new_password_t">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <br>
                  <button class="btn btn-lg btn-success" name="profilgüncelle"  value="uptpass" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                  <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                </div>
              </div>
            </form>
            <hr>
          </div><!--/tab-pane-->

          <div class="tab-pane" id="egitim">
            <hr>
            <form class="form" method="post" action="nedmin/netting/islem.php" autocomplete="off" >

              <div class="form-group">
                <div class="col-xs-6">
                  <label for="phone"><h4>Üniversite</h4></label>
                  <input type="text" class="form-control" name="kullanici_univ" value="<?php echo $kullanicicek['kullanici_univ']?>"
                  >
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label ><h4>Bölüm</h4></label>
                  <input type="text" class="form-control" name="kullanici_bolum" value="<?php echo $kullanicicek['kullanici_bolum']?>">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label ><h4>Derece</h4></label>
                  <input type="text" class="form-control" name="kullanici_derece" value="<?php echo $kullanicicek['kullanici_derece']?>">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <br>
                  <button class="btn btn-lg btn-success" name="profilgüncelle" value="uptegitim" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                  <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                </div>
              </div>
            </form>
          </div>


          <div class="tab-pane" id="gorev">
            <hr>
            <form class="form" method="post" action="nedmin/netting/islem.php" autocomplete="off" enctype="multipart/form-data" >

             <div class="form-group">
              <div class="col-xs-12">
                <label><h4><b>Görev Yükle</b></h4></label>

                <div class="productwrapp">
                  <p>
                    <font face="Times New Roman" size="3" color="blue">
                     - İsabetli bir kategori giriniz. 
                     <br> - Görevinizin yapımı bir mekana bağlı ise şehir kısmını doldurup teklif verecek olan kullanıcımızı bilgilendirebilirsiniz 
                     <br> - Bütçenizi belirtmezseniz öğrencilerimiz beklentilerinizi anlamayabilirler 
                     <br> - Teklif geldiğinde mail ile bilgilendirilirsiniz 
                   </font>
                 </p>
               </div>

               <div class="form-group">
                <div class="col-xs-12">
                  <label><h4>Kategori </h4></label>
                  <input type="text" class="form-control" name="gorev_kategori" value="" required >
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label ><h4>Başlık</h4></label>
                  <input type="text" class="form-control" name="gorev_baslik" value="" required >
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label ><h4>Detaylar</h4></label>
                  <td> <textarea maxlength="299" style="resize:none" name="gorev_detay" class="form-control col-md-12 col-xs-12" rows="6" cols="50" required ></textarea> </td>
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-xs-12">
                  <label ><h4>İl Seç</h4><h6>(Şehir bilgisi görev için önemliyse)</h6></label>
                  <input type="text" class="form-control" name="gorev_il" value="">
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label ><h4>Bütçem</h4> <h6>(Sadece rakam)</h6></label>
                  <input type="text"  pattern="\d*" class="form-control" name="gorev_butce" value="" required >
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <?php 
                  date_default_timezone_set('Europe/Istanbul');
                  $tarih= date('Y-m-d');
                  ?>
                  <label ><br><h4>Son Teslim Tarihi </h4></label>
                  <br><input type="date"  name="gorev_bitTarih" required >


                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label ><h4>Dosya Ekle (zip - pdf - word )</h4></label>
                  <input type="file" class="text-center file-upload" name="gorev_ek" />

                </div>
              </div>

              <div class="productwrapp">
                <label ><br><h4>Görevinizin Süreci</h4></label>
                <p>
                  <font face="Times New Roman" size="3" color="blue">
                    - Teklif verenleri detaylıca inceleyebilirsin 
                    <br> - Görevinizin sayfasından sorulan sorulara cevap yazabilirsin
                    <br>- Vaktinde teslim almazsanız veya Görevin eksik yapılmış ise öğrencimiz cezalandırılır 
                  </font>

                  <label ><h4>Etik Davranış İlkeleri</h4></label>
                  <p>
                    <font face="Times New Roman" size="3" color="blue">
                      - Pazarlık yapabilirsiniz. Ancak bütçenizi belirtmeniz önerilmektedir 
                      <br> - Soru sor ve cevap yazma kısmında iletişim bilgilerinizi vermekten kaçınınız ki teklif veren kullanıcılarımıza haksızlık olmasın. 
                      <br>- Gelen tekliflerin altında ki iletişim bilgilerine ulaşabilirsiniz 
                      <br>- Görev yapılıyor iken birbirinize saygı çerçevesi içerisinde davranmaya özen gösteriniz 
                    </font>
                  </p>
                </div>

              </div>
            </div>

            <div class="form-group">
              <div class="col-xs-12">
                <br>
                <button class="btn btn-lg btn-success" name="profilgüncelle" value="gorev" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
              </div>
            </div>

          </form>
        </div>


        <div class="tab-pane" id="yetenek">
          <hr>

          <form class="form" method="post" action="nedmin/netting/islem.php" autocomplete="off" >
            <div class="form-group">
              <div class="col-xs-12">
                <label><h4>Yetenek</h4></label>
                <br>
                <div class="productwrapp">
                  <p>
                    <font face="Times New Roman" size="3" color="blue">

                      <ul>

                       <?php 
                       echo "Daha Önce Kaydedişmiş Yetenekleriniz";
                       foreach ($kullaniciyetenekcek as $bb) { 
                        echo '<li>'.$bb['yetenekadi'].'</li>';
                      }

                      ?>
                    </ul>
                  </font>
                </p>
              </div>
              <br>
              <select name="yetenekId" style="width: 500px" >
                <?php foreach ($results as $row) { ?>
                  <option class="form-control" value="<?php echo $row['yetenekId']; ?>"><?php echo $row['yetenekadi']; ?></option>

                <?php } ?>
              </select>

              <h6><br>Yüklenen görevlerden yeteneklerinize göre haberdar olacaksınız.</h6>
            </div>
          </div>

          <div class="form-group">
            <div class="col-xs-12">
              <br>
              <button class="btn btn-lg btn-success" name="profilgüncelle" value="yetenek" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
              <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
            </div>
          </div>

        </form>
      </div>


      <div class="tab-pane" id="aktifgorev">
        <hr>
        <form class="form"  method="post" autocomplete="off" >
          <div class="row prdct"><!--Products-->
            <?php 
            while($gorevtarihcek=$gorevtarihsor->fetch(PDO::FETCH_ASSOC)) 
              {?>
                <div class="col-md-4">
                  <div class="productwrapg">

                    <font face="Times New Roman">
                      <span ;class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevtarihcek['gorev_butce'] ?>,00 ₺</a> </span></font>



                      <font face="Times New Roman">
                        <span ;class="smalltitle21"><a href="product.htm" style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevtarihcek['gorev_baslik'] ?></a> </span></font>

                        <font face="Times New Roman">
                          <span ;class="smalltitle21"><a  href="product.htm" style="font-size:17px;color:#343a40"><br><br><?php echo  substr($gorevtarihcek['gorev_detay'] , 0, 100)?>...</a> </span></font>


                        </div>
                      </div>
                      <?php 
                    }
                    ?>
                  </div>

                  <div class="row">
                    <div class="col-lg-12 text-center">
                      <button class="btn btn-light border border-dark" data-len="6" data-loadmore="/ajax/loadmore/finishedtask" data-target="#finish-task-list-container" data-page="2">Daha Fazla Göster</button>
                    </div>
                  </div>

                </form>
              </div>



              <div class="tab-pane" id="gorevgecmis">
                <hr>
                <form class="form"  method="post" autocomplete="off" >
                  <div class="row prdct"><!--Products-->
                    <?php 
                    while($gorevgecmiscek=$gorevgecmissor->fetch(PDO::FETCH_ASSOC)) 
                      {?>
                        <div class="col-md-4">
                          <div class="productwrapg">

                            <font face="Times New Roman">
                              <span ;class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevgecmiscek['gorev_butce'] ?>,00 ₺</a> </span></font>



                              <font face="Times New Roman">
                                <span ;class="smalltitle21"><a href="product.htm" style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevgecmiscek['gorev_baslik'] ?></a> </span></font>

                                <font face="Times New Roman">
                                  <span ;class="smalltitle21"><a  href="product.htm" style="font-size:17px;color:#343a40"><br><br><?php echo  substr($gorevgecmiscek['gorev_detay'] , 0, 100)?>...</a> </span></font>


                                </div>
                              </div>
                              <?php 
                            }
                            ?>
                          </div>

                          <div class="row">
                            <div class="col-lg-12 text-center">
                              <button class="btn btn-light border border-dark" data-len="6" data-loadmore="/ajax/loadmore/finishedtask" data-target="#finish-task-list-container" data-page="2">Daha Fazla Göster</button>
                            </div>
                          </div>

                        </form>
                      </div>






                      <div class="tab-pane" id="bitengorev">
                        <hr>
                        <form class="form"  method="post" autocomplete="off" >
                          <div class="row prdct"><!--Products-->
                            <?php 
                            while($gorevtarihbitcek=$gorevtarihbitsor->fetch(PDO::FETCH_ASSOC)) 
                              {?>
                                <div class="col-md-4">
                                  <div class="productwrapg">

                                    <font face="Times New Roman">
                                      <span ;class="smalltitle21" ><a href="product.htm" style="color:ForestGreen;font-size:18px;font-weight: bold;" >Bütçe = <?php echo  $gorevtarihbitcek['gorev_butce'] ?>,00 ₺</a> </span></font>



                                      <font face="Times New Roman">
                                        <span ;class="smalltitle21"><a href="product.htm" style="font-weight: bold;font-size:15px;color: black"><br><?php echo  $gorevtarihbitcek['gorev_baslik'] ?></a> </span></font>

                                        <font face="Times New Roman">
                                          <span ;class="smalltitle21"><a  href="product.htm" style="font-size:17px;color:#343a40"><br><br><?php echo  substr($gorevtarihbitcek['gorev_detay'] , 0, 100)?>...</a> </span></font>


                                        </div>
                                      </div>
                                      <?php 
                                    }
                                    ?>
                                  </div>

                                  <div class="row">
                                    <div class="col-lg-12 text-center">
                                      <button class="btn btn-light border border-dark" data-len="6" data-loadmore="/ajax/loadmore/finishedtask" data-target="#finish-task-list-container" data-page="2">Daha Fazla Göster</button>
                                    </div>
                                  </div>

                                </form>
                              </div>




                            </div><!--/tab-pane-->
                          </div><!--/tab-content-->

                        </div><!--/col-9-->
                      </div><!--/row-->

                      <br>
                      <br>
                      <br>
                      <br>

                      <?php 
                      include 'footer.php' ?>

