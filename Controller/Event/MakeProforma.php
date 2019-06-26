<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;


require 'Classes/Company.php';
require 'Classes/Equipment.php';
require 'Classes/Audit.php';
require 'Classes/PreAccount.php';
require 'Classes/Division.php';
require 'Classes/Event.php';
require 'Controller/base_template.php';



class MakeProformaController extends PermissionController {
    /* function __construct() {
      $this->setRoles(['Human Resource Clerk', 'Manager', 'Administrator', 'Super User']);
      }

     */

    private $EventId = "";
    
    private $CompanyId = "";
    private $CompanyName = "";
    //private $ContactName = "";
    //private $ContactNumber = "";
    //private $ContactEmail = "";
    
    private $EventCost = "";
    private $Comments = "";
    private $RecEntered = "";
    private $RecEnteredBy = "";
    private $OperationalSupport = "";
    private $PoliceServices = "";
    private $VATPoliceServices = "";

    private $Assets = "";
    private $AssetName = "";
    private $Quantity = "";
    private $Value = "";
     private $Hours = "";
    
    private $assetsbreakdown;
    private $arrbreakdown;
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

//            $eventinst->EventName = $EventName = $_POST["EventName"];
//            $eventinst->EventDateStart = $EventDateStart = $_POST["EventDateStart"];
//            $eventinst->EventDateEnd = $EventDateEnd = $_POST["EventDateEnd"];
            $eventinst->EventCost = $EventCost = $_POST["hdnEventCost"];
            $eventinst->Comments = $Comments = $_POST["Comments"];
            $eventinst->EventId = $EventId = $_POST["EventId"];
            $eventinst->EventName = $EventName = $_POST["EventName"];
            //$eventinst->Division = $Division = $_POST["hdnDivisionId"];

            //$eventinst->DelFlg = $DelFlg = "N";
            $eventinst->RecEntered = $RecEntered = "";
            $eventinst->RecEnteredBy = $RecEnteredBy = $username;
            $eventinst->OperationalSupport = $OperationalSupport = $_POST["hdnOperationalSupport"];
            $eventinst->PoliceServices = $PoliceServices = $_POST["hdnPoliceServices"];
            $eventinst->VATPoliceServices = $VATPoliceServices = $_POST["hdnVATPoliceServices"];

//all coming from Company/getuser 
            $eventinst->CompanyId = $CompanyId = $_POST["CompanyId"];
            $eventinst->CompanyName = $CompanyName = $_POST["CompanyName"];
            //$eventinst->ContactName = $ContactName = $_POST["ContactName"];
            //$eventinst->ContactNumber = $ContactNumber = $_POST["PhoneNumber"];
           // $eventinst->ContactEmail = $ContactEmail = $_POST["Email"];
 // $eventinst->Assets = $Assets = ($_POST["hdnAsset"]);
  $eventinst->Assets = $Assets = json_decode($_POST['hdnAsset'], TRUE);

       
               foreach($Assets as $Asset)
  {
           
            
            $eventinst->AssetName = $AssetName = $Asset[2];
            $eventinst->Value = $Value = $Asset[1];
            $eventinst->Quantity = $Quantity = $Asset[3];
            $eventinst->Hours = $Hours = $Asset[4];
            if ($Hours == '0')
                { 
                $Hours = '1';
                        
                }
              
       $eventinst->CreateEventPreAccount($EventId, $AssetName, $Quantity,$Hours, $Value, $CompanyName, $CompanyId);        
   
              
  }

  $eventinst->CreateUpdateProforma($EventId, $EventCost, $OperationalSupport, $PoliceServices,$VATPoliceServices, $RecEnteredBy);
  //need to find out how to log them
  $TimeStamp = $audinst->GenerateTimestamp('TS');
  $TransId = $audinst->GenerateTimestamp('TID');
  
  $eventinst->CreateProformaTransaction($EventId, $OperationalSupport, $PoliceServices,$VATPoliceServices, $RecEnteredBy,$TimeStamp,$TransId);
 
  

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
            //$EventId='UNASSIGNED';
           /* $division = $_GET['division'];
            if ($division != NULL) {
            
            }*/


            $model = new \BarcomModel\Event();
            $divmodel = new \BarcomModel\Division ();
            $equipmodel = new \BarcomModel\Equipment ();
            $divisions = $divmodel->GetDivisions();
            $rolerates = $model->GetRoleRates();
            $equipment = $equipmodel->GetEquipmentItems();
            $stations = $model->GetListOfStations();
//$preaccounts = $model->GetPreAccounts();
            $VAT = $model->getVat();
//put prefix from division drop down id here
 //$EventId = $model->GenerateTimestamp('BDIV');
            $template = new MasterTemplate();
            $template->load("Views/Event/makeproforma.html");
//$template->replace("accounts", $preaccounts);
           // $template->replace("EventName", "");
           // $template->replace("Deposit", "");
            //$template->replace("CompanyName", "");
           // $template->replace("ContactName", "");
            //$template->replace("ContactNumber", "");
            //$template->replace("ContactEmail", "");
            //$template->replace("EventDate", "");
            //$template->replace("EventCost", "");
           // $template->replace("lblEventRef", "");
           // $template->replace("OperationalSupport", "0.00");
            //$template->replace("PoliceServices", "0.00");
           // $template->replace("VATPoliceServices", "0.00");
            $template->replace("VATDBval", $VAT);
            $template->replace("Divisions", $divisions);
            $template->replace("RoleRates", $rolerates);
            $template->replace("Equipment", $equipment);
                        //$template->replace("Stations", $stations);
            $template->publish();
        }
    }

}
?>



