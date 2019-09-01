<!DOCTYPE html>
<style>
    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        /* Position the tooltip */
        position: absolute;
        z-index: 1;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
    }

</style>


<?php
include '../../../../dbconfig.php';
include '../../../../Classes/DutySheet.php';
$q = $_GET['q'];
$conn = conn();

//$sql = "SELECT * FROM `dutysheetevent` as dutysheet, `company` AS company WHERE
//dutysheet.CompanyId=company.CompanyId AND
//dutysheet.CompanyId='" . $q . "' AND
//dutysheet.Delflg='N';";
//$Compstmt = $conn->prepare($sql);
//$Compstmt->execute();
//$Comp_array = $Compstmt->fetchAll();
//
//foreach ($Comp_array as $Comp_value) {
//    $companyId = $Comp_value['CompanyId'];
//}
//Get all dutysheets for company
$sqlDutySheet =  "SELECT * FROM `dutysheetevent` as dutysheet, `company` AS company WHERE
dutysheet.CompanyId=company.CompanyId AND
company.CompanyName='" . $q . "' AND
dutysheet.Delflg='N';";
$stmtDutySheet = $conn->prepare($sqlDutySheet);
$stmtDutySheet->execute();
$result_DutySheet = $stmtDutySheet->fetchAll();


// duty sheet officers details
//$sqlDSpreacc = 'SELECT ForceNumber,Natregno,OfficerName, Hours, RateCode, PayRate FROM `dutysheetservices` '
//        . 'WHERE CompanyId = "' . $companyId . '" AND DelFlag="N" AND Status="Active"';
//$stmtDSpreacc = $conn->prepare($sqlDSpreacc);
//$stmtDSpreacc->execute();
//$result_DSpreaccarray = $stmtDSpreacc->fetchAll();
//
//        foreach ($result_array as $value) {
//            
//            //            $accountcode = $value['AccountId'];
//            $result .= "<option id='$accountcode' >" . $value['AccountName'] . "</option>";
//        }
//$stmt = $conn->prepare($sql);
//$stmt->execute();
//$TransActions = $stmt->fetchAll();

if (empty($result_DutySheet)) {
    ?>
    <style type="text/css">#HaveDutySheets{
            display:none;
        }</style>
        <?php
    } else {
        ?>
    <style type="text/css">#NoDutySheets{
            display:none;
        }</style>
        <?php
    }


    $dutysheetinst = new PfomModel\DutySheet();
    $conn = NULL;
    ?>  


<div class="panel panel-info">
    <div class="panel-heading" >


        <div class="eventList" id="HaveDutySheets">
            <center>                                                                                                                           
                <h3> 
                    <span class="label label-info">List of Active DutySheets for:</span> 
                    <span class="label label-info"><?php echo $q; ?></span> 

                </h3>  
            </center>
            <div>
                <center>
                    <button id="btnShowDutySheets" type="button" class="btn btn-info" data-toggle="collapse" data-target="#ListOfApprovedDutySheets,#divDutySheetDetails">Hide DutySheets</button>
                </center>

            </div> 
            <div class="col-md-6 collapse in" id ="ListOfApprovedDutySheets">
                <br>
                <div class="pillwrapper" id="pillcontainer">
                    <ul class="nav nav-pills nav-stacked" id="pillwrapper" >

                        <?php foreach ($result_DutySheet as $DutySheetId): ?>

                            <li class="<?= $DutySheetId['DutySheetId']; ?>">      
                                <a class="nav-link" id="liDutySheetId" name="<?= $DutySheetId['DutySheetId']; ?>"><?= $DutySheetId['DutySheetId']; ?></a>
                                <a class="nav-link" style="display:none" id="liEventId" href="#"><?= $DutySheetId['EventId']; ?></a>
                                <a class="nav-link" style="display:none" id="liEventName" href="#"><?= $DutySheetId['EventName']; ?></a>
                                <a class="nav-link" style="display:none" id="liOvertimeAmount" href="#"><?= $DutySheetId['OvertimeAmount']; ?></a>
                                <a class="nav-link" style="display:none" id="liHoursEngaged" href="#"><?= $DutySheetId['HoursEngaged']; ?></a>
                                <a class="nav-link" style="display:none" id="liDateOfDuty" href="#"><?= $DutySheetId['DateOfDuty']; ?></a>
                                <a class="nav-link" style="display:none" id="liDispatchTime" href="#"><?= $DutySheetId['DispatchTime']; ?></a>
                                <a class="nav-link" style="display:none" id="liArrivalTime" href="#"><?= $DutySheetId['ArrivalTime']; ?></a>
                                <a class="nav-link" style="display:none" id="liDismissalTime" href="#"><?= $DutySheetId['DismissalTime']; ?></a>
                                <a class="nav-link" style="display:none" id="liReturnTime" href="#"><?= $DutySheetId['ReturnTime']; ?></a>

