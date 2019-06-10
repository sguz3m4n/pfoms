<?php

namespace BarcomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler
  Property of Barbados Customs and Excise Department 2017
  Consultation and Analysis by Data Processing Department
  October 2017
 */

class DutySheet {

    function __construct() {
        
    }

    public $DutySheetId;
    public $EventId;
    public $CompanyId;
    public $Natregno;
    public $ForceNumber;
    public $RateCode;
    public $OfficerName;
    public $PayRate;
    public $EventName;
    public $OvertimeAmount;
    public $DateOfDuty;
    public $DispatchTime;
    public $ArrivalTime;
    public $DismissalTime;
    public $ReturnTime;
    public $TotalHoursWorked;
    public $Hours;
    public $RecEnteredBy;
    public $auditok;

    
   

    //Method to calcuate payment based on overtime hours worked
    function OTEarned($hours, $rate) {
        $earnings = $rate * $hours;
        $earnings = number_format($earnings, 2, '.', '');
        return $earnings;
    }

    

    //Method to create Duty Sheet record in database
    function CreateDutySheet($DutySheetId, $EventId, $EventName, $CompanyId, $OvertimeAmount, $DateOfDuty,
            $DispatchTime, $ArrivalTime, $DismissalTime,$ReturnTime,$TotalHoursWorked,$RecEnteredBy) {

        $conn = conn();
        $sql = "INSERT INTO `dutysheet` (`DutySheetId`, `EventId`, `EventName`, `CompanyId`, `OvertimeAmount`, `DateOfDuty`, `DispatchTime`,
         `ArrivalTime`, `DismissalTime`, `ReturnTime`, `TotalHoursWorked`, `RecEnteredBy`,
             `RecEntered`, `Status`, DelFlag) VALUES 
        ('$DutySheetId', '$EventId','$EventName', '$CompanyId', '$OvertimeAmount', '$DateOfDuty', '$DispatchTime', '$ArrivalTime', '$DismissalTime', 
        '$ReturnTime','$TotalHoursWorked', '$RecEnteredBy', 'NOW()','Active','N') ";

            if ($conn->exec($sql)) {
                $this->auditok = 1;
            } else {
                $this->auditok = 0;
            }
        $conn = NULL;
    }
    
    
     //Method to create Duty Sheet preaccounts records in database
    function CreateDSPA($DutySheetId, $EventId, $ForceNumber, $Natregno, $OfficerName,
            $Role, $Hours, $RateCode,$PayRate) {

        $conn = conn();
        $sql = "INSERT INTO `dutysheet` (`DutySheetId`, `EventId`, `ForceNumber`, `Natregno`, `OfficerName`, 
          `Hours`, `RateCode`, `PayRate`, `Status`, `DelFlag`) VALUES 
        ('$DutySheetId', '$EventId', '$ForceNumber', '$Natregno', '$OfficerName', '$Role',
        '$Hours','$RateCode', '$PayRate','Active','N') ";

            if ($conn->exec($sql)) {
                $this->auditok = 1;
            } else {
                $this->auditok = 0;
            }
        $conn = NULL;
    }

    

  
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

    function GetCompanyBalance($compid) {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `CurrentBalance` FROM `deposit` WHERE `CompanyId`='$compid'");
        $stmt->execute();
        $result = $stmt->fetch();
        if (isset($result['CurrentBalance'])) {
            return $result['CurrentBalance'];
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

