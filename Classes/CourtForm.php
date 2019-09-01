<?php

namespace BarcomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

class CourtForm {

    function __construct() {
        
    }

    public $CourtFormId;
   public $Name;
   public $Rank;
    public $ForceNumber;
    public $RateCode;
    public $PayRate;
    
    public  $Court;
      public $DateOfAttendance;
        public $CourtCase;
         public $CaseNo;
         public $Station;
         
   public $Comments;
   
    public $DayOff;
    public $OffDuty;
    
    public $OvertimeAmount;
    public $RecEnteredBy;
    public $auditok;

    
   

    //Method to calcuate payment based on overtime hours worked
    function OTEarned($hours, $rate) {
        $earnings = $rate * $hours;
        $earnings = number_format($earnings, 2, '.', '');
        return $earnings;
    }

    
 function GetSelectedDutySheet($companyId) {
        $conn = conn();
        $sqlDutySheet = 'SELECT DutySheetId, EventId, EventName, OvertimeAmount, DateOfDuty, DispatchTime, ArrivalTime, DismissalTime, ReturnTime, '
        . 'HoursEngaged FROM dutysheet WHERE CompanyId = "' . $companyId . '" AND DelFlag="N" AND Status="Active"';
$stmtDutySheet = $conn->prepare($sqlDutySheet);
$stmtDutySheet->execute();
$result_DutySheet = $stmtDutySheet->fetchAll();
//
//        $sql = 'SELECT * FROM payment as A JOIN company as B ON A.CompanyId = B.CompanyId '
//                . 'JOIN employee as C ON A.natregno = C.natregno WHERE ';
//        $sql = $sql . implode(' ', $args);

        //if ($stmt = $conn->prepare($sql)) {
            // Attempt to execute the prepared statement
          //  if ($stmt->execute()) {
            //    $result = $stmt->fetchAll();
                // Check number of rows in the result set
                if (!empty($result_DutySheet)) {
                    return $result_DutySheet;
             //   }
            } else {
                return array();
            }
        }
    //}
    //Method to create Duty Sheet record in database
  
    function CreateCourtForm($CourtFormId, $Name, $Rank, $ForceNumber, $RateCode, $PayRate, $Court,
            $DateOfAttendance, $CourtCase,$CaseNo,$Station,
            $Comments,$DayOff,$OffDuty,$OvertimeAmount,$RecEnteredBy) {

        $conn = conn();
        $sql = "INSERT INTO `courtform` (`CourtFormId`, `Name`, `Rank`, `ForceNumber`, `RateCode`, `PayRate`, 
            `Court`,`DateOfAttendance`,`CourtCase`,`CaseNo`,`Station`,
            `Comments`,`DayOff`,`OffDuty`,`OvertimeAmount`,`RecEnteredBy`,
             `RecEntered`, `Status`, DelFlag) VALUES 
        ('$CourtFormId', '$Name','$Rank', '$ForceNumber', '$RateCode','$PayRate', '$Court',"
                . " '$DateOfAttendance', '$CourtCase', '$CaseNo','$Station', "
        ." '$Comments','$DayOff','$OffDuty','$OvertimeAmount',"
                . " '$RecEnteredBy', NOW(),'Active','N') ";

            if ($conn->exec($sql)) {
                $this->auditok = 1;
            } else {
                $this->auditok = 0;
            }
        $conn = NULL;
    }
    
    
     //Method to create Special Ops Duty Sheet preaccounts records in database
//    function CreateSDSPA($DutySheetId, $ForceNumber, $Natregno, $OfficerName,
//             $Hours, $RateCode,$PayRate, $OvertimeAmount) {
//
//        $conn = conn();
//        $sql = "INSERT INTO `specopsdutysheetpreaccount` (`DutySheetId`, `ForceNumber`, `Natregno`, `OfficerName`, 
//          `Hours`, `RateCode`, `PayRate`,`OvertimeAmount`, `Status`, `DelFlag`) VALUES 
//        ('$DutySheetId', '$ForceNumber', '$Natregno', '$OfficerName',"
//                . " '$Hours','$RateCode','$PayRate','$OvertimeAmount', 'Active','N') ";
//
//            if ($conn->exec($sql)) {
//                $this->auditok = 1;
//            } else {
//                $this->auditok = 0;
//            }
//        $conn = NULL;
//    }

    

  
    function GetPayRate($transid) {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT OvertimeRate FROM `payment` "
                . "WHERE TransId='$transid' AND `Status`='Active';");
        $stmt->execute();
        $result = $stmt->fetch();
        if (isset($result['OvertimeRate'])) {
            return $result['OvertimeRate'];
        } else {
            return NULL;
        }
        $conn = NULL;
    }

    //Method to generate unique timestamp value 
    //Key will be prefixed with schema var and follow the format
    //1710211906
    //2 character year-- 2 character month-- 2 character date-- 2 character 24hour time -- 2 character min
    function GenerateTimestamp($schema) {
        $varschema = $schema;
        $vardatestamp = date("ymdGis", time());

        return $varschema . $vardatestamp;
    }

   
}

