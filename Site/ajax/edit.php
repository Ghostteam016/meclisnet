  
<script src="../js/bootstrap-filestyle.min.js"></script>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">&nbsp</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                  <?php
                  include 'connect.php';
if($_POST) {
    include 'inputsecurity.php';
$errorCode = 0;
switch ($_POST["degistir"]) {
    case 1:
        $newEmail = $_POST["email"];
        $Id = $goster["Id"];
        if(filter_var($newEmail,FILTER_VALIDATE_EMAIL)) {
            if($newEmail != $goster["email"]) {
                $updateE = @mysql_query("update users set email='$newEmail' WHERE Id='$Id'");
                if($updateE) {
                    echo "E-mailiniz başarılı bir şekilde güncellendi.";
            }else {
                $errorCode = 1;
            }
            }else if($newEmail == $goster["email"]) {
                $errorCode = 2;
            }
        }else {
            $errorCode = 14;
        }
        break;
    case 2:
        //Adın temizliği
        $temizlik = new veritemizle();
        $temizlik -> temizle($goster["Ad"]);
        $AdT = $temizlik->temizveri;
        //Soyadın temizliği
        $temizlik -> temizle($goster["Soyad"]);
        $SoyadT = $temizlik->temizveri;
        $Tc = $goster["Tc"];
        $oldPassword = $_POST["oldPassword"];
        $newPassword1 = $_POST["newPassword1"];
        $newPassword2 = $_POST["newPassword2"];
        // Yeni parolanın işaret analizi
        $temizlik -> temizle($newPassword1);
        $newPasswordT = $temizlik->temizveri;
        //Sunucuya yüklenmek üzere yeni parolayı şifreleme
            $newPasswordU1 = sha1($newPassword1);
            $newPasswordU2 = sha1($newPasswordU1);
            $newPasswordS = sha1($newPasswordU2);
        if ($oldPassword != $goster["password"]) {
            $errorCode = 15;
        }else if($oldPassword == $newPassword1S) {
            $errorCode = 3;
        }else if($newPassword1 != $newPassword2) {
            $errorCode = 4;
        }else if(strlen($newPassword1) < 10) {
            $errorCode = 9;
        }else if(!preg_match("#[0-9]+#", $newPassword1)) {
            $errorCode = 10;
        }else if(!preg_match("#[a-zA-Z]+#", $newPassword1)) {
            $errorCode = 11;
        }else if(preg_match("/$AdT/i", $newPassword1) || preg_match("/$SoyadT/i", $newPassword1) || preg_match("/meclisnet/i", $newPassword1) || preg_match("/$Tc/i", $subject)) {
            $errorCode = 12;
        }else if($newPassword1 != $newPasswordT) {
            $errorCode = 13;
        }else if($oldPassword != $newPassword1 || $newPassword1 == $newPassword2) {
            $Id = $goster["Id"];
            $updateP = @mysql_query("update users set password='$newPasswordS' WHERE Id='$Id'");
            if($updateP) {
                echo 'Parolanız başarılı bir şekilde güncellendi.';
                echo '<meta http-equiv="refresh" content="0;URL=/">';
            }else {
                $errorCode = 5;
            }
        }  else {
            $errorCode = 6;
        }
        break;
    case 3:
        $resimAdi = $goster["Id"].".png";
        $resimMimeType = $_FILES["pPhoto"]["type"];
        $folderName = "profilePhotos/".$goster["Tc"];
        $ppCode = rand();
        $photoType = substr($_FILES["pPhoto"]["name"], -4);
        $createfolder = mkdir($folderName);
        if($createfolder) {
            $resimyolu = $folderName."/".$ppCode.$photoType;
        }  else {
            $resimyolu = $folderName."/".$ppCode.$photoType;
        }
            if(is_uploaded_file($_FILES["pPhoto"]["tmp_name"])) {
                $movePhoto = move_uploaded_file($_FILES["pPhoto"]["tmp_name"], $resimyolu);
                if($movePhoto) {
                    $Tc = $goster["Tc"];
                    $updatePP = @mysql_query("update users set profilePhotos='$resimyolu' WHERE Tc='$Tc'");
                    if($updatePP){
                        echo "Profil resminiz başarıyla değiştirildi. Etkinleşme için hesabınızdan çıkıp tekrar giriniz.";
                    }  else {
                        $errorCode = 8;
                    }
                }  else {
                    $errorCode = 7;
                }
            }  else {
                $errorCode = 7;
            }
        break;
    default : break;
    }
} ?>
                 <h1>Profili Düzenle</h1>
    <hr>
  <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="../css/<?php echo $goster["profilePhotos"]; ?>" class="avatar img-circle" alt="avatar">
          <h6>Fotoğrafı Değiştir</h6>
          </div>
       
         <input type="file" class="filestyle" data-input="false" data-icon="false">
      
      </div>


                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>İsim:</b></td>
                        <td><?php echo $goster["Ad"]; ?></td>
                      </tr>
                      <tr>
                        <td><b>Soyisim:</b></td>
                        <td><?php echo $goster["Soyad"]; ?></td>
                      </tr>
                      <tr>
                        <td><b>İl/İlçe</b></td>
                        <td><?php $bolgeId = $goster["BolgeID"]; $bolgeBilgiBul = @mysql_query("select * from bolgeler WHERE BolgeID LIKE '$bolgeId'"); while($bolgeBilgi = @mysql_fetch_array($bolgeBilgiBul)) { echo $bolgeBilgi["ilce"]." / ".$bolgeBilgi["il"]; } ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td><b>Okul</b></td>
                        <td><?php $kurumID = $goster["kurum"]; $bulkurumQ = @mysql_query("select * from kurum WHERE KurumID LIKE '$kurumID'"); while ($bulkurum = @mysql_fetch_array($bulkurumQ)) { echo $bulkurum["KurumAd"]; } ?></td>
                      </tr>
                        <tr>
                        <td><b>Yetki</b></td>
                        <td><?php $mevkiID = $goster["mevki"]; $bulmevkiQ = @mysql_query("select * from mevki WHERE mevkiID LIKE '$mevkiID'"); while ($bulmevki = @mysql_fetch_array($bulmevkiQ)) { echo $bulmevki["mevki"]; } ?></td>
                      </tr>
                      <tr>
                      </tr>
                      </tr>
                      </tbody>
                      </table>

                        <div class="form-group">
                            <form class="form-group" method="post">
                            <input type="hidden" name="degistir" value="2" />
            <label class="col-md-3 control-label">Eski Şifre:</label>
            <div class="col-md-8">
              <input class="form-control" type="oldpassword">
            <label class="col-md-3 control-label">Şifre:</label>
            <div class="col-md-8">
              <input class="form-control" type="newpassword1">
            </div>
          </div>
            <label class="col-md-3 control-label">Şifreyi Yinele:</label>
            <div class="col-md-8">
              <input class="form-control" type="newpassword2">
            </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
                <input type="submit" class="btn btn-primary" value="Kaydet">
                </form>
              <span></span>
           <p><h6 style="font-size: 75%" width="100%">*(Parolanız en az <strong> 10 </strong> karakter olmalıdır) <br/>
                *(Parolanız <strong> en az 1 tane büyük 1 tane küçük harf ve sayı </strong> barındırmalıdır.) <br/>
                *(Parolanızda <strong> noktalama işaretleri </strong> bulunmamalıdır) </h6> </p> <br/>
                <?php
                switch ($errorCode) {
      case 1:
          echo '<b style="color:#ad2100">Email gönderilemedi. Lütfen Tekrar Deneyiniz.</b>'.@mysql_error();
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 2:
          echo '<b style="color:#ad2100">Girdiğiniz email eskisiyle aynı. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 3:
          echo '<b style="color:#ad2100">Eski parolanızla yeni parolanız aynı. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 4:
          echo '<b style="color:#ad2100">Girdiğiniz parolalar aynı değil. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 5:
          echo '<b style="color:#ad2100">Parolanız değiştirilirken bir hata ile karşılaştık. Lütfen Tekrar Deneyiniz.</b>'.@mysql_error();
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 6:
          echo '<b style="color:#ad2100">Herhangi bir bilgi alınamadı. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 7:
          echo '<b style="color:#ad2100">Profil resminiz yüklenirken bir sorunla kaşılaşıldı. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 8:
          echo '<b style="color:#ad2100">Profil resmi yüklenemedi. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 9:
          echo '<b style="color:#ad2100">Yeni parolanız en az 10 karakter olmalıdır. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 10:
          echo '<b style="color:#ad2100">Yeni şifrenizde en az 1 tane sayı bulunmalıdır. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 11:
          echo '<b style="color:#ad2100">Yeni şifrenizde en az 1 küçük 1 büyük harf olmalıdır. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 12:
          echo '<b style="color:#ad2100">Yeni şifrenizde güvensiz bilgiler bulunmaktadır (meclisnet,'.$goster["Ad"]." ".$goster["Soyad"].",".$goster["Tc"].' gibi). Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 13:
          echo '<b style="color:#ad2100">Yeni şifreniz noktalam işaretleri içermektedir. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 14:
          echo '<b style="color:#ad2100">Email formatı gerçersiz. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
      case 15:
          echo '<b style="color:#ad2100">Eski parolanız yanlış. Lütfen Tekrar Deneyiniz.</b>';
          $imageName = "errorSS/".rand().".png";
          $eg = imagegrabscreen();
          imagepng($eg, $imageName);
      break;
  }
?>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
    <script>

$(":file").filestyle({input: false});
    </script