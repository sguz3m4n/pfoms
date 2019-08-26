<?php

include '../../../../dbconfig.php';
require '../../../../Classes/Proforma.php';
$conn = conn();
$sql = "SELECT * FROM `dutysheetevent` as dutysheet ,`dutysheetservices` as services,`dutysheetopsupport` as support WHERE 
dutysheet.DutySheetId=+services.DutySheetId AND
services.DutySheetId=+support.DutySheetId AND
dutysheet.DelFlg='N' AND dutysheet.DutySheetId='" . $_REQUEST['duytsheetid'] . "';";




//trans.EventId=event.EventId AND


$compbalance;
$assetlisting = '';
$DutySheetId = $_REQUEST['duytsheetid'];
if ($stmt = $conn->prepare($sql)) {
// Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $result = $stmt->fetchAll();
// Check number of rows in the result set
        if (!empty($result)) {
            $action = "/editproforma";

            $assetlisting = '';
            foreach ($result as $value) {
          
                $assetlisting = $assetlisting . '<div class="row"   id="' . $value['DutySheetId'] . '">
                                          <form role="form" action="/editdutysheet?id=' . $value['DutySheetId'] . '" method="post" >
                        <input type="hidden" class="form-control" id="dutysheetid"  name="dutysheetid" value="' . $DutySheetId . '">
                        <div class="form-group col-xs-6" >
                          <label for="officername"><span class="glyphicon glyphicon-user"></span>Officer Name</label>
                          <input type="text" class="form-control" id="officername" placeholder="" name="officername"  readonly="readonly" value="' . $value['OfficerName'] . '">
                        </div>
                        <div class="form-group col-xs-2">
                          <label for="quantity">Acting</label>
                          <input type="checkbox" min="0"  class="form-control" id="acting" name="acting"  value="' . $value['Acting'] . '">
                        </div>
                        <div class="form-group col-xs-2">

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
                  <div class="modal-content" id="dutysheetedit">
                    <div class="modal-header" style="padding:35px 50px;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="mdl"><span class="glyphicon glyphicon-lock"></span>Edit Duty Sheet</h4>
                      <h5>' . $DutySheetId . '</h5>
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