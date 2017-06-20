<div class="panel panel-primary">
  <div class="panel-heading">Mesaj</div>
  <div class="panel-body fixed-panel">
  <form id="mesaj" name="mesaj" method="POST">

<div class="form-group">

<div class="row">
<div class="col-md-3">
        <label for="id_tipo_equipo" class="control-label">il</label>
        <select name="il" id="il" class="js-example-basic-single" data-placeholder="İl seçiniz" required>    <option value=""></option>
           <option value="">--</option>
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
        <label for="id_tipo_equipo" class="control-label">Tipo</label>
        <select name="ilce" id="ilce" class="js-example-basic-single" data-placeholder="[Tipo]" required>                         <option value=""></option>
            <option value="">--</option>
  <?php
            $Iilsecim = @mysql_query("select * from bolgeler");
            $ilce = "null";
            $il = "null";
            while ($ilsecim = @mysql_fetch_array($Iilsecim)) {
                if($ilce != $ilsecim["ilce"] || $il != $ilsecim["il"]) {
                ?><option value="<?php echo $ilsecim["BolgeID"]; ?>" class="<?php echo $ilsecim["il"]; ?>"><?php echo $ilsecim["ilce"]."/".$ilsecim["il"]; ?></option><?php
                $il = $ilsecim["il"];
                $ilce = $ilsecim["ilce"];
            }   }
            ?>
        </select>
    </div>

           
       <div class="col-md-6">
        <label for="id_tipo_equipo" class="control-label">Grup</label>
               <select id="kurum" name="kurum" data-placeholder="kurum seçiniz" class="js-example-basic-single" tabindex="2">
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

<div id="txtEditor">
    <div class="container-fluid">
      <div class="row">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 nopadding">
              <textarea id="txtEditor"></textarea> 

            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<hr>

 <h4>Lütfen Yetkili Seçiniz:</h4>

<select name="yetkili" id="yetkili" data-placeholder="Yetkili seçiniz"  multiple class="js-example-basic-single" tabindex="8" style=width:450px;>
            <option value=""></option>
            <?php
            $kullanıcıBulQ = @mysql_query("select * from users");
            while ($kullanıcıBul = @mysql_fetch_array($kullanıcıBulQ)) {
                ?><option value="<?php echo $kullanıcıBul["Id"]; ?>" class="<?php echo $kullanıcıBul["kurum"]; ?>"><?php echo $kullanıcıBul["Ad"]." ".$kullanıcıBul["Soyad"]; ?></option><?php
            }
            ?>
          </select>
       
  
    


<button name="btn" id="btn" type="submit" class="btn btn-primary">Gönder</button>
</form>
</div>



  </form>
   </div>  
  
</div>




<script>
$(document).ready(function(){
$("#btn").click(function(){
var vil = $("#il").val();
var vilce = $("#ilce").val();
var vkurum = $("#kurum").val();
var vyetkili = $("#yetkili").val();
var vmesaj = $("#txtEditor").val();
if(vil=='' && vilce=='' && vkurum=='' && vmesaj=='')
{
alert("Lütfen il,ilçe ve kurum seçiniz!");
}
else{
$.post("ajax/fdilekce.php", //Required URL of the page on server
{ // Data Sending With Request To Server
il:vil,
ilce:vilce,
kurum:vkurum,
yetkili:vyetkili,
mesaj:vmesaj
},
function(response,status){ // Required Callback Function
alert("*----Received Data----*\n\nResponse : " + response+"\n\nStatus : " + status);//"response" receives - whatever written in echo of above PHP script.
$("#form")[0].reset();
});
}
});
});
$(document).ready(function() {
        $("#txtEditor").Editor();
      })

$(document).ready(function() {
  $(".js-example-basic-single").select2();
});

$("#ilce").chained("#il");
$("#kurum").chained("#ilce");
$("#yetkili").chained("#kurum");

    

</script>











