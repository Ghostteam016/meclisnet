<?php
include 'connect.php';
$GL = $_GET["GL"];
$SID = $_GET["SID"];
$SET = $_GET["SET"];
if($GL == 1) {
    $dBulQ = @mysql_query("select * from dilekce WHERE Id LIKE '$SID'");
    if($dBul = @mysql_fetch_array($dBulQ)) {
        if($SET == 1) {
            $updateD = @mysql_query("update dilekce set Archived='1' WHERE Id='$SID'");
            if($updateD){
                echo "Dilekceniz başarıyla arşivlendi.";
                ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/dilekceKutusu.php?goster=1"; ?>'"><?php
            }  else {
                echo 'Dilekceniz arşivlenemedi';
                ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/dilekceKutusu.php"; ?>'"><?php
            }
        }else if($SET == 0) {
            $updateD = @mysql_query("update dilekce set Archived='0' WHERE Id='$SID'");
            if($updateD){
                echo "Dilekceniz başarıyla arşivden çıkarıldı.";
                ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/dilekceKutusu.php?goster=0"; ?>'"><?php
            }  else {
                echo 'Dilekceniz arşivden çıkarılamadı.';
                ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/dilekceKutusu.php"; ?>'"><?php
            }
        }
    }else {
        echo 'Dilekceniz arşivlenemedi yada arşivden çıkarılamadı.';
        ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/dilekceKutusu.php"; ?>'"><?php
    }
}else if($GL == 2) {
    $mBulQ = @mysql_query("select * from mesajlar WHERE Id LIKE '$SID'");
    if($mBul = @mysql_fetch_array($mBulQ)) {
        if($SET == 1) {
            $updateM = @mysql_query("update mesajlar set Archived='1' WHERE Id='$SID'");
            if($updateM){
                echo "Mesajınız başarıyla arşivlendi.";
                ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/mesajKutusu.php?goster=1"; ?>'"><?php
            }  else {
                echo 'Mesajınız arşivlenemedi.';
                ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/mesajKutusu.php"; ?>'"><?php
            }
        }else if($SET == 0) {
            $updateM = @mysql_query("update mesajlar set Archived='0' WHERE Id='$SID'");
            if($updateM){
                echo "Mesajınız başarıyla arşivden çıkarıldı.";
                ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/mesajKutusu.php?goster=0"; ?>'"><?php
            }  else {
                echo 'Mesajınız arşivden çıkarılamadı.';
                ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/mesajKutusu.php"; ?>'"><?php
            }
        }
    }else {
        echo 'Mesajınız arşivlenemedi yada arşivden çıkarılamadı.';
        ?><meta http-equiv="refresh" content="3;URL='<?php echo $sitename."/mesajKutusu.php"; ?>'"><?php
    }
}
?>