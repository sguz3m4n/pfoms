<?php
/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Event.php';
require 'Classes/Audit.php';
require 'Controller/base_template.php';

class EventDeactivateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    function show($params) {

        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-delete'])) {
            $eventinst = new \PfomModel\Event();
            $audinst = new \PfomModel\Audit();

            $EventId = $_POST['EventId'];
            //Check to see if the record already exists            
            //If it does execute delete
            //if ($eventinst->IfExists($EventId) === 1) {
                //Get Id from browser interface
                $varid = $EventId;
                $eventname = $_POST['EventName'];
                $eventinst->RecModifiedBy = $username;

                $eventinst->RemoveEvent($EventId);
                if ($eventinst->auditok == 1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('DCMP');
                    $TranDesc = 'Delete Event for ' . $varid . " Name " . $eventname;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $token = '<br><br><span class="label label-success">Event Name</span> ' . '<span class="label label-info"> ' . $eventname . '</span><br><br><br>' .
                            '<span class="label label-success">Event Id</span> ' . '<span class="label label-info">' . $varid . '</span><br>';
                    $token1 = 'Record Successfully Deleted';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
           // }
        }
        else if(isset($_POST['btn-submit'])){
             $eventinst = new \PfomModel\Event();
            $audinst = new \PfomModel\Audit();

            $EventId = $_POST['EventId'];
            //Check to see if the record already exists            
            //If it does execute delete
            //if ($eventinst->IfExists($EventId) === 1) {
                //Get Id from browser interface
                $varid = $EventId;
                $eventname = $_POST['EventName'];
                $eventinst->RecModifiedBy = $username;

                $eventinst->SubmitEvent($EventId,$username);
                if ($eventinst->auditok == 1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('DCMP');
                    $TranDesc = 'Event Approved by ' . $username . " Event Name: " . $eventname;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $token = '<br><br><span class="label label-success">Event Name</span> ' . '<span class="label label-info"> ' . $eventname . '</span><br><br><br>' .
                            '<span class="label label-success">Event Id</span> ' . '<span class="label label-info">' . $varid . '</span><br>';
                    $token1 = 'Event Successfully submitted for approval';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
        }
        
    }

}
