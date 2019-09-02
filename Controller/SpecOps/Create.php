<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;


require 'Classes/SpecOpsDutySheet.php';

require 'Classes/Audit.php';
//require 'Classes/PreAccount.php';
require 'Controller/base_template.php';

static $eventnameerr = "";
static $eventnamewrapper = "";

class SpecOpsCreateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

   public $DutySheetId;
    public $TypeOfDuty;
//    public  $CrimePrevention;
      public $PlaceOfDuty;
  //      public $PoliceStation;
         public $DateOfDuty;
         public $HoursEngaged;
         
//    public $Division;
//    public $Station;
//    public $Shift;
   
    
    
    
    public $TimeDutyCommenced;
    public $TimeDutyCeased;
    
      public $TimeDutyCommencedDiaryNo;
    public $TimeDutyCeasedDiaryNo;
    
     public $ForceNumber;
    public $RateCode;
    public $OfficerName;
    public $PayRate;
    public $ActingPosition;
    public $ActingPayRateCode;
    public $Comments;
    
    public $DayOff;
    public $OffDuty;
    
    
    
    Public $Surveillance; 
    Public $CrimePreventionOps; //extension of shift duty non emergency
    Public $PAIIPBDC; //protracted and intensive investigations prescrived by divisional commander
    Public $SAECC; //special and extraordinary crowd control
    //Times and places of inspections conducted 
    Public $Line1; 
    Public $Line2; 
     Public $Line3;
      Public $Line4;
      
      public $Details; //comment briefly on the outcome of duties performed

    public $OvertimeAmount;
    public $RecEnteredBy;
    public $auditok;
   public $OfficerArray;
 
 
    function show($params) {

        $username = $_SESSION["login_user"];
       if (isset($_POST['btn-create'])) {
            $specopsdutysheetinst = new \PfomModel\SpecOpsDutySheet();
            $audinst = new \PfomModel\Audit();

            //Get Id from browser interface
            $specopsdutysheetinst->TypeOfDuty = $TypeOfDuty = $_POST["TypeOfDuty"];
             $specopsdutysheetinst->PlaceOfDuty = $PlaceOfDuty = $_POST["PlaceOfDuty"];
          $specopsdutysheetinst->DateOfDuty = $DateOfDuty = $_POST["DateOfDuty"]; 
          $specopsdutysheetinst->HoursEngaged = $HoursEngaged = $_POST["HoursEngaged"];
            $specopsdutysheetinst->TimeDutyCommenced = $TimeDutyCommenced = $_POST["TimeDutyCommenced"];
            $specopsdutysheetinst->TimeDutyCeased = $TimeDutyCeased = $_POST["TimeDutyCeased"];
            $specopsdutysheetinst->TimeDutyCommencedDiaryNo = $TimeDutyCommencedDiaryNo = $_POST["TimeDutyCommencedDiaryNo"];
            $specopsdutysheetinst->TimeDutyCeasedDiaryNo = $TimeDutyCeasedDiaryNo = $_POST["TimeDutyCeasedDiaryNo"];
           
           
            $specopsdutysheetinst->Surveillance = $Surveillance = $_POST["hdnSurveillance"];
            $specopsdutysheetinst->CrimePreventionOps = $CrimePreventionOps = $_POST["hdnCrimePreventionOps"];
            $specopsdutysheetinst->PAIIPBDC = $PAIIPBDC = $_POST["hdnPAIIPBDC"];
            $specopsdutysheetinst->SAECC = $SAECC = $_POST["hdnSAECC"];
            $specopsdutysheetinst->Line1 = $Line1 = $_POST["Line1"];
            $specopsdutysheetinst->Line2 = $Line2 = $_POST["Line2"];
            $specopsdutysheetinst->Line3 = $Line3 = $_POST["Line3"];
            $specopsdutysheetinst->Line4 = $Line4 = $_POST["Line4"];
            $specopsdutysheetinst->Details = $Details = $_POST["Details"];
            $specopsdutysheetinst->RecEnteredBy = $RecEnteredBy = $username;
            $DutySheetId = $audinst->GenerateTimestamp('SPECOPS');
            
            //Duty sheet preaccount 
              $OfficerArray = json_decode($_POST['offarr'], TRUE);
               foreach($OfficerArray as $officer)
  {
           $specopsdutysheetinst->Comments = $Comments = $officer[10];
                   $specopsdutysheetinst->ActingPayRateCode = $ActingPayRateCode = $officer[9];
           $specopsdutysheetinst->ActingPosition = $ActingPosition = $officer[8];
           
           $specopsdutysheetinst->OffDuty = $OffDuty = $officer[7];
           $specopsdutysheetinst->DayOff = $DayOff = $officer[6];
           $specopsdutysheetinst->Acting = $Acting = $officer[5];
             $specopsdutysheetinst->ForceNumber = $ForceNumber = $officer[4];
              $specopsdutysheetinst->RateCode = $RateCode = $officer[3];
              $specopsdutysheetinst->PayRate = $PayRate = $officer[2];
             // $specopsdutysheetinst->Hours = $Hours = $officer[2];
              $specopsdutysheetinst->Natregno = $Natregno = $officer[1];
            $specopsdutysheetinst->OfficerName = $OfficerName = $officer[0];
            
            
            if($Acting == "Y"){
               $ActingPayRate = $specopsdutysheetinst->GetActingPayRate($ActingPayRateCode);
               
               $OTEarned = $specopsdutysheetinst->OTEarned($HoursEngaged, $ActingPayRate);
               $specopsdutysheetinst->OvertimeAmount = $OvertimeAmount = $specopsdutysheetinst->TotalOTEarned($OTEarned, $OvertimeAmount);
            }
            else{
               $OTEarned = $specopsdutysheetinst->OTEarned($HoursEngaged, $PayRate);
               $specopsdutysheetinst->OvertimeAmount = $OvertimeAmount = $specopsdutysheetinst->TotalOTEarned($OTEarned, $OvertimeAmount);
               $ActingPosition = null;
               $ActingPayRateCode = null;
               $Comments = null;
            }
             
             $specopsdutysheetinst->CreateSDSPA($DutySheetId, $ForceNumber, $Natregno, $OfficerName,
             $HoursEngaged, $RateCode,$PayRate,$DayOff,$OffDuty,$Acting,$ActingPayRateCode,$ActingPayRate,$Comments,$OTEarned);
              
  }

              $specopsdutysheetinst->CreateSpecOpsDutySheet($DutySheetId, $TypeOfDuty, $PlaceOfDuty, $DateOfDuty, $HoursEngaged,
            $TimeDutyCommenced, $TimeDutyCeased,$TimeDutyCommencedDiaryNo,$TimeDutyCeasedDiaryNo,
            $Surveillance,$CrimePreventionOps,$PAIIPBDC,$SAECC,
            $Line1,$Line2,$Line3,$Line4,$Comments,$OvertimeAmount,$RecEnteredBy);
                //if validation succeeds then commit info to database
                  if ($specopsdutysheetinst->auditok == 1) {
                $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CEMP');
                 $TranDesc = 'Special Operations Duty Sheet created: ' . $DutySheetId;
                $User = $username;
                $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                $token = '<br><br><span class="label label-success">Flexi Duty Sheet ID</span> ' . '<span class="label label-info"> ' . $DutySheetId . '</span><br><br><br>' .
//                        '<span class="label label-success">Event Id</span> ' . '<span class="label label-info">' . $EventId . '</span><br>';
//                
                $token1 = 'Special Operations Duty Sheet Successfully Created';
                header("Location:" . "/success?result=$token&header=$token1&args=");
            }
        } 
        else
        if (isset($_GET)) {
         
            $template = new MasterTemplate();
            $template->load("Views/SpecOpsDutySheet/specopsdutysheet.html");


            $template->publish();
        }
    }

}
