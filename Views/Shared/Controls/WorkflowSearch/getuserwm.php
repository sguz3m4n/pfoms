<!DOCTYPE html>
<?php
include '../../../../dbconfig.php';
include '../../../../Classes/Workflow.php';
$q = $_GET['q'];
$conn = conn();

$sql = 'SELECT * FROM workflow WHERE RoleName = "' . $q . '" AND DelFlg="N"';

$result = $conn->prepare($sql);
$result->execute();
$compinst = new BarcomModel\Workflow();

foreach ($result as $value) {
    $compinst->RoleId = $value['RoleId'];
    $compinst->RoleName = $value['RoleName'];
    
    $compinst->Comments = $value['Comments'];
    
    $compinst->CompStatus = $value['CompStatus'];
    $compinst->RecEntered = $value['RecEntered'];
    $compinst->RecEnteredBy = $value['RecEnteredBy'];
    $compinst->RecModified = $value['RecModified'];
    $compinst->RecModifiedBy = $value['RecModifiedBy'];
    $compinst->DelFlg = $value['DelFlg'];
}

$conn = NULL;


$model = new \BarcomModel\Workflow();
$parishes = $model->GetParishes();
?>  
<div class="panel panel-info">
    <div class="panel-heading">
        <center>
            <h3> 
                <span class="label label-info"><?php echo $compinst->RoleName; ?></span>           
                <span class="label label-info"><?php echo $compinst->RoleId; ?></span>                
            </h3>  
        </center>
        <ul style="list-style: none">
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Comment: </label><?php echo $compinst->Comments; ?></li> 
        </ul>
    </div>
</div>
<center>
    <div class="row">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Workflow</button>
    </div> 
</center> 
<form action="/workflow/deactivate" method="post">
    <input type="hidden" name="RoleId" value="<?php echo $compinst->RoleId; ?>">
    <input type="hidden" name="RoleName" value="<?php echo $compinst->RoleName; ?>">
    <button type="submit" class="btn btn-danger btn-default pull-right col-xs-3" name="btn-delete"><strong>Delete Workflow</strong></button> 
</form>
<!-- Modal --> 
<form method="post">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Workflow Details</h4>
                      </div>
                      <div class="modal-body">
                    <center> <span class="label label-info">Workflow Id <?php echo $compinst->RoleId; ?></span></center>
                    <div class="row center-block panel-body">
                        <div class="col-xs-8">
                            <label>Workflow Name</label>
                            <input type="text" class="form-control" name="RoleName" value="<?php echo $compinst->RoleName; ?>"  >
                        </div>

                        <div class="col-xs-3">
                            <label>Category</label>
                            <input type="text" class="form-control" name="Comments" value="<?php echo $compinst->Comments; ?>"  >

                            <input type="hidden" name="RoleId" value="<?php echo $compinst->RoleId; ?>">
                        </div>
                    </div>
                                             
                    <div class="modal-footer">
                      <center>
                          <button type="submit" class="btn btn-default green" name="btn-update"><strong>Update Workflow</strong></button> 
                      </center>
                    </div>                      
                </div>
            </div>
        </div> 
    </div>  
</form>

 



