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
require 'Classes/PreAccount.php';
require 'Controller/base_template.php';
/*
  static $EventId = "";
  static $EventName = "";
  static $CompanyId = "";
  static $CompanyName = "";
  static $ContactName = "";
  static $ContactNumber = "";
  static $ContactEmail = "";
  static $EventDate = "";
 */

class EventCreateController extends PermissionController {
    /* function __construct() {
      $this->setRoles(['Human Resource Clerk', 'Manager', 'Administrator', 'Super User']);
      }

     */

    private $EventId = "";
    private $EventName = "";
    private $CompanyId = "";
    private $CompanyName = "";
    private $ContactName = "";
    private $ContactNumber = "";
    private $ContactEmail = "";
    private $EventDate = "";
    private $EventCost = "";
    private $Comments = "";
    private $RecEntered = "";
    private $RecEnteredBy = "";
    private $MyPaymentsRecords;

    function show($params) {
        $username = $_SESSION["login_user"];



        if (isset($_POST['btn-create'])) {

            $eventinst = new \BarcomModel\Event();
            $companyinst = new \BarcomModel\Company();
            $preaccount = new \BarcomModel\PreAccount();
            $audinst = new \BarcomModel\Audit();
            $this->MyPaymentsRecords = $pymntrecs = json_decode($_POST['paylist'], TRUE);

            //(isset($_POST['CompId']) ? $this->CompId = $varid = $refinst->CompanyId = $_POST['CompId'] : $this->CompId = $varid = $refinst->CompanyId = "");

            $eventinst->EventName = $EventName = $_POST["EventName"];
            $eventinst->EventDate = $EventDate = $_POST["EventDate"];
            $eventinst->EventCost = $EventCost = $_POST["EventCost"];
            $eventinst->Comments = $Comments = $_POST["Comments"];
            $eventinst->EventId = $EventId = $_POST["EventId"];
            $eventinst->CompanyId = $CompanyId = $_POST["CompId"];
            $eventinst->CompanyName = $CompanyName = $_POST["CompName"];
            $eventinst->ContactName = $ContactName = $_POST["ContactName"];
            $eventinst->ContactNumber = $ContactNumber = $_POST["PhoneNumber"];
            $eventinst->ContactEmail = $ContactEmail = $_POST["Email"];
            $eventinst->DelFlg = $DelFlg = "N";
            $eventinst->RecEntered = $RecEntered = "";
            $eventinst->RecEnteredBy = $RecEnteredBy = $username;

            $eventinst->CreateEvent($EventId, $EventName, $EventCost, $CompanyId, $CompanyName, $ContactName, $ContactNumber, $ContactEmail, $EventDate, $Comments, $RecEntered, $RecEnteredBy, $DelFlg);
            $tranid = $preaccount->GenerateTimestamp("PRE");
            foreach ($pymntrecs as $value) {
                $preaccount->AccountId = $accountid = $value[1];
                $preaccount->AccountName = $accountname = $value[2];
                $preaccount->TranAmt = $tramamt = $value[3];
                $preaccount->EventId = $eventid = $EventId;
                $preaccount->CreatePreAccountTransaction($tranid, $accountid, $accountname, $tramamt, $eventid);
            }
// //if validation succeeds then log audit record to database
            if ($eventinst->auditok == 1) {
                $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CEMP');
                $TranDesc = 'Created new Event Name: ' . $EventName . ' Event ID: ' . $EventId;
                $User = $username;
                $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                $token = '<br><br><span class="label label-success">Event Name</span> ' . '<span class="label label-info"> ' . $EventName . '</span><br><br><br>' .
                        '<span class="label label-success">Event Id</span> ' . '<span class="label label-info">' . $EventId . '</span><br>';
                $token1 = 'Record Successfully Created';
                header("Location:" . "/success?result=$token&header=$token1&args=");
            }
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Event();
            $preaccounts = $model->GetPreAccounts();
            $EventId = $model->GenerateTimestamp("EVNT");
            $template = new MasterTemplate();
            $template->load("Views/Event/event.html");
            $template->replace("accounts", $preaccounts);
            $template->replace("EventName", "");
            $template->replace("Deposit", "");
            $template->replace("CompanyName", "");
            $template->replace("ContactName", "");
            $template->replace("ContactNumber", "");
            $template->replace("ContactEmail", "");
            $template->replace("EventDate", "");
            $template->replace("EventCost", "");
            $template->replace("EventId", $EventId);

            $template->publish();
        }
    }

}
?>



