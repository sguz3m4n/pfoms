<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;


require 'Classes/FlexiDutySheet.php';
require 'Classes/Division.php';

require 'Classes/Audit.php';
//require 'Classes/PreAccount.php';
require 'Controller/base_template.php';


class FlexiCreateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

 public $DutySheetId;
    public $Division;
    public $Station;
    public $Shift;
    public $DateOfDuty;
    public $HoursEngaged;
    public $TypeOfDuty;
    
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
    
    public $Details;
    
    Public $EOSDE; //extension of shift duty emergency
    Public $EOSDNE; //extension of shift duty non emergency
    Public $EHTPI; //extra hours to pursue investigations
    Public $EOWOOSD; //execution of warrant outside of shift duty
    Public $CAOD; //court attendance off duty
    Public $CADO; //court attendance day off

    public $OvertimeAmount;
    public $RecEnteredBy;
    public $auditok;

 
 
    function show($params) {

        $username = $_SESSION["login_user"];

        
        if (isset($_POST['btn-create'])) {
            $flexidutysheetinst = new \BarcomModel\FlexiDutySheet();
            $audinst = new \BarcomModel\Audit();

            //Get Id from browser interface
            $flexidutysheetinst->Division = $Division = $_POST["Division"];
            $flexidutysheetinst->Station = $Station = $_POST["Station"];
            
            $flexidutysheetinst->Shift = $Shift = $_POST["Shift"];
            
            $flexidutysheetinst->DateOfDuty = $DateOfDuty = $_POST["DateOfDuty"];
            $flexidutysheetinst->HoursEngaged = $HoursEngaged = $_POST["HoursEngaged"];
            
            $flexidutysheetinst->TypeOfDuty = $TypeOfDuty = $_POST["TypeOfDuty"];
            
            $flexidutysheetinst->TimeDutyCommenced = $TimeDutyCommenced = $_POST["TimeDutyCommenced"];
            $flexidutysheetinst->TimeDutyCeased = $TimeDutyCeased = $_POST["TimeDutyCeased"];
            $flexidutysheetinst->TimeDutyCommencedDiaryNo = $TimeDutyCommencedDiaryNo = $_POST["TimeDutyCommencedDiaryNo"];
            $flexidutysheetinst->TimeDutyCeasedDiaryNo = $TimeDutyCeasedDiaryNo = $_POST["TimeDutyCeasedDiaryNo"];
           
              
            
         
            
            
                        
            $flexidutysheetinst->RecEnteredBy = $RecEnteredBy = $username;
            
            $DutySheetId = $audinst->GenerateTimestamp('FLEXI');
            
            //Duty sheet preaccount 
               $OfficerArray = json_decode($_POST['offarr'], TRUE);
               foreach($OfficerArray as $officer)
  {
           $flexidutysheetinst->Comments = $Comments = $officer[10];
                   $flexidutysheetinst->ActingPayRate = $ActingPayRate = $officer[9];
           $flexidutysheetinst->ActingRateCode = $ActingRateCode = $officer[8];
           $flexidutysheetinst->Acting = $Acting = $officer[7];
           $flexidutysheetinst->OffDuty = $OffDuty = $officer[6];
           $flexidutysheetinst->DayOff = $DayOff = $officer[5];
           
             $flexidutysheetinst->ForceNumber = $ForceNumber = $officer[4];
              $flexidutysheetinst->RateCode = $RateCode = $officer[3];
              $flexidutysheetinst->PayRate = $PayRate = $officer[2];
             // $flexidutysheetinst->Hours = $Hours = $officer[2];
              $flexidutysheetinst->Natregno = $Natregno = $officer[1];
            $flexidutysheetinst->OfficerName = $OfficerName = $officer[0];
            
            
            if($Acting == "Y"){
               $flexidutysheetinst->OvertimeAmount = $OvertimeAmount = ($HoursEngaged * $ActingPayRate) + $OvertimeAmount; 
            }
            else{
               $flexidutysheetinst->OvertimeAmount = $OvertimeAmount = ($HoursEngaged * $PayRate) + $OvertimeAmount; 
            }
           
            
            
             
             
              $flexidutysheetinst->CreateFDSPA($DutySheetId, $ForceNumber, $Natregno, $OfficerName,
             $HoursEngaged, $RateCode,$PayRate,$DayOff,$OffDuty,$Acting,$ActingRateCode,$ActingPayRate,$Comments);
              
               
   
              
  }

  
   
               $flexidutysheetinst->CreateDutySheet($DutySheetId, $EventId, $EventName, $CompanyId, $OvertimeAmount, $DateOfDuty,
            $DispatchTime, $ArrivalTime, $DismissalTime,$ReturnTime,$HoursEngaged,$RecEnteredBy);
                //if validation succeeds then commit info to database
                  if ($flexidutysheetinst->auditok == 1) {
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
             $divmodel = new \BarcomModel\Division();
$divisions = $divmodel->GetDivisions();
$stations = $divmodel->GetListOfStations();

            $template = new MasterTemplate();
            $template->load("Views/FlexiDutySheet/flexidutysheet.html");
$template->replace("Divisions", $divisions);
$template->replace("Stations", $stations);
            $template->publish();
        }
    }

}
