<?php

include '../../../../dbconfig.php';
require '../../../../Classes/Proforma.php';
$conn = conn();
$sql = "SELECT proforma.EventCost,proforma.VATPoliceServices,proforma.PoliceServices,proforma.OperationalSupport,details.AssetName,details.Quantity,details.Hours,details.Value FROM `proforma` as proforma,`event` as event,`proformatransaction` as trans,`proformadetails` as details
WHERE proforma.EventId=event.EventId AND
trans.EventId=event.EventId AND
trans.TransId=trans.TransId AND
event.EventId='" . $_REQUEST['id'] . "' AND
event.Status='Registered';";





$compbalance;
$assetlisting = '';
if ($stmt = $conn->prepare($sql)) {
// Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $result = $stmt->fetchAll();
// Check number of rows in the result set
        if (!empty($result)) {
            $action = "/editpayment";
            $Eventid = $_REQUEST['id'] ;
            foreach ($result as $value) {
                $assetlisting = $assetlisting . '<div class="form-group col-xs-6">
                          <label for="assetname"><span class="glyphicon glyphicon-user"></span>Asset Name</label>
                          <input type="text" class="form-control" id="assetname" placeholder="" name="assetname"  readonly="readonly" value="' . $value['AssetName'] . '">
                        </div>
                        <div class="form-group col-xs-3">
                          <label for="quantity"><span class="glyphicon glyphicon-book"></span>Quantity</label>
                          <input type="number" min="0" class="form-control" id="quantity" name="quantity"  value="' . $value['Quantity'] . '">
                        </div>
                        <div class="form-group col-xs-3">
                          <label for="hours"><span class="glyphicon glyphicon-bullhorn"></span>Hours</label>
                          <input type="number" min="0" class="form-control" id="hours" name="hours" placeholder="Hours Worked" value="' . $value['Hours'] . '">
                          <label>' . $value['Value'] . '</label>                        
</div>';
            }

            echo

            '<div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="mdl"><span class="glyphicon glyphicon-lock"></span>Edit Proforma</h4>
                      <h5>' . $Eventid . '</h5>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                      <form role="form" action=' . $action . ' method="post">
                        <input type="hidden" class="form-control" id="eventid"  name="eventid" value=" . $EventId . ">
                     ' . $assetlisting . ' 
                        <div class="form-group col-xs-6"> 
                          <button type="submit" class="btn btn-success btn-block" id="update" name="update"><span class="glyphicon glyphicon-off"></span> Submit</button>
                        </div>
                        <div class="form-group col-xs-6"> 
                          <button type="button" class="btn btn-danger btn-default pull-left col-xs-12" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                  </div>

                </div>';
        } else {
            echo "ERROR: Not able to execute $sql. ";
        }
    }
}

// Close onnection
$conn = NULL;
?>