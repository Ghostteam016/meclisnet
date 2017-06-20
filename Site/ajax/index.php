
<!DOCTYPE html>
<?php 
include 'connect.php';
//include 'testUyari.php';
?>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="distributor" content="Global" />
    <meta itemprop="contentRating" content="General" />
    <meta name="robots" content="All" />
    <meta name="revisit-after" content="7 days" />
    <meta name="description" content="The source of truly unique and awesome jquery plugins." />
    <meta name="keywords" content="slider, carousel, responsive, swipe, one to one movement, touch devices, jquery, plugin, bootstrap compatible, html5, css3" />
    <meta name="author" content="w3widgets.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
      <link href="../css/icons.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
  

     <link href="../css/color-dark.css" rel="stylesheet" id="theme-color">
    <link href="../css/responsive-calendar.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

   
   <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/selectim2.css">
    <link rel="stylesheet" type="text/css" href="../css/file-input.css">
   <link rel="stylesheet" type="text/css" href="../css/editor.css">
    <link rel="stylesheet" type="text/css" href="../css/AdminLTE.css">
     <link rel="stylesheet" type="text/css" href="../css/_all-skins.min.css">
    <link rel="stylesheet" type="text/css" href="../css/blue.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap3-wysihtml5.min.css">
    
    
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>




  
    
    <title>MeclisNet</title>
</head>

<body>

