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
include '../../../../Classes/Event.php';
$q = $_GET['q'];
$conn = conn();
$Id = "Id";

$sql = 'SELECT a.EventId, EventName, CompanyName,c.CurrentBalance, b.EventCost, EventDateStart, 
    EventDateEnd, a.Comments, c.CompanyId, Division, b.OpperationalSupport, b.PoliceServices,
    b.VATPoliceServices, a.Status ,a.Station
    FROM event a 
    left join proforma b ON a.EventId = b.EventId
      left join deposit c ON c.CompanyId = a.CompanyId
    WHERE a.CompanyName = "' . $q . '" AND a.DelFlg="N" AND a.Status<>"Complete"';


//$sql = 'SELECT EventId, EventName, CompanyName, EventCost, EventDateStart, EventDateEnd, Comments, CompanyId, Division, Station, OperationalSupport, PoliceServices, VATPoliceServices FROM event WHERE CompanyName = "' . $q . '" AND  DelFlg="N" AND Status="Approved"';
//$sql = 'SELECT `a.EventId,`EventName,`eventCost`,`CompanyId`,`CompanyName`,'$EventDateStart','$EventDateEnd',
//    `ContactEmail`,`ContactNumber`,`EventDate`,`Comments`, AccountId, AccountName, TranId, TranAmt, b.EventId as "' . $Id . '" 
//FROM `event` a LEFT JOIN preaccounttransactions b ON a.EventId = b.EventId';
//$sql = 'SELECT * FROM `event` a LEFT JOIN preaccounttransactions b ON a.EventId = b.EventId';


$stmt = $conn->prepare($sql);
$stmt->execute();
$EventIds = $stmt->fetchAll();
//

//$sql = 'SELECT EventId, CompanyId, AssetName, SUM(Value) as Value, SUM(Quantity)as Quantity FROM `eventpreaccount` WHERE CompanyName = "' . $q . '" AND DelFlag="N" GROUP by AssetName';
//$stmt = $conn->prepare($sql);
//$stmt->execute();
//$result_array = $stmt->fetchAll();
//
//$sqldeposit='SELECT * FROM deposit WHERE companyid=(SELECT Companyid FROM company WHERE CompanyName = "' . $q . '" AND DelFlg="N" )';
//$stmtdep=$conn->prepare($sqldeposit);
//$stmt->execute();
//$deposit_arr=$stmtdep->fetchAll();

if (empty($EventIds)) {
    ?>
    <style type="text/css">#HaveEvents{
            display:none;
        }</style>
        <?php
    } else {
        ?>
    <style type="text/css">#NoEvents{
            display:none;
        }</style>
        <?php
    }


    $eventinst = new BarcomModel\Event();
    $conn = NULL;
    ?>  


<div class="panel panel-info">
    <div class="panel-heading" >


        <div class="eventList" id="HaveEvents">
            <center >                                                                                                                           
                <h3> 
                    <span class="label label-info">List of Active events for:</span> 
                    <span class="label label-info" id="compName"><?php echo $q; ?></span> 

                </h3>  
            </center>
            <div>
                <center>
                    <button id="btnShowEvents" type="button" class="btn btn-info" data-toggle="collapse" data-target="#ListOfApprovedEvents,#divEventDetails">Hide Events</button>
                </center>

            </div> 
            <div class="col-md-6 collapse in" id ="ListOfApprovedEvents">
                <br>
                <div class="pillwrapper" id="pillcontainer">
                    <ul class="nav nav-pills nav-stacked" id="pillwrapper" >

                        <?php foreach ($EventIds as $EventId): ?>
                            <input type="hidden" value="<?= $EventId['CurrentBalance']; ?>" id="CompanyBalance" name="CompanyBalance">
                            <input type="hidden" value="<?= $EventId['CompanyId']; ?>" id="CompanyId" name="CompanyId">
                            <li class="<?= $EventId['EventId']; ?>">      
                                <a class="nav-link" id="liEventName" name="<?= $EventId['EventName']; ?>"><?= $EventId['EventName']; ?></a>
                                <a class="nav-link" style="display:none" id="liEventId" href="#"><?= $EventId['EventId']; ?></a>
                                <a class="nav-link" style="display:none" id="liEventCost" value="<?= $EventId['EventCost']; ?>" href="#"><?= $EventId['EventCost']; ?></a>
                                <a class="nav-link" style="display:none" id="liEventDateStart" href="#"><?= $EventId['EventDateStart']; ?></a>
                                <a class="nav-link" style="display:none" id="liEventDateEnd" href="#"><?= $EventId['EventDateEnd']; ?></a>
                                <a class="nav-link" style="display:none" id="liComments" href="#"><?= $EventId['Comments']; ?></a>
                                <a class="nav-link" style="display:none" id="liOperationalSupport" href="#"><?= $EventId['OpperationalSupport']; ?></a>
                                <a class="nav-link" style="display:none" id="liPoliceServices" href="#"><?= $EventId['PoliceServices']; ?></a>
                                <a class="nav-link" style="display:none" id="liVATPoliceServices" href="#"><?= $EventId['VATPoliceServices']; ?></a>
                                <a class="nav-link" style="display:none" id="liCompanyId" href="#"><?= $EventId['CompanyId']; ?></a>
                                <a class="nav-link" style="display:none" id="liStation" href="#"><?= $EventId['Station']; ?></a>
                                <a class="nav-link" style="display:none" id="liDivision" href="#"><?= $EventId['Division']; ?></a>

                            </li>
                            <br>
                        <?php endforeach; ?>
                    </ul>   
                </div>

                <!--                <form action="/event/deactivate" method="post" style="display:none" id="formDeleteEvent">
                
                                    <input type="hidden" name="EventName" id="hdnEventName" value="">
                                    <input type="hidden" name="EventId" id="hdnEventId" value="">
                                    <center>
                                    <button type="submit" class="btn btn-danger" name="btn-delete" id="btnDelete"><strong>Delete Event</strong></button> 
                                    </center>
                                </form>-->
            </div>
            <div class="col-md-6 collapse in" style="display:none" id="divEventDetails"><br>
                <center >                                                                                                                           
                    <h3> 
                        <span class="label label-info">Event Details:</span> 
                    </h3>  
                </center></button>
                <br>

                <ul style="list-style: none">
                    <li>
                        <label>Event Name: </label>
                        <label  id="DetailsEventName" name="DetailsEventName"></label>  
                        <br>
                        <label>Event Date Start: </label>
                        <label  id="DetailsEventDateStart" name="DetailsEventDateStart"> </label>   
                        <br>
                        <label>Event Date End: </label>
                        <label id="DetailsEventDateEnd" name="DetailsEventDateEnd"> </label>    
                        <br>
                        <label>Event Cost: </label>
                        <label id="DetailsEventCost" name="DetailsEventCost"></label>    
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
        <div class="eventList" id="NoEvents">
            <center>
                <h3> 
                    <span class="label label-info">No Active events for:</span> 
                    <span class="label label-info"><?php echo $q; ?></span>           
                </h3> 

            </center>
        </div>


    </div>
    <div class="panel-body">

    </div>
</div>











