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
      
      public $Comments;

    public $OvertimeAmount;
    public $RecEnteredBy;
    public $auditok;
   public $OfficerArray;
 
 
    function show($params) {

        $username = $_SESSION["login_user"];

        
        if (isset($_POST['btn-create'])) {
            $dutysheetinst = new \BarcomModel\DutySheet();
            $audinst = new \BarcomModel\Audit();

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
            
            //Duty sheet preaccount 
               $OfficerArray = json_decode($_POST['offarr'], TRUE);
               foreach($OfficerArray as $officer)
  {
           
            
            $dutysheetinst->OfficerName = $OfficerName = $officer[0];
            $dutysheetinst->Natregno = $Natregno = $officer[1];
            
            $dutysheetinst->Hours = $Hours = $officer[2];
           
            $dutysheetinst->PayRate = $PayRate = $officer[3];
             $dutysheetinst->RateCode = $RateCode = $officer[4];
              $dutysheetinst->ForceNumber = $ForceNumber = $officer[5];
             
              $dutysheetinst->CreateDSPA($DutySheetId, $EventId, $CompanyId, $ForceNumber, $Natregno, $OfficerName,
             $Hours, $RateCode,$PayRate);
              
               
   $dutysheetinst->OvertimeAmount = $OvertimeAmount = ($Hours * $PayRate) + $OvertimeAmount;
              
  }

  
   
               $dutysheetinst->CreateDutySheet($DutySheetId, $EventId, $EventName, $CompanyId, $OvertimeAmount, $DateOfDuty,
            $DispatchTime, $ArrivalTime, $DismissalTime,$ReturnTime,$HoursEngaged,$RecEnteredBy);
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
         
            $template = new MasterTemplate();
            $template->load("Views/SpecOpsDutySheet/specopsdutysheet.html");


            $template->publish();
        }
    }

}
