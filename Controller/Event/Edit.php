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
require 'Classes/Company.php';
require 'Classes/Audit.php';
//require 'Classes/PreAccount.php';
require 'Controller/base_template.php';

static $eventnameerr = "";
static $eventnamewrapper = "";

class EventEditController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $EventId = "";
    private $EventName = "";
    private $EventDate = "";
    private $EventCost = "";
    private $Comments = "";
        
    private $RecModifiedBy = "";
    private $OperationalSupport = "";
    private $PoliceServices = "";
    private $VATPoliceServices = "";
 
 
    function show($params) {

        $username = $_SESSION["login_user"];

        
        if (isset($_POST['btn-update'])) {
            $eventinst = new \PfomModel\Event();
            $audinst = new \PfomModel\Audit();

            //Get Id from browser interface
            $eventinst->EventId = $EventId = $_POST["EventId"];

            //Check to see if the record already exists            
            //If it does execute update
            //if ($eventinst->IfExists($EventId) === 1) {
                
            $eventinst->EventName = $EventName = $_POST["EventName"];
            $eventinst->EventDate = $EventDate = $_POST["EventDate"];
            $eventinst->EventCost = $EventCost = $_POST["EventCost"];
            $eventinst->Comments = $Comments = $_POST["Comments"];
            //$eventinst->EventId = $EventId = $_POST["EventId"];
            
            //$eventinst->DelFlg = $DelFlg = "N";
            //$eventinst->RecEntered = $RecEntered = "";
            $eventinst->RecModifiedBy = $RecModifiedBy = $username;
            $eventinst->OperationalSupport = $OperationalSupport = $_POST["OperationalSupport"];
            $eventinst->PoliceServices = $PoliceServices = $_POST["PoliceServices"];
            $eventinst->VATPoliceServices = $VATPoliceServices = $_POST["VATPoliceServices"];


               $eventinst->UpdateEvent($EventId);
                //if validation succeeds then commit info to database
                  if ($eventinst->auditok == 1) {
                $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CEMP');
                $TranDesc = 'Update complete for Event Name: ' . $EventName . ' Event ID: ' . $EventId;
                $User = $username;
                $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                $token = '<br><br><span class="label label-success">Event Name</span> ' . '<span class="label label-info"> ' . $EventName . '</span><br><br><br>' .
                        '<span class="label label-success">Event Id</span> ' . '<span class="label label-info">' . $EventId . '</span><br>';
                $token1 = 'Record Successfully Updated';
                header("Location:" . "/success?result=$token&header=$token1&args=");
            }
        } 
        else
        if (isset($_GET)) {
            $model = new \PfomModel\Company();
            //$parishes = $model->GetParishes();
            $template = new MasterTemplate();
            $template->load("Views/Event/event_edit.html");
//            $template->replace("parishes", $parishes);
  //          $template->replace("title", " Create New Company ");
            $template->replace("val_CompanyName", "");
            $template->publish();
        }
    }

}
