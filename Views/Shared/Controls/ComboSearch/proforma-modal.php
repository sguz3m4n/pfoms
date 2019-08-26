<?php

include '../../../../dbconfig.php';
require '../../../../Classes/Proforma.php';
$conn = conn();
$sql = "SELECT proforma.EventCost,proforma.VATPoliceServices,proforma.PoliceServices,proforma.OperationalSupport,details.AssetName,details.Quantity,details.Hours,details.Value,details.id,details.Rate,details.Type
FROM `proforma` as proforma,`event` as event,`proformadetails` as details
WHERE proforma.EventId=event.EventId AND
event.EventId='" . $_REQUEST['id'] . "' ;";


//trans.EventId=event.EventId AND


$compbalance;
$assetlisting = '';
$Eventid = $_REQUEST['id'];
if ($stmt = $conn->prepare($sql)) {
// Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $result = $stmt->fetchAll();
// Check number of rows in the result set
        if (!empty($result)) {
            $action = "/editproforma";

            $assetlisting = '';
            foreach ($result as $value) {
                if (($value['Hours'] == '') || ($value['Hours'] == 0)) {
                    $show = '';
                } else {
                    $show = ' <label for="hours">Hours</label>
                          <input type="number" min="0"  class="form-control" id="hours" name="hours" placeholder="Hours Worked" value="' . $value['Hours'] . '">';
                }
                $assetlisting = $assetlisting . '<div class="row"   id="' . $value['id'] . '">
                                          <form role="form" action="/editproforma?id=' . $value['id'] . '" method="post" >
                        <input type="hidden" class="form-control" id="eventid"  name="eventid" value="' . $Eventid . '">
                        <div class="form-group col-xs-6" >
                          <label for="assetname"><span class="glyphicon glyphicon-user"></span>Asset Name</label>
                          <input type="text" class="form-control" id="assetname" placeholder="" name="assetname"  readonly="readonly" value="' . $value['AssetName'] . '">
                        </div>
                        <div class="form-group col-xs-2">
                          <label for="quantity">Quantity</label>
                          <input type="number" min="0"  class="form-control" id="quantity" name="quantity"  value="' . $value['Quantity'] . '">
                        </div>
                        <div class="form-group col-xs-2">
                         ' . $show . '
                          <label value="' . $value['Value'] . '">Current ' . $value['Value'] . '</label>
                          <input type="hidden" id="value"  name="value" value="' . $value['Value'] . '">
                          <input type="hidden" id="rate"  name="rate" value="' . $value['Rate'] . '">
                          <input type="hidden" id="type"  name="type" value="' . $value['Type'] . '">
                          <input type="hidden" id="polserv"  name="polserv" value="' . $value['PoliceServices'] . '">
                          <input type="hidden" id="opssupp"  name="opssupp" value="' . $value['OperationalSupport'] . '">
                          <input type="hidden" id="vatpolserv"  name="vatpolserv" value="' . $value['VATPoliceServices'] . '"> 
                          <input type="hidden" id="eventcost"  name="eventcost" value="' . $value['EventCost'] . '">
                        </div>
                        <div class="form-group col-xs-2"> 
                          <button type="submit" class="btn btn-edit" id="update" name="update">Edit</button>
                        </div>
                           </form>
                        </div>';
            }
            echo
            '<div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content" id="proformaedit">
                    <div class="modal-header" style="padding:35px 50px;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="mdl"><span class="glyphicon glyphicon-lock"></span>Edit Proforma</h4>
                      <h5>' . $Eventid . '</h5>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">

                        ' . $assetlisting . '                     
                   
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