<div class="row">
  <div class="col-md-8 banner">
  
     <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
    
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>MECLİS</b>NET</span>

        </a>
        
        <!-- Header Navbar: style can be found in header.less -->
        <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="    <?php 
    $kId = $goster["Id"];
    $bulV = @mysql_query("select * from mesajlar WHERE alici='$kId' AND Viewed='0'");
    while($UnviewedMessaeges = @mysql_fetch_array($bulV)) {
        $mId = $UnviewedMessaeges["Id"];
        $changeViewed = @mysql_query("update mesajlar set Viewed='1' Where Id='$mId'");
        if($changeViewed) {}
    }
    ?>">
                      <i class="fa fa-envelope-o"></i>
                      <span class="label label-success"><?php echo @mysql_num_rows($bulV); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        $kId = $goster["Id"];
                        $bulV = @mysql_query("select * from mesajlar WHERE alici='$kId' AND Viewed='0'");
                        while($UnviewedMessaeges = @mysql_fetch_array($bulV)) {
                            $mId = $UnviewedMessaeges["Id"];
                            $changeViewed = @mysql_query("update mesajlar set Viewed='1' Where Id='$mId'");
                            if($changeViewed) {}
                        }
                        ?>
                      <li class="header"><?php echo @mysql_num_rows($bulV); ?> mesajınız var.</li>
                      <li>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                            <?php
                            $bul = @mysql_query("select * from mesajlar WHERE alici LIKE '$kId'");
                            while ($goster2 = mysql_fetch_array($bul)) {
                            if($goster2["Archived"] == 0) {
                                              $GE = $goster2["gonderen"];
                                              $GB = @mysql_query("select * from users WHERE Id LIKE '$GE'");
                                              $GBilgi = mysql_fetch_array($GB);
                                              /*?> Gönderen: <a href="kullaniciSayfa.php?kullanici=<?php echo $GBilgi["Id"]; ?>"><?php echo $GBilgi["AdSoyad"]; ?></a><?php*/
                                              //echo "<br/>";
                                              //echo "Mesaj: ".$goster2["mesaj"].@mysql_num_rows($bul)."<br/>";
                            ?>
                          <li><!-- start message -->
                           <div class="pull-left" id="viewprofil">
                                <!-- User Image -->
                                <a href="#" onclick="<?php $_SESSION["Uid"] = $goster2["gonderen"]; ?>"><img src="../css/<?php echo $GBilgi["profilePhotos"]; ?>" class="img-circle img" alt="User Image" ></a>
                              </div>
                              <a href="#" id="read" onclick="<?php $_SESSION["Mid"] = $goster2["Id"]; ?>">
                              <!-- Message title and timestamp -->
                              <h4>
                                <?php echo $GBilgi["Ad"]." ".$GBilgi["Soyad"]; ?>
                                <small><i class="fa fa-clock-o"></i> <?php echo $goster2["date"]; ?></small>
                              </h4>
                              <!-- The message -->
                              <p><?php echo $goster2["subject"]; ?></p>
                                              <?php
                                          }
                                  ?>
                              
                            </a>
                          </li>
                          <?php } ?>

                        </ul><!-- /.menu -->
                      </li>
                      <li class="footer"><a href="#" id="inboxlink">Tümünü Gör</a></li>
                    </ul>
                  </li><!-- /.messages-menu -->

                  <!-- Notifications Menu -->
                  <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="<?php 
    $kKurum = $goster["kurum"];
    $bulV = @mysql_query("select * from dilekce WHERE GonderilenKurum='$kKurum' AND Viewed='0'");
    while($UnviewedDilekce = @mysql_fetch_array($bulV)) {
        $mId = $UnviewedDilekce["Id"];
        $changeViewed = @mysql_query("update dilekce set Viewed='1' Where Id='$mId'");
        if($changeViewed) {}
    }
    $kKurum = $goster["kurum"];
    $bulV = @mysql_query("select * from tutanak WHERE GonderilenKurum='$kKurum' AND Viewed='0'");
    while($UnviewedDilekce = @mysql_fetch_array($bulV)) {
        $mId = $UnviewedDilekce["Id"];
        $changeViewed = @mysql_query("update dilekce set Viewed='1' Where Id='$mId'");
        if($changeViewed) {}
    }
    ?>">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning"><?php $TDsayi = @mysql_num_rows($bulV) + @mysql_num_rows($DilekceBul); echo $TDsayi; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><?php $TDsayi = @mysql_num_rows($bulV) + @mysql_num_rows($DilekceBul); echo $TDsayi; ?> bildirminiz var.</li>
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                          <li><!-- start notification -->
                            <a href="#">
                              <i class="fa fa-users text-aqua"></i> 5 new members joined today
                            </a>
                          </li><!-- end notification -->
                          <?php 
                        $tutanakBilgiQ = @mysql_query("select * from tutanak");
                        while($tutanakBilgi = @mysql_fetch_array($tutanakBilgiQ)){
                        if($tutanakBilgi["available"] == 1) {
                        ?>
                            <li><!-- start notification -->
                            <a href="<?php echo $sitename.$tutanakBilgi["yol"];?>">
                              <i class="fa fa-users text-aqua"></i> <?php echo $tutanakBilgi["Ad"];?>
                            </a>
                          </li><!-- end notification -->
                        <?php } } 
    if($goster["mevki"] < 20) {
        $kullanıcıKurum = $goster["kurum"];
    $DilekceBulQ = @mysql_query("select * from dilekce where GonderilenKurum LIKE '$kullanıcıKurum'");
    while ($DilekceBul = @mysql_fetch_array($DilekceBulQ)) {
    if($DilekceBul["Archived"] == 0) {
                    $DilekceAd = $DilekceBul["Ad"];
                    $yukleyenTc = $DilekceBul["yukleyen"];
                    $yukleyenBilgiQ = @mysql_query("select * from users WHERE Tc LIKE '$yukleyenTc'");
                    $yukleyenBilgi = @mysql_fetch_array($yukleyenBilgiQ);
                    ?>
                        <li><!-- start notification -->
                            <a href="#">
                              <i class="fa fa-users text-aqua"></i> <?php echo "Dilekce adı: ".$DilekceAd;?>
                            </a>
                          </li><!-- end notification -->
                        <?php
                }
    }
    }
  ?>
                        </ul>
                      </li>
                      <li class="footer"><a href="#" id="inboxlink">Tümünü Gör</a></li>
                    </ul>
                  </li>
                  <!-- Tasks Menu -->
            
                  <!-- User Account Menu -->
           
                </ul>
              </div>
              </header>

                <!--  notification end -->
           


<img src="../css/bann.png" class="img-responsive ">
</div>
  
