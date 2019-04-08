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

$sql = 'SELECT EventId, EventName, CompanyName, EventDate, EventCost, Comments, CompanyId FROM event WHERE CompanyName = "' . $q . '" AND DelFlg="N" AND Status="Active"';
//$sql = 'SELECT `a.EventId,`EventName,`eventCost`,`CompanyId`,`CompanyName`,
//    `ContactEmail`,`ContactNumber`,`EventDate`,`Comments`, AccountId, AccountName, TranId, TranAmt, b.EventId as "' . $Id . '" 
//FROM `event` a LEFT JOIN preaccounttransactions b ON a.EventId = b.EventId';

//$sql = 'SELECT * FROM `event` a LEFT JOIN preaccounttransactions b ON a.EventId = b.EventId';
$stmt = $conn->prepare($sql);
$stmt->execute();
$EventIds = $stmt->fetchAll();

$sql = 'SELECT AccountId, AccountName, TranId, TranAmt, EventId FROM `preaccounttransactions` ';
$stmt = $conn->prepare($sql);
$stmt->execute();
$TransActions = $stmt->fetchAll();

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
    <div class="col-md-4" id="HaveEvents">
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
                        <a class="nav-link" id="EventName" name="<?= $EventId['EventName']; ?>"><?= $EventId['EventName']; ?></a>
                        <a class="nav-link" id="EventCost" style="display:none" name="<?= $EventId['EventCost']; ?>"><?= $EventId['EventCost']; ?></a>
                        <a class="nav-link" id="EventDate" name="<?= $EventId['EventDate']; ?>"><?= $EventId['EventDate']; ?></a>
                        <a class="nav-link" id="Comments" style="display:none" name="<?= $EventId['Comments']; ?>"><?= $EventId['Comments']; ?></a>

                  <?php foreach ($TransActions as $record): ?>
                        <?php if($record['EventId'] == $EventId['EventId']) : ?>
                       
                        <a class="nav-link" id="AccountId"  style="display:none" name="<?= $record['AccountId']; ?>"><?= $record['AccountId']; ?></a>
                        <a class="nav-link" id="AccountName"  style="display:none" name="<?= $record['AccountName']; ?>"><?= $record['AccountName']; ?></a>
                        <a class="nav-link" id="TranId"  style="display:none" name="<?= $record['TranId']; ?>"><?= $record['TranId']; ?></a>
                        <a class="nav-link" id="TranAmt"  style="display:none" name="<?= $record['TranAmt']; ?>"><?= $record['TranAmt']; ?></a>
                        <a class="nav-link" id="Id"  style="display:none" name="<?= $record['EventId']; ?>"><?= $record['EventId']; ?></a>
                        
                        <?php endif; ?>
                <?php endforeach; ?>
                    </li>
                    <?php endforeach; ?>

            </ul>   
        </div>


        <center>
            <div class="row">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Event</button>
            </div> 
        </center> 
        <form action="/event/deactivate" method="post">
<!--            <input type="hidden" name="CompanyId" value="<?php echo $compinst->CompanyId; ?>">
    <input type="hidden" name="CompanyName" value="<?php echo $compinst->CompanyName; ?>">
    <button type="submit" class="btn btn-danger btn-default pull-right col-xs-3" name="btn-delete"><strong>Delete Company</strong></button> 
            <input type="hidden" name="EventId" id="EventId" value="">-->
            <input type="hidden" name="CompanyName" value="">
            <button type="submit" class="btn btn-danger btn-default pull-right col-xs-3" name="btn-delete"><strong>Delete Event</strong></button> 
        </form>
    </div>



</div>









