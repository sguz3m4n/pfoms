<!DOCTYPE html>
<?php
include '../../../../dbconfig.php';
include '../../../../Classes/Equipment.php';
$q = $_GET['q'];

$conn = conn();

$sql = 'SELECT * FROM equipment WHERE ItemName = "' . $q . '" AND DelFlg="N"';

$result = $conn->prepare($sql);
$result->execute();

$compinst = new PfomModel\Equipment();

foreach ($result as $value) {
    $compinst->EquipmentId = $value['EquipmentId'];
    $compinst->ItemName = $value['ItemName'];
    
    $compinst->Category = $value['Category'];
    $compinst->UnitCost = $value['UnitCost'];
    $compinst->UnitMeasurement = $value['UnitMeasurement'];
    
    $compinst->CompStatus = $value['CompStatus'];
    $compinst->RecEntered = $value['RecEntered'];
    $compinst->RecEnteredBy = $value['RecEnteredBy'];
    $compinst->RecModified = $value['RecModified'];
    $compinst->RecModifiedBy = $value['RecModifiedBy'];
    $compinst->DelFlg = $value['DelFlg'];
}
$conn = NULL;
//$parishes = $model->GetParishes();
?>  
<div class="panel panel-info">
    <div class="panel-heading">
        <center>
            <h3> 
                <span class="label label-info"><?php echo $compinst->ItemName; ?></span>           
                <span class="label label-info"><?php echo $compinst->EquipmentId; ?></span>  
            </h3>  
        </center>
        <ul style="list-style: none">
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Category:  </label><?php echo $compinst->Category; ?></li> 
            <li><span class="glyphicon glyphicon-send"></span> <label>Unit Cost:  </label><?php echo $compinst->UnitCost; ?></li>                        
            <li><span class="glyphicon glyphicon-phone"></span><label>Unit Measurement:  </label><?php echo $compinst->UnitMeasurement; ?></li> 
        </ul>
    </div>
</div>
<center>
    <div class="row">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Equipment</button>
    </div> 
</center> 
<form action="/equipment/deactivate" method="post">
    <input type="hidden" name="EquipmentId" value="<?php echo $compinst->EquipmentId; ?>">
    <input type="hidden" name="ItemName" value="<?php echo $compinst->ItemName; ?>">
    <button type="submit" class="btn btn-danger btn-default pull-right col-xs-3" name="btn-delete"><strong>Delete Equipment</strong></button> 
</form>
<!-- Modal --> 
<form method="post" action="/equipment/edit">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Equipment Details</h4>
                      </div>
                      <div class="modal-body">
                    <center> <span class="label label-info">Equipment Id <?php echo $compinst->EquipmentId; ?></span></center>
                    <div class="row center-block panel-body">
                        <div class="col-xs-8">
                            <label>Equipment Name</label>
                            <input type="text" class="form-control" name="ItemName" value="<?php echo $compinst->ItemName; ?>"  >
                        </div>

                        <div class="col-xs-3">
                            <label>Category</label>
                            <input type="text" class="form-control" name="Category" value="<?php echo $compinst->Category; ?>"  >

                            <label>Unit Cost</label>
                            <input type="text" class="form-control" name="UnitCost" value="<?php echo $compinst->UnitCost; ?>"  >
                            <label>Unit Measurement</label>
                            <input type="text" class="form-control" name="UnitMeasurement" value="<?php echo $compinst->UnitMeasurement; ?>"  >
                            <input type="hidden" name="EquipmentId" value="<?php echo $compinst->EquipmentId; ?>">
                        </div>
                    </div>
                                             
                    <div class="modal-footer">
                      <center>
                          <button type="submit" class="btn btn-default green" name="btn-update"><strong>Update Equipment</strong></button> 
                      </center>
                    </div>                      
                </div>
            </div>
        </div> 
    </div>  
</form>

 



