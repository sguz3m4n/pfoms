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
    private $OperationalSupport = "";
    private $PoliceServices = "";
    private $VATPoliceServices = "";
    
    
    //private $MyPaymentsRecords;

    function show($params) {
        $username = $_SESSION["login_user"];

        //Validation Engine will execute any validation on the fields in the interface
//    function ValidationEngine($elements) {
//        
//            if ($EventDate == "") {
//                if (strlen($this->CompanyId) < 7) {
//                    $compiderr = "Company Id is invalid length";
//                    $_SESSION['$compidwrapper'] = '<span style="color:red" >' . " * " . $compiderr . '</span>';
//                    $this->CompanyIdIsValid = 0;
//                } else {
//                    $this->CompanyIdIsValid = 1;
//                    $_SESSION['$compidwrapper'] = NULL;
//                }
//            }
//        
//    }



        if (isset($_POST['btn-create'])) {

            $eventinst = new \BarcomModel\Event();
            //$companyinst = new \BarcomModel\Company();
            //$preaccount = new \BarcomModel\PreAccount();
            $audinst = new \BarcomModel\Audit();
            //$this->MyPaymentsRecords = $pymntrecs = json_decode($_POST['paylist'], TRUE);

            //(isset($_POST['CompId']) ? $this->CompId = $varid = $refinst->CompanyId = $_POST['CompId'] : $this->CompId = $varid = $refinst->CompanyId = "");

            $eventinst->EventName = $EventName = $_POST["EventName"];
            $eventinst->EventDate = $EventDate = $_POST["EventDate"];
            $eventinst->EventCost = $EventCost = $_POST["EventCost"];
            $eventinst->Comments = $Comments = $_POST["Comments"];
            $eventinst->EventId = $EventId = $_POST["EventId"];
            
            $eventinst->DelFlg = $DelFlg = "N";
            $eventinst->RecEntered = $RecEntered = "";
            $eventinst->RecEnteredBy = $RecEnteredBy = $username;
            $eventinst->OperationalSupport = $OperationalSupport = $_POST["OperationalSupport"];
            $eventinst->PoliceServices = $PoliceServices = $_POST["PoliceServices"];
            $eventinst->VATPoliceServices = $VATPoliceServices = $_POST["VATPoliceServices"];

            //all coming from Company/getuser 
            $eventinst->CompanyId = $CompanyId = $_POST["CompId"];
            $eventinst->CompanyName = $CompanyName = $_POST["CompName"];
            $eventinst->ContactName = $ContactName = $_POST["ContactName"];
            $eventinst->ContactNumber = $ContactNumber = $_POST["PhoneNumber"];
            $eventinst->ContactEmail = $ContactEmail = $_POST["Email"];
            
            
                       
            $eventinst->CreateEvent($EventId, $EventName, $EventCost, $CompanyId, $CompanyName, $ContactName, $ContactNumber, $ContactEmail, $EventDate, $Comments, $RecEnteredBy, $OperationalSupport, $PoliceServices, $VATPoliceServices);
//            $tranid = $preaccount->GenerateTimestamp("PRE");
//            foreach ($pymntrecs as $value) {
//                $preaccount->AccountId = $accountid = $value[1];
//                $preaccount->AccountName = $accountname = $value[2];
//                $preaccount->TranAmt = $tramamt = $value[3];
//                $preaccount->EventId = $eventid = $EventId;
//                $preaccount->CreatePreAccountTransaction($tranid, $accountid, $accountname, $tramamt, $eventid);
//            }
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
            //$preaccounts = $model->GetPreAccounts();
            $VAT = $model->getVat();
            $EventId = $model->GenerateTimestamp("EVNT");
            $template = new MasterTemplate();
            $template->load("Views/Event/event.html");
            //$template->replace("accounts", $preaccounts);
            $template->replace("EventName", "");
            $template->replace("Deposit", "");
            $template->replace("CompanyName", "");
            $template->replace("ContactName", "");
            $template->replace("ContactNumber", "");
            $template->replace("ContactEmail", "");
            $template->replace("EventDate", "");
            $template->replace("EventCost", "");
            $template->replace("EventId", $EventId);
            $template->replace("OperationalSupport", "0.00");
            $template->replace("PoliceServices", "0.00");
            $template->replace("VATPoliceServices", "0.00");
            $template->replace("VATDBval", $VAT);
            

            $template->publish();
        }
    }

}
?>



