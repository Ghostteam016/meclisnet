<script src="../js/bootstrap-filestyle.min.js"></script>
<div class="panel panel-primary">
  <div class="panel-heading">Tutanak</div>
  <div class="panel-body">
     <form class="form" action="ajax/ftutanak.php" method="POST" enctype="multipart/form-data">

<div class="form-group">

<div class="row">
<div class="col-md-3">
        <label for="id_tipo_equipo" class="control-label">il</label>
        <select name="il" id="il" class="js-example-basic-single" data-placeholder="İl seçiniz" required>	   <option value=""></option>
            <option></option>
                        <option value="<?php echo $goster["il"]; ?>">Benim İlim</option>
                        <?php
                        include "connect.php";
                    $Iilsecim = @mysql_query("select * from bolgeler");
                                $il = "null";
                            while ($ilsecim = @mysql_fetch_array($Iilsecim)) {
                                if($il != $ilsecim["il"]) {
                                ?> <option value="<?php echo $ilsecim["il"]; ?>"><?php echo $ilsecim["il"]; ?></option>
                                <?php }
                        $il = $ilsecim["il"];
                            } ?>
        </select>
    </div>

       <div class="col-md-3">
        <label for="id_tipo_equipo" class="control-label">İlçe</label>
        <select name="ilce" id="ilce" class="js-example-basic-single" data-placeholder="İlçe seçiniz" required>							            <option value=""></option>
            <option></option>
            <option value="<?php echo $goster["bolge"]; ?>">Benim İlcem</option>
            <?php
            $Iilsecim = @mysql_query("select * from bolgeler");
            $ilce = "null";
            $il = "null";
            while ($ilsecim = @mysql_fetch_array($Iilsecim)) {
                if($ilce != $ilsecim["ilce"] || $il != $ilsecim["il"]) {
                ?><option value="<?php echo $ilsecim["BolgeID"]; ?>" class="<?php echo $ilsecim["il"]; ?>"><?php echo $ilsecim["ilce"]; ?></option><?php
                $il = $ilsecim["il"];
                $ilce = $ilsecim["ilce"];
            }   }
            ?>
        </select>
    </div>

           
       <div class="col-md-6">
        <label for="id_tipo_equipo" class="control-label">Kurum</label>
        <select name="kurum" id="kurum" data-placeholder="kurum seçiniz" class="js-example-basic-single" tabindex="5">
              <option value=""></option>
              <?php
              $kurumBulQ = @mysql_query("select * from kurum");
              while ($kurumBul = @mysql_fetch_array($kurumBulQ)) { 
                  /*?><optgroup label="<?php echo $kurumBul["Kurumtur"]; ?>" <?php*/
                  ?><option value="<?php echo $kurumBul["KurumID"]; ?>" class="<?php echo $kurumBul["KurumBolgeID"]; ?>"><?php echo $kurumBul["KurumAd"]; ?></option><?php
              }
              ?>
            </select>
        </div>
</div>
<hr>
<div class="row">
 <h4>Lütfen Tutanak örneğini seçiniz:</h4>
 <input name="dosya" id="dosya" type="file" class="filestyle" data-input="false">
</div>


<hr>

 <h4>Lütfen Yetkili Seçiniz:</h4>
 <select name="yetkili" id="yetkili" data-placeholder="Göndermek istediğiniz yetkili/yetkililer"  multiple class="js-example-basic-single" tabindex="8" style=width:450px;>
            <option value=""></option>
            <?php
            $kullanıcıBulQ = @mysql_query("select * from users");
            while ($kullanıcıBul = @mysql_fetch_array($kullanıcıBulQ)) {
                ?><option value="<?php echo $kullanıcıBul["Id"]; ?>" class="<?php echo $kullanıcıBul["kurum"]; ?>"><?php echo $kullanıcıBul["Ad"]." ".$kullanıcıBul["Soyad"]; ?></option><?php
            }
            ?>
          </select>
       
  </div>
        <input name="send" type="submit" value="Gönder" class="btn btn-primary"/>
       
     </form>

</div>



  </form>
   </div>  
  
</div>



<script>





$(document).ready(function() {
  $(".js-example-basic-single").select2();
});

$("#ilce").chained("#il");
$("#kurum").chained("#ilce");
$("#yetkili").chained("#kurum");
      
$.validator.setDefaults({ ignore: ":hidden:not(select)" });
	$('form').validate({
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});




$(":file").filestyle({input: false});

</script>

