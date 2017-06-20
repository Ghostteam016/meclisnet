<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="bootstrap.min.css" rel="stylesheet" type="text/css"> 
<link href="custom.css" rel="stylesheet" type="text/css"> 
<link href="full-slider.css" rel="stylesheet">
</head>
<body>
<?php
include 'code/php/generalfunction.php';
    include 'connect.php';
    if($_POST) {
        if(isset ($_COOKIE["meclisnetuser"]) && isset ($_COOKIE["meclisnetsifre"]) && $_COOKIE["meclisnetuser"] == $_POST["TC"]) {
            $Tc = $_COOKIE["meclisnetuser"];
            $passwordS = $_COOKIE["meclisnetsifre"];
            $TC = @mysql_query("select * from users WHERE Tc LIKE '$Tc'");
            if ($TC > 0) {
                $uye = @mysql_query("select * from users WHERE Tc LIKE '$Tc'");
                $Ogoster = @mysql_fetch_array($TC);
                if($passwordS == $Ogoster["Password"]) {
                    $goster = @mysql_fetch_array($uye);
                    $_SESSION["goster"] = $goster;
                    //include 'code/generalUtilities/popup.php';
                    //popup();
                    if($_POST["rememberMe"]) {
                    setcookie("meclisnetuser",$Tc,time() + (60*60*24*370));
                    setcookie("meclisnetsifre",$passwordS,time() + (60*60*24*370));
                    }
                    reload("Site/index.php");
                }
                
            }
        }/*else*/ if(isset($_POST["TC"]) && isset($_POST["password"])) {
            //$Tc = inputClear($_POST["TC"]);
            //$password = inputClear($_POST["password"]);
                include "inputsecurity.php";
                $temizlik = new veritemizle();
                $temizlik -> temizle($_POST["TC"]);
                $Tc = $temizlik->temizveri;
                $temizlik = new veritemizle();
                $temizlik -> temizle($_POST["password"]);
                $password = $temizlik->temizveri;
            $TC = @mysql_query("select * from users WHERE Tc LIKE '$Tc'");
            if ($TC > 0) {
                $uye = @mysql_query("select * from users WHERE Tc LIKE '$Tc'");
                $Ogoster = @mysql_fetch_array($TC);
                //$passwordS = encryptedVariable($password);
                $passwordU1 = sha1($password);
                $passwordU2 = sha1($passwordU1);
                $passwordS = sha1($passwordU2);
                if($passwordS == $Ogoster["Password"]) {
                    /*$recaptcha = $_POST["g-recaptcha-response"];
                    if($recaptcha) {
                        //include 'getCurlData.php';
                        $google_url = "https://www.google.com/recaptcha/api/siteverify";
                        $secret = "6Le7DgwTAAAAAHssw1RN7HiBLQvp-Bqd86t5edaf";
                        $ip = $_SERVER["REMOTE_ADDR"];
                        //$url = $google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
                        //$res = getCurlData($url);
                        //$resj = json_decode($res, true);
                        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=.".$secret."&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
                        if($response['success']) {
                            echo "Başarılı";*/
                            $goster = @mysql_fetch_array($uye);
                            $_SESSION["goster"] = $goster;
                            if($_POST["rememberMe"]) {
                            setcookie("meclisnetuser",$Tc,time() + (60*60*24*370));
                            setcookie("meclisnetsifre",$passwordS,time() + (60*60*24*370));
                            }
                            reload("Site/index.php");
                        /*}else {
                            $errorCode = 3;
                        }*/
                    }else {
                        $errorCode = 3;
                    }
                    //setcookie("loginTC",$goster["TC"],time() + (60*60*24*30));
                    //setcookie("loginPassword",$goster["password"],time() + (60*60*24*30));
                }else {
                    $errorCode = 1;
                }
            }else {
                $errorCode = 2;
            }
        }else {
            include "Site/testUyari.php";
        }
        
    
    ?>

