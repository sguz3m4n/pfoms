<!DOCTYPE html>
<?php
include '../../../../dbconfig.php';
include '../../../../Classes/Event.php';
$q = $_GET['q'];
$conn = conn();

$sql = 'SELECT * FROM event WHERE CompanyName = "' . $q . '" AND DelFlg="N" AND Status="Active"';

$result = $conn->prepare($sql);
$result->execute();
$eventinst = new BarcomModel\Event();
echo "<table boder='1'>";

// foreach($row = mysqli_fetch_assoc($result)){
//     
// }
 echo "</table>";
foreach ($result as $value) {
    $eventinst->EventName = $value["EventName"];
            $eventinst->EventDate = $value["EventDate"];
            $eventinst->EventCost = $value["EventCost"];
            $eventinst->Comments = $value["Comments"];
//            $eventinst->EventId = $value["EventId"];
//            $eventinst->CompanyId = $value["CompId"];
//            $eventinst->CompanyName = $value["CompName"];
//            $eventinst->ContactName = $value["ContactName"];
//            $eventinst->ContactNumber = $value["PhoneNumber"];
//            $eventinst->ContactEmail = $value["Email"];
//   $eventinst->RecEntered = $value['RecEntered'];
//    $eventinst->RecEnteredBy = $value['RecEnteredBy'];
//    $eventinst->RecModified = $value['RecModified'];
//    $eventinst->RecModifiedBy = $value['RecModifiedBy'];
//    $eventinst->Status = $value['Status'];
//    $eventinst->DelFlg = $value['DelFlg'];
    //$compinst->CompanyAddress = '<br>' . $compinst->AddressLine1 . '<br>' . $compinst->AddressLine2 . '<br>' . $compinst->AddressLine3 . '<br>' . $compinst->Parish;
}

$conn = NULL;

//function AddressBuilder() {
//    $Address = 'make address builder function';
//    return;
//}

//$model = new \BarcomModel\Event();
//$parishes = $model->GetParishes();
?>  
<!--
<div class="panel panel-info">
    <div class="panel-heading">
        <center>
            <h3> 
                <span class="label label-info"><?php echo $compinst->CompanyName; ?></span>           
                <span class="label label-info"><?php echo $compinst->CompanyId; ?></span>                
            </h3>  
        </center>
        <ul style="list-style: none">
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Contact: </label><?php echo $compinst->ContactName; ?></li> 
            <li><span class="glyphicon glyphicon-send"></span> <label>Address </label><?php echo $compinst->CompanyAddress; ?></li>                        
            <li><span class="glyphicon glyphicon-phone"></span><label>Phone </label><?php echo $compinst->PhoneNumber; ?></li> 
            <li><span class="glyphicon glyphicon-print"></span><label>Fax </label><?php echo $compinst->FaxNumber; ?></li>            
            <li><label>Email </label><a href="mailto:<?php echo $compinst->Email; ?>"> <?php echo $compinst->Email; ?> </a></li>
        </ul>
    </div>
</div>
<center>
    <div class="row">
         Trigger the modal with a button 
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Company</button>
    </div> 
</center> 
<form action="/company/deactivate" method="post">
    <input type="hidden" name="CompanyId" value="<?php echo $compinst->CompanyId; ?>">
    <input type="hidden" name="CompanyName" value="<?php echo $compinst->CompanyName; ?>">
    <button type="submit" class="btn btn-danger btn-default pull-right col-xs-3" name="btn-delete"><strong>Delete Company</strong></button> 
</form>
 Modal  
<form method="post">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
                 Modal content
                <div class="modal-content">
                <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Company Details</h4>
                      </div>
                      <div class="modal-body">
                    <center> <span class="label label-info">Company Id <?php echo $compinst->CompanyId; ?></span></center>
                    <div class="row center-block panel-body">
                        <div class="col-xs-8">
                            <label>Company Name</label>
                            <input type="text" class="form-control" name="CompanyName" value="<?php echo $compinst->CompanyName; ?>"  >
                        </div>
                        <div class="col-xs-3">
                            <label>Caipo ID</label>
                            <input type="text" class="form-control" name="CaipoId" value="<?php echo $compinst->CaipoId; ?>"  >

                            <label>Company TIN</label>
                            <input type="text" class="form-control" name="TIN" value="<?php echo $compinst->TIN; ?>"  >
                            <input type="hidden" name="CompanyId" value="<?php echo $compinst->CompanyId; ?>">
                        </div>
                    </div>
                    <div class="row center-block panel-body">
                        <div class="col-xs-4"> 
                            <label>Apt / House #</label>
                            <input type="text" class="form-control" name="AddressLine1" value="<?php echo $compinst->AddressLine1; ?>"   >
                        </div>
                        <div class="col-xs-4"> 
                            <label>Street</label>
                            <input type="text" class="form-control" name="AddressLine2" value="<?php echo $compinst->AddressLine2; ?>"   >
                        </div>
                        <div class="col-xs-4"> 
                            <label>District</label>
                            <input type="text" class="form-control" name="AddressLine3" value="<?php echo $compinst->AddressLine3; ?>"  >
                        </div>
                    </div>
                    <div class="row center-block panel-body">
                        <div class="col-xs-6">
                            <label>Parish</label>
                            <select name="Parish" class="form-control">
                                <option><?php echo $compinst->Parish; ?></option>
                                <?php
                                echo $parishes;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label>Postal Code</label>
                            <input type="text" class="form-control" name="PostalCode" value="<?php echo $compinst->PostalCode; ?>"   />
                        </div>
                    </div>
                    <div class="row center-block panel-body">
                        <div class="col-xs-4"> 
                            <label>Contact Name</label>
                            <input type="text" class="form-control" name="ContactName" value="<?php echo $compinst->ContactName; ?>" > 

                        </div>
                        <div class="col-xs-8"> 

                        </div>                        
                    </div>
                    <div class="row center-block panel-body">
                        <div class="col-xs-3">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="PhoneNumber" value="<?php echo $compinst->PhoneNumber; ?>" placeholder="888-8888"  >
                        </div>
                        <div class="col-xs-3">
                            <label>Fax</label>
                            <input type="text" class="form-control" name="FaxNumber" value="<?php echo $compinst->FaxNumber; ?>" placeholder="888-8888"  >
                        </div>
                        <div class="col-xs-6">
                            <label>Email</label>
                            <input type="text" class="form-control" name="Email" value="<?php echo $compinst->Email; ?>" placeholder="example@domain"  >  
                        </div>
                        <div class="col-xs-8">
                            <label for="Notes">Notes</label>
                            <textarea class="form-control" rows="4" columns="5" name="Notes" type="text" value="" name="Notes"><?php echo $compinst->Notes; ?></textarea>   
                        </div>
                    </div>                         
                          <div class="modal-footer">
                        <center>
                            <button type="submit" class="btn btn-default green" name="btn-update"><strong>Update Company</strong></button> 
                        </center>
                          </div>                      
                        </div>
                  </div>
        </div> 
    </div>  
</form>

 -->



