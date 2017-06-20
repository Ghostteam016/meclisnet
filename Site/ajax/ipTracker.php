<?php
$Ipbaglanti = @mysql_connect('localhost', 'meclisne_system', 'Xap#6w}Z}Bq.');
$userId = $goster["Id"];
$tableName = "user".$userId;
if($_SESSION["ipsaved"]) {
    
}else {
$Ipveritabani = @mysql_select_db('meclisne_usersIp',$Ipbaglanti);
$sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
  `id` int(11) NOT NULL auto_increment,
  `date` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$b = mysql_query($sql);
if ($b) // mysql_query $b tarafında if döngüsüne sokuldu.
{
    //echo "Tablo oluşturma işlemleri başarıyla sağlandı.";
    /*function GetIP(){
            if(getenv("HTTP_CLIENT_IP")) {
                    $ip = getenv("HTTP_CLIENT_IP");
            }else if(getenv("HTTP_X_FORWARDED_FOR")) {
                    $ip = getenv("HTTP_X_FORWARDED_FOR");
                    if (strstr($ip, ',')) {
                            $tmp = explode (',', $ip);
                            $ip = trim($tmp[0]);
                    }
            } else {
            $ip = getenv("REMOTE_ADDR");
            }
            return $ip;
    }
    $userIp = GetIP();*/
    $userIp = $_SERVER['REMOTE_ADDR'];
    $loginDate = date('d.m.Y H:i:s');
    $ıpCreate = @mysql_query("INSERT INTo $tableName (date,ip) VALUES ('$loginDate','$userIp')");
    if($ıpCreate) {
        //echo 'Ip adresi girildi.';
        $ipSaved = 1;
        $_SESSION["ipsaved"] = $ipSaved;
    }else {
        echo "Ip adresi kaydedilemedi.".@mysql_error();
    }
}  else {
    //echo 'Tablo oluşturulamadı.'.@mysql_error();
}
}
//mysql_close($Ipbaglanti);
?>