<?php

function selectBg() {
    $bg = rand(1,19);
    switch ($bg) {
        case 1:
            $bgImage = "../../css/captcha/bg1.png";
            break;
        case 2:
            $bgImage = "../../css/captcha/bg2.png";
            break;
        case 3:
            $bgImage = "../../css/captcha/bg3.png";
            break;
        case 4:
            $bgImage = "../../css/captcha/bg4.png";
            break;
        case 5:
            $bgImage = "../../css/captcha/bg5.png";
            break;
        case 6:
            $bgImage = "../../css/captcha/bg6.png";
            break;
        case 7:
            $bgImage = "../../css/captcha/bg7.png";
            break;
        case 8:
            $bgImage = "../../css/captcha/bg8.png";
            break;
        case 9:
            $bgImage = "../../css/captcha/bg9.png";
            break;
        case 10:
            $bgImage = "../../css/captcha/bg10.png";
            break;
        case 11:
            $bgImage = "../../css/captcha/bg11.png";
            break;
        case 12:
            $bgImage = "../../css/captcha/bg12.png";
            break;
        case 13:
            $bgImage = "../../css/captcha/bg13.png";
            break;
        case 14:
            $bgImage = "../../css/captcha/bg14.png";
            break;
        case 15:
            $bgImage = "../../css/captcha/bg15.png";
            break;
        case 16:
            $bgImage = "../../css/captcha/bg16.png";
            break;
        case 17:
            $bgImage = "../../css/captcha/bg17.png";
            break;
        case 18:
            $bgImage = "../../css/captcha/bg18.png";
            break;
        case 19:
            $bgImage = "../../css/captcha/bg19.png";
            break;
    }
    return $bgImage;
}

function selectFt() {
    $x = rand(1, 6);
    switch ($x) {
        case 1:
            $output = "captcha0.ttf";
            break;
        case 1:
            $output = "captcha1.ttf";
            break;
        case 1:
            $output = "captcha2.ttf";
            break;
        case 1:
            $output = "captcha3.ttf";
            break;
        case 1:
            $output = "captcha4.ttf";
            break;
        case 1:
            $output = "captcha5.ttf";
            break;
    }
    return $output;
}

function passL() {
    $output = rand(4,8);
    return $output;
    //Giriş yapılan ip whiteliset'te ise ilk seferde captcha olmayacak.
    //İlk giriş hatalı ise yada ip whitelist'te değilse 4 hane'den başlayarak hane sayısı artacak.
    //İp adresi blacklist'te ise 8 ve üzeri haneler çıkacak (ip adresi whitelist'e alınana kadar).
}



	$sifre=substr(md5(rand()),0,passL());//rasgele bir metin oluşturuyoruz.

	

	$r=rand(0,255);

	$g=rand(0,255);

	$b=rand(0,255);//her sefer için farklı renk olması için rand ile değerler belirtiyoruz.

	

	$resim = @imagecreatefrompng(selectBg());//arkaplan için resim atıyoruz.

	$renk=imagecolorallocate ($resim, $r, $g, $b);//font rengini belirliyoruz.

	$font="../../css/captcha/fonts/".selectFt();//fontumuzu seçiyoruz.

	$font_boyutu=15;//font büyüklüğü

	$x=10;

	$y=30;//metnin pozisyonu

	$egim=10;//fontun eğimi

	

	imagettftext($resim, $font_boyutu, $egim, $x, $y, $renk, $font, $sifre);//yukardaki tüm değerleri birleştiriyoruz.

	

	header ('Content-type: image/png');//bu dosyanın resim dosyası olduğunu belirtiyoruz.

	

	imagepng($resim, NULL, 0);//resmi yazdırıyoruz.

	imagedestroy($resim);//resmi hafızandan siliyoruz.sunucu yorulmasın diye.



?>