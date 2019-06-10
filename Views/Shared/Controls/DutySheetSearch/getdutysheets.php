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
$Id = "Id";

//$sql = 'SELECT EventId, EventName, CompanyName, EventCost, EventDateStart, EventDateEnd, Comments, CompanyId, Division, OperationalSupport, PoliceServices, VATPoliceServices FROM event WHERE CompanyName = "' . $q . '" AND DelFlg="N" AND Status="Approved"';
//$sql = 'SELECT `a.EventId,`EventName,`eventCost`,`CompanyId`,`CompanyName`,'$EventDateStart','$EventDateEnd',
//    `ContactEmail`,`ContactNumber`,`EventDate`,`Comments`, AccountId, AccountName, TranId, TranAmt, b.EventId as "' . $Id . '" 
//FROM `event` a LEFT JOIN preaccounttransactions b ON a.EventId = b.EventId';
//$sql = 'SELECT * FROM `event` a LEFT JOIN preaccounttransactions b ON a.EventId = b.EventId';

//
//$stmt = $conn->prepare($sql);
//$stmt->execute();
//$EventIds = $stmt->fetchAll();
//
//Get Company ID
$sql = 'SELECT CompanyId FROM `company` WHERE CompanyName = "' . $q . '" AND DelFlg="N"';
$Compstmt = $conn->prepare($sql);
$Compstmt->execute();
$Comp_array = $Compstmt->fetchAll();

foreach ($Comp_array as $Comp_value) {
$companyId = $Comp_value['CompanyId'];
}
//Get all dutysheets for company
$sqlDutySheet = 'SELECT DutySheetId, EventId, EventName, OvertimeAmount, DateOfDuty, DispatchTime, ArrivalTime, DismissalTime, ReturnTime, '
        . 'TotalHoursWorked FROM dutysheet WHERE CompanyId = "' . $companyId . '" AND DelFlag="N" AND Status="Active"';
$stmtDutySheet = $conn->prepare($sqlDutySheet);
$stmtDutySheet->execute();
$result_DutySheet = $stmtDutySheet->fetchAll();


// This is for breakdown of event details
$sql = 'SELECT EventId, CompanyId, AssetName, SUM(Value) as Value, SUM(Quantity)as Quantity FROM `eventpreaccount` WHERE CompanyName = "' . $q . '" AND DelFlag="N" GROUP by AssetName';
$stmt = $conn->prepare($sql);
$stmt->execute();
$result_array = $stmt->fetchAll();
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


    $dutysheetinst = new BarcomModel\DutySheet();
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

                        <?php foreach ($DutySheetIds as $DutySheetId): ?>

                            <li class="<?= $DutySheetId['DutySheetId']; ?>">      
                                <a class="nav-link" id="liDutySheetName" name="<?= $DutySheetId['DutySheetName']; ?>"><?= $DutySheetId['DutySheetName']; ?></a>
                                <a class="nav-link" style="display:none" id="liDutySheetId" href="#"><?= $DutySheetId['DutySheetId']; ?></a>
                                <a class="nav-link" style="display:none" id="liDutySheetCost" value="<?= $DutySheetId['DutySheetCost']; ?>" href="#"><?= $DutySheetId['DutySheetCost']; ?></a>
                                <a class="nav-link" style="display:none" id="liDutySheetDateStart" href="#"><?= $DutySheetId['DutySheetDateStart']; ?></a>
                                <a class="nav-link" style="display:none" id="liDutySheetDateEnd" href="#"><?= $DutySheetId['DutySheetDateEnd']; ?></a>
                                <a class="nav-link" style="display:none" id="liComments" href="#"><?= $DutySheetId['Comments']; ?></a>
                                <a class="nav-link" style="display:none" id="liOperationalSupport" href="#"><?= $DutySheetId['OperationalSupport']; ?></a>
                                <a class="nav-link" style="display:none" id="liPoliceServices" href="#"><?= $DutySheetId['PoliceServices']; ?></a>
                                <a class="nav-link" style="display:none" id="liVATPoliceServices" href="#"><?= $DutySheetId['VATPoliceServices']; ?></a>
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
                        <label>Duty Sheet Name: </label>
                        <label  id="DetailsDutySheetName" name="DetailsDutySheetName"></label>  
                        <br>
                        <label>Duty Sheet Date Start: </label>
                        <label  id="DetailsDutySheetDateStart" name="DetailsDutySheetDateStart"> </label>   
                        <br>
                        <label>Duty Sheet Date End: </label>
                        <label id="DetailsDutySheetDateEnd" name="DetailsDutySheetDateEnd"> </label>    
                        <br>
                        <label>Duty Sheet Cost: </label>
                        <label id="DetailsDutySheetCost" name="DetailsDutySheetCost"></label>    
                        <br>
                        <label>Police Services: </label>
                        <label id="DetailsPoliceServices" name="DetailsPoliceServices"></label>    
                        <br>
                        <label>VAT: </label>
                        <label id="DetailsVATPoliceServices" name="DetailsVATPoliceServices"></label>  
                        <br>
                        <label>Equipment: </label>
                        <label id="DetailsOperationalSupport" name="DetailsOperationalSupport"></label>  
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
 











