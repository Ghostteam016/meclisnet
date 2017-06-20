<?php
if ( isset( $_POST['p'] ) ){
     
    function dosyaIslem(){
        $dosyaDegisken = 'twitterResim';
        if ( !isset($_FILES[$dosyaDegisken]) ){
            return false;
        }
         
        if ( $_FILES[$dosyaDegisken]['error'] ){ // Dosya yükleme işleminde hata olduysa
            return false;
        }
         
        $resimKontrol = getimagesize($_FILES[$dosyaDegisken]['tmp_name']);
         
        if ( $resimKontrol === FALSE ){ // Dosya resim kontrolü
            return false;
        }
         
        $dosyaYol = 'upload/';
        $dosyaAdi = basename($_FILES[$dosyaDegisken]['name']);
         
        if ( move_uploaded_file( $_FILES[$dosyaDegisken]['tmp_name'], $dosyaYol . $dosyaAdi ) ){
            return $dosyaYol . $dosyaAdi;
        } else {
            return false;
        }
         
    }
 
    if ( !isset($_POST['twitterMesaj']) || !$_POST['twitterMesaj'] ){
        exit("Lütfen mesaj giriniz");
    } else {
        $twitterMesaj = $_POST['twitterMesaj'];
    }
 
    include('plugin/twitter/TwitterAPIExchange.php');
     
    /* Bu Değerleri Twitter Api Sayfasından Almanız Gerekli */
    $settings = array(
        'oauth_access_token' => "627494152-VaWUL1zJDvvoA5xJuNdz6hAtFOmKZq1Z2aNbnNtY",
        'oauth_access_token_secret' => "gEheTTBmgiGSIYctcrWhmVA4jDdsAstWELaSsdj7YMkL6",
        'consumer_key' => "DespDair",
        'consumer_secret' => "627494152"
    );
 
    $requestMethod = 'POST';
    $postfields = array('status' => $twitterMesaj);
 
    if ( $dosyaAdi = dosyaIslem() ){ // Eğer resim mevcut ise url ve göndereceğimiz değişkenler değişmektedir.
        $url = 'https://api.twitter.com/1.1/statuses/update_with_media.json';       
        $postfields['media'] = file_get_contents( $dosyaAdi );
    } else {
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
    }
     
     
    $twitter = new TwitterAPIExchange($settings);
    $return = $twitter->buildOauth($url, $requestMethod)
                 ->setPostfields($postfields)
                 ->performRequest();
    if ( $return ){
        $returnMsg = array(
            'islemSonuc' => true,
            'islemMsj' => json_decode( $return ),
        );
    } else {
        $returnMsg = array(
            'islemSonuc' => false,
            'islemMsj' => 'Mesajınız gönderilemedi',
        );
    }
}            
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP ile Twitter API Mesaj Gönder</title>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
 
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
 
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="panel panel-primary dialog-panel">
        <div class="panel-heading">
            <h5>Twitter API ile Mesaj Gönder</h5>
        </div>
        <div class="panel-body">
            <?php if ( isset($returnMsg) ){ ?>
                <?php if ( $returnMsg['islemSonuc'] ){ ?>
                    <p class="bg-success">
                        <a target="_blank" href="https://twitter.com/<?php echo $returnMsg['islemMsj']->user->screen_name;?>/status/<?php echo $returnMsg['islemMsj']->id_str;?>">
                            Tebrikler. Mesaja Bakmak İçin Tıklayınız!
                        </a>
                    </p>              
                <?php } else { ?>
                    <p class="bg-danger"><?php echo $returnMsg['islemMsj'];?></p>             
                <?php } ?>
            <?php } ?>
         
            <form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-2 col-md-offset-2" for="id_comments">Mesajınız</label>
                    <div class="col-md-6">
                        <textarea name="twitterMesaj" class="form-control" required placeholder="Mesajınızı yazınız" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-md-offset-2" for="id_comments">Resim</label>
                    <div class="col-md-6">
                        <input type="file" name="twitterResim" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button class="btn-lg btn-primary" style="float:right" type="submit">Tweet At!</button>
                    </div>
                </div>
                <input type="hidden" name="p" />
            </form>
        </div>
    </div>
</div>
    <?php
//require 'plugin/instagram/Instagram.php';
include "plugin/instagram/Instagram.php";
/////// CONFIG ///////
$username = 'despdair';
$password = 'MCfurkan001';
$debug    = false;
$photo    = 'upload/resume_button.jpg';     // path to the photo
$caption  = null;   // caption
//////////////////////
$i = new Instagram($username, $password, $debug);
try{
    echo 'deneme1';
  $i->login();
} catch (InstagramException $e)
{
    echo 'deneme2';
  $e->getMessage();
  exit();
}
try {
    echo 'deneme3';
  $i->uploadPhoto($photo, $caption);
} catch (Exception $e)
{
    echo 'deneme4';
  echo $e->getMessage();
}
?>
</body>
</html>