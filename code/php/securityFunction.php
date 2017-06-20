<?php
function loginCorrectionWE() {
    echo "deneme";
    $input1 = rand(1,2);
    if($input1 == 1) {
        echo "Doğum Günü: ";
        echo '<select name="input1" id="input1" placeholder="Doğum Günü">';
        for ($i = 0; $i <= 31; $i++) {
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
        echo '</select>';
    }else if($input1 == 2) {
        echo "Doğum Ayı: ";
        echo '<select name="input1" id="input1" placeholder="Doğum Ayı">';
        /*for ($i = 0; $i <= 31; $i++) {
            echo '<option value="'.$i.'">'.$i.'</option>';
        }*/
        ?>
<option value="ocak">Ocak</option>
<option value="şubat">Şubat</option>
<option value="mart">Mart</option>
<option value="nisan">Nisan</option>
<option value="mayıs">Mayıs</option>
<option value="haziran">Haziran</option>
<option value="temmuz">Temmuz</option>
<option value="ağustos">Ağustos</option>
<option value="eylül">Eylül</option>
<option value="ekim">Ekim</option>
<option value="kasım">Kasım</option>
<option value="aralık">Aralık</option>
            <?php
        echo '</select>';
    }
    echo "<br/>";
    $input2 = rand(1,2);
    if($input2 == 1) {
        echo 'Cilt No: ';
        echo '<input name="ciltNo" id="ciltNo" type="text" placeholder="Cilt No"/>';
    }else if($input2 == 2){
        echo 'Aile Sıra No: ';
        echo '<input name="aileSıraNo" id="aileSıraNo" type="text" placeholder="Cilt No"/>';
    }
    echo '<br/>';
    $input3 = rand(1,2);
    if($input3 == 1) {
        $nufüsIl = $goster["nüfusİl"];
        $ilceBulQ = @mysql_query("select * from bolgeler WHERE il LIKE '$nufüsİl'");
        echo 'Nüfusa Kayıtlı Olunan İlçe: ';
        echo '<select name="input3" id="input3" placeholder="Nüfusa Kayıtlı Olunan İlçe">';
        while ($ilceBul = @mysql_fetch_array($ilceBulQ)) {
            echo '<option value="'.$ilceBul["ilce"].'">'.$ilceBul["ilce"].'</option>';
        }
        echo '</select>';
    }else if($input3 == 2) {
        echo "Doğum yılı: ";
        echo '<select name="input3" id="input3" placeholder="Doğum Yılı">';
        for($yil = 2015; $yil > 1990; $yil--) {
            echo '<option value="'.$yil.'">'.$yil.'</option>';
        }
        echo '</select>';
    }
}
?>