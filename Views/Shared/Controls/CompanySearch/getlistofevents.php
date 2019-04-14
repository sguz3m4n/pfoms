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

$sql = 'SELECT EventId, EventName, CompanyName, EventDate, EventCost, Comments, CompanyId, OperationalSupport, PoliceServices, VATPoliceServices FROM event WHERE CompanyName = "' . $q . '" AND DelFlg="N" AND Status="Active"';
//$sql = 'SELECT `a.EventId,`EventName,`eventCost`,`CompanyId`,`CompanyName`,
//    `ContactEmail`,`ContactNumber`,`EventDate`,`Comments`, AccountId, AccountName, TranId, TranAmt, b.EventId as "' . $Id . '" 
//FROM `event` a LEFT JOIN preaccounttransactions b ON a.EventId = b.EventId';
//$sql = 'SELECT * FROM `event` a LEFT JOIN preaccounttransactions b ON a.EventId = b.EventId';
$stmt = $conn->prepare($sql);
$stmt->execute();
$EventIds = $stmt->fetchAll();

//$sql = 'SELECT AccountId, AccountName, TranId, TranAmt, EventId FROM `preaccounttransactions` ';
//$stmt = $conn->prepare($sql);
//$stmt->execute();
//$TransActions = $stmt->fetchAll();

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


<div class="panel panel-info" id="EventInfo">
    <div class="panel-heading" id="NoEvents">
        <center>
            <h3> 
                <span class="label label-info">No Active events for:</span> 
                <span class="label label-info"><?php echo $q; ?></span>           

            </h3>  
        </center>
    </div>
    <!--    <div class="col-md-3"></div>-->


    <div class="eventList" id="HaveEvents">
        <div class="col-md-6">
            <br>
            <center id="addcontrols">                                                                                                                           
                <h3> 
                    <span class="label label-info">List of Active events for:</span> 
                    <span class="label label-info"><?php echo $q; ?></span>           

                </h3>  
            </center>
            <div class="pillwrapper" id="pillcontainer">
                <ul class="nav nav-pills nav-stacked" id="pillwrapper" >

                    <?php foreach ($EventIds as $EventId): ?>

                        <li class="<?= $EventId['EventId']; ?>">      
                            <a class="nav-link" id="liEventName" name="<?= $EventId['EventName']; ?>"><?= $EventId['EventName']; ?></a>
                            <a class="nav-link" style="display:none" id="liEventId" href="#"><?= $EventId['EventId']; ?></a>
                            <a class="nav-link" style="display:none" id="liEventCost" value="<?= $EventId['EventCost']; ?>" href="#"><?= $EventId['EventCost']; ?></a>
                            <a class="nav-link" style="display:none" id="liEventDate" href="#"><?= $EventId['EventDate']; ?></a>
                            <a class="nav-link" style="display:none" id="liComments" href="#"><?= $EventId['Comments']; ?></a>
                            <a class="nav-link" style="display:none" id="liOperationalSupport" href="#"><?= $EventId['OperationalSupport']; ?></a>
                            <a class="nav-link" style="display:none" id="liPoliceServices" href="#"><?= $EventId['PoliceServices']; ?></a>
                            <a class="nav-link" style="display:none" id="liVATPoliceServices" href="#"><?= $EventId['VATPoliceServices']; ?></a>
                        </li>
                        <br>
                    <?php endforeach; ?>
                </ul>   
            </div>


            <center>
                <div class="row" style="display:none" id="divEditEvent">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Event</button>
                </div> 
            </center> 
            <form action="/event/deactivate" method="post" style="display:none" id="formDeleteEvent">

                <input type="hidden" name="EventName" id="hdnEventName" value="">
                <input type="hidden" name="EventId" id="hdnEventId" value="">
                <button type="submit" class="btn btn-danger btn-default pull-right col-xs-3" name="btn-delete" id="btnDelete"><strong>Delete Event</strong></button> 
            </form>
        </div>
        <div class="col-md-6" style="display:none" id="divEventDetails"><br>
            <center id="addcontrols">                                                                                                                           
                <h3> 
                    <span class="label label-info">Event Details:</span> 
                </h3>  
            </center></button>
            <br>
            <ul style="list-style: none">
                <li>
                <label>Event Name</label>
                <input type="text"  class="form-control" id="DetailsEventName" name="DetailsEventName" autocomplete="off" readonly >  
                <label>Event Date</label>
                <input type="text"  class="form-control" id="DetailsEventDate" name="DetailsEventDate" autocomplete="off" readonly>  
                <label>Event Cost</label>
                <input type="text"  class="form-control" id="DetailsEventCost" name="DetailsEventCost" autocomplete="off" readonly>  

                <label>Police Services</label>
                <input type="text"  class="form-control" id="DetailsPoliceServices" name="DetailsPoliceServices" autocomplete="off" readonly>  

                <label>VAT</label>
                <input type="text" class="form-control"  id="DetailsVATPoliceServices" name="DetailsVATPoliceServices" autocomplete="off" readonly >

                <label>Equipment</label>
                <input type="text" class="form-control"  id="DetailsOperationalSupport" name="DetailsOperationalSupport" autocomplete="off"  readonly>
                </li>

            </ul>
        </div>
    </div>

</div>











