<?php include 'connect.php'; $Uid = $_SESSION["Uid"]; $UfindQ = @mysql_query("select * from users WHERE Id LIKE '$Uid'"); $Ufind = @mysql_fetch_array($UfindQ); ?>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../css/profiledit.png" class="img-circle img-responsive"> </div>
                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>İsim:</b></td>
                        <td><?php echo $Ufind["Ad"]; ?></td>
                      </tr>
                      <tr>
                        <td><b>Soyisim:</b></td>
                        <td><?php echo $Ufind["Soyad"]; ?></td>
                      </tr>
                      <tr>
                        <td><b>İl/İlçe</b></td>
                        <td><?php echo $Ufind["bolge"]." / ".$Ufind["il"]; ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td><b>Kurum</b></td>
                        <td><?php $kurumID = $Ufind["kurum"]; $bulkurumQ = @mysql_query("SELECT * from kurum WHERE kurum LIKE '$kurumID'"); while ($bulkurum = @mysql_fetch_array($bulkurumQ)) { echo $bulkurum["KurumAd"]; } ?></td>
                      </tr>
                        <tr>
                        <td><b>Yetki</b></td>
                        <td><?php $mevkiID = $Ufind["mecki"]; $bulmevkiQ = @mysql_query("SELECT * from mevki WHERE mevkiID LIKE '$mevkiID'"); while ($bulmevki = @mysql_fetch_array($bulmevkiQ)) { echo $bulmevki["mevki"]; } ?></td>
                      </tr>
                      <tr>
                      </tr>
                      </tr>
                      </tbody>
                      </table>
                  
                  
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
            
          </div>
        </div>
    