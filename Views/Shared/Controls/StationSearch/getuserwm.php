<!DOCTYPE html>
<?php
include '../../../../dbconfig.php';
include '../../../../Classes/Station.php';
$q = $_GET['q'];
$conn = conn();

$sql = 'SELECT * FROM station WHERE StationName = "' . $q . '" AND DelFlg="N"';

$result = $conn->prepare($sql);
$result->execute();
$compinst = new BarcomModel\Station();

foreach ($result as $value) {
    $compinst->StationId = $value['StationId'];
    $compinst->StationName = $value['StationName'];
    
    $compinst->CompStatus = $value['CompStatus'];
    $compinst->RecEntered = $value['RecEntered'];
    $compinst->RecEnteredBy = $value['RecEnteredBy'];
    $compinst->RecModified = $value['RecModified'];
    $compinst->RecModifiedBy = $value['RecModifiedBy'];
    $compinst->DelFlg = $value['DelFlg'];
}

$conn = NULL;

function AddressBuilder() {
    $Address = 'make address builder function';
    return;
}

$model = new \BarcomModel\Station();
$parishes = $model->GetParishes();
?>  
<div class="panel panel-info">
    <div class="panel-heading">
        <center>
            <h3> 
                <span class="label label-info"><?php echo $compinst->StationName; ?></span>           
                <span class="label label-info"><?php echo $compinst->StationId; ?></span>                
            </h3>  
        </center>
        <ul style="list-style: none">
        </ul>
    </div>
</div>
<center>
    <div class="row">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Station</button>
    </div> 
</center> 
<form action="/station/deactivate" method="post">
    <input type="hidden" name="StationId" value="<?php echo $compinst->StationId; ?>">
    <input type="hidden" name="StationName" value="<?php echo $compinst->StationName; ?>">
    <button type="submit" class="btn btn-danger btn-default pull-right col-xs-3" name="btn-delete"><strong>Delete Station</strong></button> 
</form>
<!-- Modal --> 
<form method="post">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Station Details</h4>
                      </div>
                      <div class="modal-body">
                    <center> <span class="label label-info">Station Id <?php echo $compinst->StationId; ?></span></center>
                    <div class="row center-block panel-body">
                        <div class="col-xs-8">
                            <label>Station Name</label>
                            <input type="text" class="form-control" name="StationName" value="<?php echo $compinst->StationName; ?>"  >
                        </div>

                        <div class="col-xs-3">
                             <input type="hidden" name="StationId" value="<?php echo $compinst->StationId; ?>">
                        </div>
                    </div>
                                             
                    <div class="modal-footer">
                      <center>
                          <button type="submit" class="btn btn-default green" name="btn-update"><strong>Update Station</strong></button> 
                      </center>
                    </div>                      
                </div>
            </div>
        </div> 
    </div>  
</form>

 



