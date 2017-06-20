    <?php
    include 'connect.php';
    if(isset($_POST)) {
        if($_FILES["dilekce"] && $_POST["kurum"] && $_FILES["Ek1"]) {
            $dosyaadıD = $_FILES["dilekce"]["name"];
            $dosyayoluD = "../../documents/dilekce/".$dosyaadıD;
            $dosyaMimeType = $_FILES["dilekce"]["type"];
            if($dosyaMimeType == "image/jpeg" || $dosyaMimeType == "image/tiff" || $dosyaMimeType == "image/png" || $dosyaMimeType == "image/pict" || $dosyaMimeType == "image/bmp" || $dosyaMimeType == "application/pdf") {
                if(is_uploaded_file($_FILES["dilekce"]["tmp_name"])) {
                    $move = move_uploaded_file($_FILES["dilekce"]["tmp_name"], $dosyayoluD);
                    if($move) {
                        echo 'Dilekçeniz başarıyla yüklendi. <br/>';
                        echo "Dilekçe kaydı yapılıyor. <br/>";
                        $uploadedPerson = $goster["Tc"];
                        $GonderilenKurum = $_POST["kurum"];
                        $addFile = @mysql_query("insert into dilekce (GonderilenKurumID,Ad,yol,yukleyen) values ('$GonderilenKurum','$dosyaadıD','$dosyayoluD','$uploadedPerson')");
                        if($addFile) {
                            echo "Dilekçe kaydınız başarıyla yapıldı. <br/>";
                            echo "Ekler yükleniyor. <br/>";
                            $getfileinfoQ = @mysql_query("select * from dilekce WHERE Ad LIKE '$dosyaadıD'");
                            if($getfileinfo = @mysql_fetch_array($getfileinfoQ)) {
                                $fileId = $getfileinfo["Id"];
                                $dosyayoluEkler = "../../documents/dilekce/".$fileId;
                                $createfolder = mkdir($dosyayoluEkler);
                                if($createfolder) {
                                    $dosyaAdıE1 = $_FILES["Ek1"]["name"];
                                    $dosyayoluE1 = $dosyayoluEkler."/".$dosyaAdıE1;
                                    $dosyaAdıE2 = $_FILES["Ek2"]["name"];
                                    $dosyayoluE2 = $dosyayoluEkler."/".$dosyaAdıE2;
                                    $dosyaAdıE3 = $_FILES["Ek3"]["name"];
                                    $dosyayoluE3 = $dosyayoluEkler."/".$dosyaAdıE3;
                                    if(is_uploaded_file($_FILES["Ek1"]["tmp_name"])) {
                                        $move1 = move_uploaded_file($_FILES["Ek1"]["tmp_name"], $dosyayoluE1);
                                        if($move1) {
                                            echo 'Ek 1 başarıyla yüklendi. <br/>';
                                            if(is_uploaded_file($_FILES["Ek2"]["tmp_name"])) {
                                                $move2 = move_uploaded_file($_FILES["Ek2"]["tmp_name"], $dosyayoluE2);
                                                if($move2) {
                                                    echo 'Ek 2 başarıyla yüklendi. <br/>';
                                                    if(is_uploaded_file($_FILES["Ek3"]["tmp_name"])) {
                                                        $move3 = move_uploaded_file($_FILES["Ek3"]["tmp_name"], $dosyayoluE3);
                                                        if($move3) {
                                                            echo 'Ek 3 başarıyla yüklendi. <br/>';
                                                            echo 'Tüm ekler başarıyla yüklendi. <br/>';
                                                        }  else {
                                                            $errorCode = 8;
                                                        }
                                                    }
                                                }  else {
                                                    $errorCode = 7;
                                                }
                                            }
                                        }  else {
                                            $errorCode = 6;
                                        }
                                    }
                                }  else {
                                    $errorCode = 5;
                                }
                            }
                        }  else {
                            $errorCode = 1;
                            unlink($dosyayoluD);
                        }
                    }
                }
            }  else {
                $errorCode = 3;
            }
        }
        else {
            $errorCode = 4;
        }
    }
    ?>
<meta http-equiv="refresh" content="5;URL=/Site/index.php">