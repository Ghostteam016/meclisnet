<?php
    echo "denemedsdasdasd";
    if($_POST["mesaj"]) {
        echo "dsadasdasdasdsa!!!!!"."     ".$_POST["mesaj"];
        if($_POST["il"] || $_POST['ilce']){
        echo 'Mesajınız Gönderiliyor.'."<br/>";
        $mesaj = $_POST['mesaj'];
        $email = $goster['Id'];
        //$ilceonay = $_POST['ilce'];
        //$ilonay = $_POST['il'];
        if($_POST['il'] == 1) {
            if($goster["mevki"] == 4) { 
                $gonderilecekBolgeil = $goster["il"];
            }else if($goster["mevki"] <= 3) {
                $gonderilecekBolgeil = $_POST['il'];
            }
            
            $bolgeBilgiQ = @mysql_query("select * from bolgeler WHERE il LIKE '$gonderilecekBolgeil'");
            while ($bolgeBilgi = @mysql_fetch_array($bolgeBilgiQ)) {
                $bolgeID = $bolgeBilgi["BolgeID"];
                $bolgeUyeBul = @mysql_query("select * from users WHERE BolgeID LIKE '$bolgeID'");
                while ($bolgeUye = @mysql_fetch_array($bolgeUyeBul)) {
                    $alici = $bolgeUye["Id"];
                    $ekle = mysql_query("insert into mesajlar (gonderen,alici,mesaj) values ('$email','$alici','$mesaj')");
                    if ($ekle) {
                        //echo "<font color='blue'>Veriler başarıyla eklendi!</font>";
                    }else {
                        //echo "<font color='red'>Veriler eklenemedi!</font>";
                    }
                }
            }
        }else if($_POST['ilce'] == 1) {
            if($goster["mevki"] == 4) {
                $gonderilecekBolgeID = $goster["bolgeID"];
            }else if($goster["mevki"] <= 3) {
                $gonderilecekBolgeID = $_POST['ilce'];
            }
            
            $bolgedekiUyeler = @mysql_query("select * from users WHERE BolgeID LIKE '$gonderilecekBolgeID'");
            while ($boldekiUyelerinBilgileri = @mysql_fetch_array($bolgedekiUyeler)) {
                $alici = $boldekiUyelerinBilgileri["Id"];
                $ekle = mysql_query("insert into mesajlar (gonderen,alici,mesaj) values ('$email','$alici','$mesaj')");
                if ($ekle) {
                    echo "<font color='blue'>Veriler başarıyla eklendi!</font>";
                }else {
                    $errorCode = 1;
            }
            }
            }else {
            $alici = $_POST['yetkili'];
             $ekle = mysql_query("insert into mesajlar (gonderen,alici,mesaj) values ('$email','$alici','$mesaj')");
            if ($ekle) {
                echo "<font color='blue'>Veriler başarıyla eklendi!</font>";
            }else {
                $errorCode = 1;
        }
        }
        }else {
            $errorCode = 3;
        }
    }else {
        $errorCode = 2;
    }
?>