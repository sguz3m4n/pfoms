<!DOCTYPE html>
<?php
include '../../../../dbconfig.php';
include '../../../../Classes/Event.php';
include '../../../../Classes/Approve.php';
//$q = $_GET['q'];

$conn = conn();

$sql = "SELECT event.`EventId`,`EventName`,`CompanyName`,`ContactName`,`ContactEmail`,`ContactNumber`,`EventDateStart`,`EventDateEnd`,proforma.EventCOst "
        . "FROM`event` as event ,`proforma` as proforma WHERE "
        . "event.EventId=proforma.EventId AND "
        . "event.Status='Approved' AND "
        . "event.DelFlg='N' ";

$result = $conn->prepare($sql);
$result->execute();

$eventinst = new PfomModel\Event();

foreach ($result as $value) {

    $eventinst->EventId = $value['EventId'];
    $eventinst->EventName = $value['EventName'];
    $eventinst->EventDateStart = $value['EventStartDate'];

    $eventinst->RecEntered = $value['RecEntered'];
    $eventinst->RecEnteredBy = $value['RecEnteredBy'];
    $eventinst->RecModified = $value['RecModified'];
    $eventinst->RecModifiedBy = $value['RecModifiedBy'];
    $eventinst->DelFlg = $value['DelFlg'];
}
$conn = NULL;
//$parishes = $model->GetParishes();
?>  
<div class="panel panel-info">
    <div class="panel-heading">
        <center>
            <h3> 
                <span class="label label-info"><?php echo $eventinst->Name; ?></span>           
                <span class="label label-info"><?php echo $eventinst->AccountId; ?></span>  
            </h3>  
        </center>
        <ul style="list-style: none">
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Type:  </label><?php echo $eventinst->Type; ?></li>  
        </ul>
    </div>
</div>
<center>
    <div class="row">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Account</button>
    </div> 
</center> 
<form action="/account/deactivate" method="post">
    <input type="hidden" name="AccountId" value="<?php echo $eventinst->AccountId; ?>">
    <input type="hidden" name="Name" value="<?php echo $eventinst->Name; ?>">
    <button type="submit" class="btn btn-danger btn-default pull-right col-xs-3" name="btn-delete"><strong>Delete Account</strong></button> 
</form>
<!-- Modal --> 
<form method="post" action="/account/edit">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Account Details</h4>
                      </div>
                      <div class="modal-body">
                    <center> <span class="label label-info">Account Id <?php echo $eventinst->AccountId; ?></span></center>
                    <div class="row center-block panel-body">
                        <div class="col-xs-8">
                            <label>Account Name</label>
                            <input type="text" class="form-control" name="Name" value="<?php echo $eventinst->Name; ?>"  >
                        </div>

                        <div class="col-xs-3">
                            <label>Type</label>
                            <input type="text" class="form-control" name="Type" value="<?php echo $eventinst->Type; ?>"  >
                            <input type="hidden" name="AccountId" value="<?php echo $eventinst->AccountId; ?>">

                        </div>
                    </div>
                          
                    <div class="modal-footer">
                        <center>
                            <button type="submit" class="btn btn-default green" name="btn-update"><strong>Update Account</strong></button> 
                        </center>
                    </div>                      
                </div>
            </div>
        </div> 
    </div>  
</form>

 



