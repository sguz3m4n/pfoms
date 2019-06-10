<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;


require 'Classes/DutySheet.php';

require 'Classes/Audit.php';
//require 'Classes/PreAccount.php';
require 'Controller/base_template.php';

static $eventnameerr = "";
static $eventnamewrapper = "";

class CreateDutySheetController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

  public $DutySheetId;
    public $EventId;
    public $EventName;
    public $CompanyId;
    public $Natregno;
    public $ForceNumber;
    public $RateCode;
    public $OfficerName;
    
    public $PayRate;
    
    public $OvertimeAmount;
    public $DateOfDuty;
    public $DispatchTime;
    public $ArrivalTime;
    public $DismissalTime;
    public $ReturnTime;
    public $TotalHoursWorked;
    public $RecEnteredBy;
    public $Hours;
   public $RecModifiedBy;
 
 
    function show($params) {

        $username = $_SESSION["login_user"];

        
        if (isset($_POST['btn-create'])) {
            $dutysheetinst = new \BarcomModel\DutySheet();
            $audinst = new \BarcomModel\Audit();

            //Get Id from browser interface
            $dutysheetinst->EventId = $EventId = $_POST["EventId"];
            $dutysheetinst->EventName = $EventName = $_POST["EventName"];
            
            $dutysheetinst->CompanyId = $CompanyId = $_POST["CompId"];
            $dutysheetinst->OvertimeAmount = $OvertimeAmount = $_POST["OvertimeAmount"];
            $dutysheetinst->DateOfDuty = $DateOfDuty = $_POST["DateOfDuty"];
            $dutysheetinst->DispatchTime = $DispatchTime = $_POST["DispatchTime"];
            $dutysheetinst->ArrivalTime = $ArrivalTime = $_POST["ArrivalTime"];
            $dutysheetinst->DismissalTime = $DismissalTime = $_POST["DismissalTime"];
            $dutysheetinst->ReturnTime = $ReturnTime = $_POST["ReturnTime"];
            $dutysheetinst->TotalHoursWorked = $TotalHoursWorked = $_POST["TotalHoursWorked"];
                        
            $dutysheetinst->RecEnteredBy = $RecEnteredBy = $username;
            
            $DutySheetId = 'test1234';
            
            //Duty sheet preaccount 
            $dutysheetinst->ForceNumber = $ForceNumber = $_POST["ForceNumber"];
            $dutysheetinst->Natregno = $Natregno = $_POST["Natregno"];
            $dutysheetinst->OfficerName = $OfficerName = $_POST["OfficerName"];
            
            $dutysheetinst->Hours = $ForceNumber = $_POST["Hours"];
            $dutysheetinst->RateCode = $DateOfDuty = $_POST["RateCode"];
            $dutysheetinst->PayRate = $OvertimeAmount = $_POST["PayRate"];


               $dutysheetinst->CreateDutySheet($DutySheetId, $EventId, $CompanyId, $OvertimeAmount, $DateOfDuty,
            $DispatchTime, $ArrivalTime, $DismissalTime,$ReturnTime,$HoursWorked,$RecEnteredBy);
                //if validation succeeds then commit info to database
                  if ($dutysheetinst->auditok == 1) {
                $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CEMP');
                $TranDesc = 'Duty Sheet created: ' . $DutySheetId . ' Event ID: ' . $EventId;
                $User = $username;
                $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                $token = '<br><br><span class="label label-success">Duty Sheet ID</span> ' . '<span class="label label-info"> ' . $DutySheetId . '</span><br><br><br>' .
                        '<span class="label label-success">Event Id</span> ' . '<span class="label label-info">' . $EventId . '</span><br>';
                
                $token1 = 'Duty Sheet Successfully Created';
                header("Location:" . "/success?result=$token&header=$token1&args=");
            }
        } 
        else
        if (isset($_GET)) {
            //$model = new \BarcomModel\Company();
            //$parishes = $model->GetParishes();
            $template = new MasterTemplate();
            $template->load("Views/DutySHeet/dutysheet.html");
//            $template->replace("parishes", $parishes);
  //          $template->replace("title", " Create New Company ");
            //$template->replace("val_CompanyName", "");
            $template->publish();
        }
    }

}
