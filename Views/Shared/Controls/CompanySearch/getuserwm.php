<!DOCTYPE html>
<?php
include '../../../../dbconfig.php';
include '../../../../Classes/Company.php';

$q = $_GET['q'];
$conn = conn();

$sql = 'SELECT * FROM company WHERE CompanyName = "' . $q . '" AND DelFlg="N"';

$result = $conn->prepare($sql);
$result->execute();
$compinst = new PfomModel\Company();
$resultcontact;
if (!empty($result)) {
    foreach ($result as $value) {
        $compinst->CompanyId = $value['CompanyId'];
        $compinst->CaipoId = $value['CaipoId'];
        $compinst->TIN = $value['TIN'];
        $compinst->CompanyName = $value['CompanyName'];
        $compinst->AddressLine1 = $value['AddressLine1'];
        $compinst->AddressLine2 = $value['AddressLine2'];
        $compinst->AddressLine3 = $value['AddressLine3'];
        $compinst->Parish = $value['Parish'];
        $compinst->PostalCode = $value['PostalCode'];
        $compinst->ContactName = $value['ContactName'];
        $compinst->PhoneNumber = $value['PhoneNumber'];
        $compinst->FaxNumber = $value['FaxNumber'];
        $compinst->Email = $value['Email'];
        $compinst->Notes = $value['Notes'];

        $compinst->CompStatus = $value['CompStatus'];
        $compinst->RecEntered = $value['RecEntered'];
        $compinst->RecEnteredBy = $value['RecEnteredBy'];
        $compinst->RecModified = $value['RecModified'];
        $compinst->RecModifiedBy = $value['RecModifiedBy'];
        $compinst->DelFlg = $value['DelFlg'];
        $compinst->CompanyAddress = '<br>' . $compinst->AddressLine1 . '<br>' . $compinst->AddressLine2 . '<br>' . $compinst->AddressLine3 . '<br>' . $compinst->Parish;

        $sqlcontact = 'SELECT * FROM contact WHERE CompanyId ="' . $compinst->CompanyId . '"';
        $resultcontact = $conn->prepare($sqlcontact);
        $resultcontact->execute();
    }
}

$conn = NULL;

function AddressBuilder() {
    $Address = 'make address builder function';
    return;
}

$model = new \PfomModel\Company();
$parishes = $model->GetParishes();
?>  
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <center>
                    <h3> 
                        <span class="label label-info"><?php echo $compinst->CompanyName; ?></span>           
                        <span class="label label-info"><?php echo $compinst->TIN; ?></span>                
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
    </div>
    <div class="col-md-6">
        <a id="addrank" class="btn btn-default green" data-toggle="modal" data-target="#mycontactModal">Add Contact <i class="glyphicon glyphicon-plus"></i>
        </a>
        <div class="pillwrapper" id="pillcontainer">
            <ul class="nav nav-pills nav-stacked" id="pillwrapper">  
                <br>
                <?php foreach ($resultcontact as $value1) : ?>
                  
                    <li id="<?php echo $value1['ContactId']; ?>">
                        <a style="bold">Contact- <?php echo $value1['ContactName']; ?> Email <?php echo $value1['ContactEmail']; ?> <?php echo $value1['ContactNumber']; ?><span class="glyphicon glyphicon-minus"></span></a>
                    </li>
                <?php endforeach; ?>


            </ul>
        </div>
    </div>
</div>

<center>
    <div class="row">

        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Company</button>
    </div> 
</center> 
<form action="/company/deactivate" method="post">
    <input type="hidden" name="TIN" value="<?php echo $compinst->TIN; ?>">
    <input type="hidden" name="CompanyName" value="<?php echo $compinst->CompanyName; ?>">
    <button type="submit" class="btn btn-danger btn-default pull-right col-xs-3" name="btn-delete"><strong>Delete Company</strong></button> 
</form>
<!-- Modal --> 
<form method="post">
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Company Details</h4>
                      </div>
                      <div class="modal-body">
                    <center> <span class="label label-info">TAMIS ID<?php echo $compinst->TIN; ?></span></center>
                    <div class="row center-block panel-body">
                        <div class="col-xs-8">
                            <label>Company Name</label>
                            <input type="text" class="form-control" name="CompanyName" value="<?php echo $compinst->CompanyName; ?>"  >
                        </div>
                        <div class="col-xs-3">
                            <label>Caipo ID</label>
                            <input type="text" class="form-control" name="CaipoId" value="<?php echo $compinst->CaipoId; ?>"  >

                            <!--                            <label>Company TIN</label>
                                                        <input type="text" class="form-control" name="TIN" value="<?php echo $compinst->TIN; ?>"  >-->
                            <input type="hidden" name="TIN" value="<?php echo $compinst->TIN; ?>">
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
    <div><input id="contactlist" name="contactlist" class="form-control" type="hidden" ></div>
</form>


 