<div class="col-md-4 banner2">
    <div class="row">
		<div class="panel panel-default profile">
            <div class="panel-body profile">
                    <div class="col-md-4 text-center">
                      <img class="img-circle avatar avatar-original" style="-webkit-user-select:none; 
                      display:block; margin:auto;" src="../css/<?php echo $goster["profilePhotos"]; ?>">
                    </div>
                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-md-12">
                          <h3 class="only-bottom-margin">Hoşgeldiniz</h3>
                          <h6><span class="text-muted">Sayın:</span><?php echo $goster["Ad"]." ".$goster["Soyad"]; ?><br></h6>
                          <h6><span class="text-muted">Yetkisi:</span> <?php $mevkiID = $goster["mevki"]; $bulmevkiQ = @mysql_query("select * from mevki WHERE mevkiID LIKE '$mevkiID'"); while ($bulmevki = @mysql_fetch_array($bulmevkiQ)) { echo $bulmevki["mevki"]; } ?><br></h6>
                          <h6><span class="text-muted">Kurum:</span> <?php $kurumID = $goster["kurum"]; $bulkurumQ = @mysql_query("select * from kurum WHERE KurumID LIKE '$kurumID'"); while ($bulkurum = @mysql_fetch_array($bulkurumQ)) { echo $bulkurum["KurumAd"]; } ?></h6>
                          
                            

                  
                        </div>
                      </div>
                     </div>

                    <button type="button" class="btn btn-default" id="editlink"><span class="glyphicon glyphicon-edit cikis" aria-hidden="true"></span>     Düzenle</button>
                    <a href="Exit.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-log-out cikis" aria-hidden="true"></span>     Çıkış</button></a>
                            
                             </div>
                </div>
             
           </div>
            </div>
</div>

<div class="container">


  <div class="row">
      
    <div class="col-md-3 menum ">
      <ul class="nav nav-pills nav-stacked">
          <li class="active"><a href="index.php"> <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Etkinlik Takvimi</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" > <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Ekle  <span class="caret"></span></a>
           
          <ul class="dropdown-menu">
            <li><a href="#" id="mesajlink"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>Mesaj</a></li>
            <li><a href="#" id="dilekcelink"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Dilekçe</a></li>
            <li><a href="#" id="tutanaklink"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Tutanak</a></li>                        
          </ul>
        </li>
        
        <li><a href="#"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> Forum </a></li>
      </ul>
     
    </div>

     <div class="col-md-9" id="ortakisim">
      <div class="col-md-8" id="container2">
      <div class="takvim">
           <!-- Responsive calendar - START -->
    	<div class="responsive-calendar">
        <div class="controls">
            <a class="pull-left" data-go="prev"><div class="btn btn-primary">Önceki</div></a>
            <h4><span data-head-year></span> <span data-head-month></span></h4>
            <a class="pull-right" data-go="next"><div class="btn btn-primary">Sonraki</div></a>
        </div><hr/>
        <div class="day-headers">
          <div class="day header">Pzt</div>
          <div class="day header">Sal</div>
          <div class="day header">Çar</div>
          <div class="day header">Per</div>
          <div class="day header">Cum</div>
          <div class="day header">Cmt</div>
          <div class="day header">Paz</div>
        </div>
        <div class="days" data-group="days">
          
        </div>
      </div>
      </div>
      <!-- Responsive calendar - END -->
      </div>
            <div class="col-md-4">
 
   <div class="panel panel-primary">
  <div class="panel-heading">Duyurular</div>
  <div class="panel-body">
<marquee align="middle" scrollamount="1" height="200" width="100%" direction="up" scrolldelay="1">
<?php
                            $haber = @mysql_query("select * from haberler");
                            while ($Ghaber = @mysql_fetch_array($haber)) {
                                if($Ghaber["bolge"] == "0" || $Ghaber["bolge"] == $goster["BolgeID"]){
                                echo "<h1>";
                                echo $Ghaber["baslik"];
                                echo "</h1><br/>";
                                echo $Ghaber["icerik"];
                                echo "<br/>";
                                }
                            }

                            ?>

</marquee>

  </div>
  
</div>
 </div>
</div>
    
    </div>
  
</div>
<script>
$(document).ready(function () {
$(".responsive-calendar").responsiveCalendar({
  time: '2013-05',
</script>


<script src="../js/zepto.min.js"></script>
<script src="../js/jquery.chained.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jQuery-2.1.4.min.js"></script>
<script src="../js/jquery.slimscroll.min.js"></script>
<script src="../js/icheck.min.js"></script>
<script src="../js/bootstrap3-wysihtml5.all.min.js"></script>f
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script src="../js/responsive-calendar.min.js"></script>
<script src="../js/site.js"></script>
<script src="../js/editor.js"></script>
<script src="../js/bootstrap-filestyle.min.js"></script>
<script language="javascript" src="../js/chainedselects.js"></script>
<script src="../js/jquery.chained.min.js"></script>



</html>