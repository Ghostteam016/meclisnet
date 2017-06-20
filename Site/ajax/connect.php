<?php
$baglanti = @mysql_connect('localhost', 'meclisne_system', 'Xap#6w}Z}Bq.');
$veritabani = @mysql_select_db('meclisne_databates');
@mysql_query("SET NAMES UTF8");
$sitename = "http://www.meclisnet.com/Site";
session_start();
if($_SESSION["goster"]) {
    $goster = $_SESSION["goster"];
}else {
    echo '<meta http-equiv="refresh" content="0;URL=/index.php">';
    die("GİRİŞ YAPMADINIZ!!!");
}
date_default_timezone_set('Europe/Istanbul');
?>