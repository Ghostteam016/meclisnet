  <div id="container2">
 <section class="content" id="inboxing">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#" id="inbox"><i class="fa fa-inbox" ></i> Mesaj Kutusu <span class="label label-primary pull-right">12</span></a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> Gönderilenler</a></li>
                    <li><a href="#"><i class="fa fa-file-text-o"></i> Taslaklar</a></li>
                    <li><a href="#"><i class="fa fa-trash-o"></i> Çöp</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Labels</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Önemli</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Resmi</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9" id="readmessage">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Inbox</h3>
                  <div class="box-tools pull-right ">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Mail">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding fixed-panel">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                      1-50/200
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                          <?php
                          include "connect.php";
                          $userId = $goster["Id"];
                          $findmesajQ = @mysql_query("select * from mesajlar WHERE alici LIKE '$userId'");
                          while ($findmesaj = @mysql_fetch_array($findmesajQ)) {
                          ?>
                        <tr>
                          <td><input type="checkbox"></td>
                          <td class="mailbox-star"><a href="#" ><i class="fa fa-star text-yellow"></i></a></td>
                          <td class="mailbox-name"><a href="#" id="read" ><?php $gonderenID = $findmesaj["gonderen"]; $findgonderenQ = @mysql_query("select * from users WHERE Id LIKE '$gonderenID'"); while ($findgonderen = @mysql_fetch_array($findgonderenQ)) { echo $findgonderen["Ad"]." ".$findgonderen["Soyad"]; } ?></a></td>
                          <td class="mailbox-subject"><b><?php echo $findmesaj["subject"]; ?></b> - <?php echo $findmesaj["mesaj"]; ?>...</td>
                          <td class="mailbox-attachment"></td>
                          <td class="mailbox-date"><?php echo $findmesaj["tarih"]; ?></td>
                        </tr>
                        <?php 
                          }
                         //Tutanak
                        $tutanakBilgiQ = @mysql_query("select * from tutanak");
                        while($tutanakBilgi = @mysql_fetch_array($tutanakBilgiQ)){
                        if($tutanakBilgi["available"] == 1) {
                        ?>
                        <tr>
                          <td><input type="checkbox"></td>
                          <td class="mailbox-star"><a href="<?php echo $sitename.$tutanakBilgi["yol"];?>" ><i class="fa fa-star text-yellow"></i></a></td>
                          <td class="mailbox-subject"><b><?php echo $tutanakBilgi["Ad"]; ?></b> - <?php echo $tutanakBilgi["aciklama"]; ?>...</td>
                          <td class="mailbox-attachment"></td>
                          <td class="mailbox-date"><?php echo $tutanakBilgi["tarih"]; ?></td>
                        </tr>
                        <?php } }
                        //dilekçe
if($goster["mevki"] > 20) {
    //echo "<img src='404.png'/><br/>";
    //echo "<h4>Ulaşmaya alıştığınız sayfayı bulamadık lütfen ana sayfaya dönünüz.</h4>";
}else if($goster["mevki"] <= 20) {
    $kullanıcıKurum = $goster["kurum"];
    $DilekceBulQ = @mysql_query("select * from dilekce WHERE GonderilenKurumID LIKE '$kullanıcıKurum'");
        while ($DilekceBul = @mysql_fetch_array($DilekceBulQ)) {
                    $DilekceAd = $DilekceBul["Ad"];
                    $yukleyenTc = $DilekceBul["yukleyen"];
                    $yukleyenBilgiQ = @mysql_query("select * from users WHERE Tc LIKE '$yukleyenTc'");
                    $yukleyenBilgi = @mysql_fetch_array($yukleyenBilgiQ);
                    ?>
                    <tr>
                          <td><input type="checkbox"></td>
                          <td class="mailbox-star"><a href="<?php echo $DilekceBul["yol"]; ?>" ><i class="fa fa-star text-yellow"></i></a></td>
                          <td class="mailbox-name"><a href="#" id="read" ><?php echo $yukleyenBilgi["Ad"]." ".$yukleyenBilgi["Soyad"]; ?></a></td>
                          <td class="mailbox-subject"><b><?php echo $DilekceAd; ?></b> - <?php echo $findmesaj["mesaj"]; ?>...</td>
                          <td class="mailbox-attachment"></td>
                          <td class="mailbox-date"><?php echo $DilekceBul["tarih"]; ?></td>
                        </tr> <?php
                }
}
?>
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                      1-50/200
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        </div>
       

    <script>
        $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
});
</script>