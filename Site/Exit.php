<?php
include 'connect.php';
session_destroy();
//setcookie("loginTC",$goster["TC"],time() - (60*60*24*30));
//setcookie("loginPassword",$goster["password"],time() - (60*60*24*30));
//include 'index.php';
?>
<meta http-equiv="refresh" content="0;URL=/index.php">