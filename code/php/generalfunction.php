<?php
    include '../../inputsecurity.php';
function reload($url) {
    ?><meta http-equiv="refresh" content="0;URL='<?php echo $url; ?>'"><?php
}
function timedReload($url, $time) {
    ?><meta http-equiv="refresh" content="<?php echo $time; ?>;URL='<?php echo $url; ?>'"><?php
}
function encryptedPassword($password) {
    $passwordU1 = sha1($password);
    $passwordU2 = sha1($passwordU1);
    $passwordS = sha1($passwordU2);
}
function encryptedVariable($var) {
    $varU1 = sha1($var);
    $varU2 = sha1($varU1);
    $varS = sha1($varU2);
    $output = $varS;
    return $output;
}
function inputClear($input) {
    $temizlik = new veritemizle();
    $temizlik -> temizle($input);
    $output = $temizlik->temizveri;
    return $output;
}
?>