<!--                                <?php foreach ($result_DSpreaccarray as $DSPA): ?>
                                    <a class="nav-link" style="display:none" id="liForceNumber" href="#"><?= $DSPA['ForceNumber']; ?></a>
                                    <a class="nav-link" style="display:none" id="liNatregno" href="#"><?= $DSPA['Natregno']; ?></a>
                                    <a class="nav-link" style="display:none" id="liOfficerName" href="#"><?= $DSPA['OfficerName']; ?></a>
                                    <a class="nav-link" style="display:none" id="liHours" href="#"><?= $DSPA['Hours']; ?></a>
                                    <a class="nav-link" style="display:none" id="liRateCode" href="#"><?= $DSPA['RateCode']; ?></a>
                                    <a class="nav-link" style="display:none" id="liPayRate" href="#"><?= $DSPA['PayRate']; ?></a>
                                <?php endforeach; ?>                                -->
                            </li>
                            <br>
                        <?php endforeach; ?>
                    </ul>   
                </div>

                <!--                <form action="/event/deactivate" method="post" style="display:none" id="formDeleteDutySheet">
                
                                    <input type="hidden" name="DutySheetName" id="hdnDutySheetName" value="">
                                    <input type="hidden" name="DutySheetId" id="hdnDutySheetId" value="">
                                    <center>
                                    <button type="submit" class="btn btn-danger" name="btn-delete" id="btnDelete"><strong>Delete DutySheet</strong></button> 
                                    </center>
                                </form>-->
            </div>
            <div class="col-md-6 collapse in" style="display:none" id="divDutySheetDetails"><br>
                <center>                                                                                                                           
                    <h3> 
                        <span class="label label-info">Duty Sheet Details:</span> 
                    </h3>  
                </center></button>
                <br>

                <ul style="list-style: none">
                    <li>
                        <label>Event Name: </label>
                        <label  id="DetailsEventName" name="DetailsEventName"></label>  
                        <br>
                        <label>Date of Duty: </label>
                        <label  id="DetailsDateOfDuty" name="DetailsDateOfDuty"> </label>   
                        <br>
                        <label>Dispatch Time: </label>
                        <label id="DetailsDispatchTime" name="DetailsDispatchTime"> </label>    
                        <br>
                        <label>Arrival Time: </label>
                        <label id="DetailsArrivalTime" name="DetailsArrivalTime"></label>    
                        <br>
                        <label>Dismissal Time: </label>
                        <label id="DetailsDismissalTime" name="DetailsDismissalTime"></label>    
                        <br>
                        <label>Return Time: </label>
                        <label id="DetailsReturnTime" name="DetailsReturnTime"></label>  
                        <br>
                        <label>Hours Engaged: </label>
                        <label id="DetailsHoursEngaged" name="DetailsHoursEngaged"></label>  
                        <br>
                        <label>Officers: </label>
                        <!--                        <label id="DetailsForceNumber" name="DetailsForceNumber"></label>  
                                                <br>
                                                <label id="DetailsOfficerName" name="DetailsOfficerName"></label>
                                                <br>
                                                <label id="DetailsForceNumber" name="DetailsForceNumber"></label>
                                                <br>
                                                <label id="DetailsRateCode" name="DetailsRateCode"></label>
                        -->
                    </li>
                </ul>
            </div>
        </div>
        <div class="eventList" id="NoDutySheets">
            <center>
                <h3> 
                    <span class="label label-info">No Active events for:</span> 
                    <span class="label label-info"><?php echo $q; ?></span>           
                </h3> 

            </center>
        </div>


    </div>

</div>












