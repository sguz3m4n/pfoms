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
require 'Classes/Employee.php';
require 'Controller/base_template.php';
static $eventnameerr = "";
static $eventnamewrapper = "";

class CreateDutySheetController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $DutySheetId;
    private $EventId;
    private $EventName;
    private $CompanyId;
    private $Natregno;
    private $ForceNumber;
    private $RateCode;
    private $OfficerName;
    private $PayRate;
    private $OvertimeAmount;
    private $DateOfDuty;
    private $DispatchTime;
    private $ArrivalTime;
    private $DismissalTime;
    private $ReturnTime;
    private $TotalHoursWorked;
    private $RecEnteredBy;
    private $Hours;
    private $RecModifiedBy;
    private $OfficerArray;
    private $ResourceId;
    private $ResourceCount;
    private $ResourceRate;
    private $ActingRateCode;
    private $ActingPayRate;
    private $Comments;
    private $Status;

    function show($params) {

        $username = $_SESSION["login_user"];


        if (isset($_POST['btn-create'])) {
            $dutysheetinst = new \PfomModel\DutySheet();
            $audinst = new \PfomModel\Audit();

            //Get Id from browser interface
            $dutysheetinst->EventId = $EventId = $_POST["EventId"];
            $dutysheetinst->EventName = $EventName = $_POST["EventName"];

            $dutysheetinst->CompanyId = $CompanyId = $_POST["CompID"];

            $dutysheetinst->DateOfDuty = $DateOfDuty = $_POST["DateOfDuty"];
            $dutysheetinst->DispatchTime = $DispatchTime = $_POST["DispatchTime"];
            $dutysheetinst->ArrivalTime = $ArrivalTime = $_POST["ArrivalTime"];
            $dutysheetinst->DismissalTime = $DismissalTime = $_POST["DismissalTime"];
            $dutysheetinst->ReturnTime = $ReturnTime = $_POST["ReturnTime"];

            $dutysheetinst->HoursEngaged = $HoursEngaged = $_POST["HoursEngaged"];
            $dutysheetinst->RecEnteredBy = $RecEnteredBy = $username;

            $DutySheetId = $audinst->GenerateTimestamp('DYST');
//            $dutysheetinst->CreateDutySheet($DutySheetId, $EventId, $CompanyId, $DateOfDuty, $DispatchTime, $ArrivalTime, $DismissalTime, $ReturnTime, $HoursEngaged, $RecEnteredBy);
            //Duty sheet preaccount 
            $OfficerArray = json_decode($_POST['offarr'], TRUE);
            $EquipmentArray = json_decode($_POST['equiparr'], TRUE);

            if ($OfficerArray != NULL) {
                foreach ($OfficerArray as $officer) {

                    $dutysheetinst->OfficerName = $OfficerName = $officer[0];
                    $dutysheetinst->Natregno = $Natregno = $officer[1];
                    $dutysheetinst->Hours = $Hours = $officer[2];
                    $dutysheetinst->PayRate = $PayRate = $officer[3];
                    $dutysheetinst->RateCode = $RateCode = $officer[4];
                    $dutysheetinst->ForceNumber = $ForceNumber = $officer[5];
//                    $dutysheetinst->Acting = $Acting = $officer[6];
                    $dutysheetinst->Acting = $Acting = 'N';
                    $dutysheetinst->ActingPayRate = $ActingPayRate = $officer[3];
                    $dutysheetinst->ActingRateCode = $ActingRateCode = $officer[4];
                    $dutysheetinst->Comments = $Comments = $officer[5];
                    $dutysheetinst->Status = $Status = $officer[6];
                    $dutysheetinst->CreateDSPA($DutySheetId, $ForceNumber, $Natregno, $OfficerName, $Hours, $RateCode, $PayRate, $Acting, $ActingRateCode, $ActingPayRate, $Comments, $Status);

//                    $dutysheetinst->OvertimeAmount = $OvertimeAmount = ($Hours * $PayRate) + $OvertimeAmount;
                }
            }

            if ($EquipmentArray) {
                foreach ($EquipmentArray as $equipment) {
                    $dutysheetinst->ResourceId = $ResourceId = $equipment[0];
                    $dutysheetinst->ResourceCount = $ResourceCount = $equipment[2];
                    $dutysheetinst->ResourceRate = $ResourceRate = $equipment[3];
                    $dutysheetinst->CreateOPSUP($DutySheetId, $ResourceId, $ResourceCount, $ResourceRate);
                }
            }




//            $dutysheetinst->CreateDutySheet($DutySheetId, $EventId, $EventName, $CompanyId, $OvertimeAmount, $DateOfDuty, $DispatchTime, $ArrivalTime, $DismissalTime, $ReturnTime, $HoursEngaged, $RecEnteredBy);
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
        } else
        if (isset($_GET)) {
            $model = new \PfomModel\Employee();
//            $roles = $model->GetRoles();
            $template = new MasterTemplate();
            $template->load("Views/DutySHeet/dutysheet.html");
//            $template->replace("roles", $roles);
            $template->publish();
        }
    }

}
