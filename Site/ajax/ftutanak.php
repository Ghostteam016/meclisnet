<?php
                    if($_POST) {
                        echo "deneme";
                        if($_FILES["dosya"] && $_POST["il"]) {
                            echo "deneme2";
                            $dosyaAdı = $_FILES["dosya"]["name"];
                            $dosyayolu = "../../documents/tutanak/".$dosyaAdı;
                            $dosyaMimeType = $_FILES["dosya"]["type"];
                            if($dosyaMimeType == "application/pdf" || $dosyaMimeType == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $dosyaMimeType == "application/vnd.openxmlformats-officedocument.presentationml.presentation" || $dosyaMimeType == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $dosyaMimeType == "application/vnd.oasis.opendocument.text" || $dosyaMimeType == "application/vnd.oasis.opendocument.spreadsheet" || $dosyaMimeType == "application/vnd.oasis.opendocument.presentation" || $dosyaMimeType == "application/vnd.ms-powerpoint" || $dosyaMimeType == "application/vnd.ms-excel") {
                                echo 'deneme3';
                                if(is_uploaded_file($_FILES["dosya"]["tmp_name"])) {
                                    echo 'deneme4'."<br>".$_FILES["dosya"]["tmp_name"]."<br>".$dosyayolu;
                                    $move = move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyayolu);
                                    if($move) {
                                        echo "deneme5";
                                        echo "<b>{$dosyaAdı}</b> adlı dosya başarıyla yüklendi. <br/>";
                                        echo "<img src='http://localhost/meclisnet/{$dosyayolu}' alt='' />";
                                        $uploadedPerson = $goster["Tc"];
                                        $addFile = @mysql_query("insert into tutanak (Ad,yol,type,yukleyen) values ('$dosyaAdı','$dosyayolu','$dosyaMimeType','$uploadedPerson')");
                                        if($addFile) {
                                            echo "Dosya bilgileri sunucuya eklendi.";
                                        }else {
                                            $errorCode = 1;
                                        }
                                    }else {
                                        $errorCode = 2;
                                    }
                                }
                            }else {
                                $errorCode = 3;
                            }
                        }else {
                            $errorCode = 4;
                        }
                    }
                    ?>