<div class="row"> 
<div class="col-md-12 column "><center><img src="kirmizi_eskiz.png" width="100%"></center></div>
</div>
<div class="container">
<div class="row">
<div class="panel panel-default   " style="margin-top:100px;">
 <div class="panel-body" >
    <div class="col-md-4">
      <div class="wrapper">
        <form class="form-signin" method="post">       
      <h2 class="form-signin-heading">Giriş Yapınız</h2>
      <hr>
          <input type="text" class="form-control" name="TC" placeholder="<?php if(isset ($_COOKIE["meclisnetuser"]) && isset ($_COOKIE["meclisnetsifre"])) { $userTc = $_COOKIE["meclisnetuser"]; }else { echo "Tc Kimlik No"; } ?>" value="<?php if($userTc){ echo $userTc; } ?>" required="" autofocus="" />

          <input type="password" class="form-control" name="password" placeholder="<?php if(isset ($_COOKIE["meclisnetuser"]) && isset ($_COOKIE["meclisnetsifre"])) { echo $userP = "*********"; }else { echo "Şifre"; } ?>" value="<?php if($userP){ echo $userP; } ?>" required=""style="margin-top:10px;"/>      
      <label class="captcha">
          <img src="code/generalUtilities/randomImage.php" /> ÜZERİNDE ÇALIŞILIYOR (AKTİF DEĞİL)
          <input type="text" class="form-control" name="captcha" placeholder="Resimde gördüklerinizi yazınız!"/>
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş</button>   
    </form>
  </div>
	</div>

        <div class="col-md-5">
        <div id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" ><img src="a.jpg"width="100%" height="100%" /></div>
                <div class="carousel-caption">
                    <h2>Caption 1</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" ><img src="b.jpg" width="100%" height="100%" /></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill"><img src="c.jpg" width="100%" height="100%"/></div>
                <div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </div>

        </div> 
                    <div class="col-md-3">
 
   <div class="panel panel-primary">
  <div class="panel-heading">Duyurular</div>
  <div class="panel-body">
<marquee align="middle" scrollamount="1" height="200" width="100%" direction="up" scrolldelay="1">

MECLİSNET PROJESİ                                                                              
Meclisnet projesi öğrenci meclisleri adına düşünülen bir veri tabanlı sistemdir. Bu sayede giriş yetkisi bulunan kurum ve şahıslar arasındaki iletişimin hızlı ve sağlıklı olması sanal ortama geçirilerek amaçlanmıştır.
Nasıl Çalışır?
1)  Sistem içerisinde her şahıs ve kurumun kendine ait kullanıcı girişi mevcuttur(her kullanıcının yetkileri mevkiine göre sınırlıdır.)
2)  Bu şahıs ve kurumlar aralarında resmi ve özel mesajlaşma gerçekleştirebilir, etkinlik ekleyebilir ve birbirlerine bazı formatlarda resmi tutanak veya dosya yollayabilirler.
3)  Her ilçe ve il kendi üyeleri arasında bu haberleşmeyi gerçekleştirirler.
4)  İlçeler, iller ve kurumlar arası haberleşme yetkisi bulunan kullanıcılar tarafından gerçekleşir.
5)  Forum eklentisi ile şahıslar ve kurumlar,  genel tartışma ortamı kurabilirler(H er kullanıcının   foruma katılma hakkı mevcuttur)


Projenin Hedef Kitlesi
1)  Milli Eğitim Bakanlığı
2)  İl Milli Eğitim Müdürlükleri
3)  İlçe Milli Eğitim Müdürlükleri
4)  İlçe Öğrenci Meclisleri
5)  İl öğrenci Meclisleri


</marquee>

  </div>
  
</div>
 </div>
	</div>
   
  </div> 
</div>




</div>
</div>


<script src="jquery.js"></script>

<!-- Script to Activate the Carousel -->
<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>

<script src="bootstrap.min.js"></script>
</body>
</html>
