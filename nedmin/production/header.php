<?php 
ob_start();
session_start();
include '../netting/baglan.php';

$admin=$db-> prepare("SELECT admin_kAdi FROM admin where admin_kAdi=:kAdi");
$admin->execute(array(
  'kAdi'=> $_SESSION['admin_kAdi']
));
$sayac=$admin -> rowCount();
$adcek=$admin->fetch(PDO :: FETCH_ASSOC);

if ($sayac==0) {
  header("Location:login.php?durum=izinsiz");
  exit;
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>İş Bende | Admin Panel</title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Admin Paneli!</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/a.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Hoşgeldiniz,</span>
              <h2><?php echo $adcek['admin_kAdi']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Genel İşlemler</h3>
              <ul class="nav side-menu">
                <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa </a></li>
                <li><a href="kullanici-islem.php"><i class="fa fa-user"></i> Kullanıcı İşlemleri </a></li>
                <li><a href="gorev-islem.php"><i class="fa fa-tasks"></i> Görev İşlemleri </a></li>
                <li><a ><i class="fa fa-cogs"></i> Kategori İşlemleri <span class="fa fa-cogs"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="kategori-ekle.php"><i class="fa fa-arrow-circle-right"></i></i> Kategori Ekle </a></li>
                    <li><a href="kategori-islem.php"><i class="fa fa-arrow-circle-right"></i></i> Kategori Düzenle Sil </a></li>

                  </ul>
                </li>
              </li>
              <li><a href="mesaj-islem.php"><i class="fa fa-question-circle"></i> Soru-Cevap İşlemleri </a></li>
              <li><a href="admin-islem.php"><i class="fa fa-user"></i> Yeni Yönetici Ekle </a></li>
              <br />
              <h3>Sİte Ayarları</h3>
              <br />
              <li><a href="genel-ayar.php"><i class="fa fa-user"></i> Site Genel Ayarları </a></li>
              <li><a href="hakkimizda.php"><i class="fa fa-user"></i> Hakkımızda Ayarları </a></li>
              <li><a href="sosyal-medya.php"><i class="fa fa-user"></i> Sosyal Medya Ayarları </a></li>

            </ul>

          </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
          <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="images/user.png" alt=""><?php echo $adcek['admin_kAdi']; ?>
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="logout.php"><i class="fa fa-power-off pull-right"></i> Güvenli Çıkış</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
        <!-- /top navigation -->