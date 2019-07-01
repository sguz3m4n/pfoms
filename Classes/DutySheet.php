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
    public $Acting;
    public $ActingRateCode;
    public $ActingPayRate;
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
    public $HoursEngaged;
    public $Hours;
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

    function CreateDutySheet($DutySheetId, $EventId, $EventName, $CompanyId, $OvertimeAmount, $DateOfDuty, $DispatchTime, $ArrivalTime, $DismissalTime, $ReturnTime, $HoursEngaged, $RecEnteredBy) {

        $conn = conn();
        $sql = "INSERT INTO `dutysheet` (`DutySheetId`, `EventId`, `EventName`, `CompanyId`, `OvertimeAmount`, `DateOfDuty`, `DispatchTime`,
         `ArrivalTime`, `DismissalTime`, `ReturnTime`, `HoursEngaged`, `RecEnteredBy`,
             `RecEntered`, `Status`, DelFlag) VALUES 
        ('$DutySheetId', '$EventId','$EventName', '$CompanyId', '$OvertimeAmount', '$DateOfDuty', '$DispatchTime', '$ArrivalTime', '$DismissalTime', 
        '$ReturnTime','$HoursEngaged', '$RecEnteredBy', NOW(),'Active','N') ";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Method to create Duty Sheet preaccounts records in database
    function CreateDSPA($DutySheetId, $EventId, $CompanyId, $ForceNumber, $Natregno, $OfficerName, $Hours, $RateCode, $PayRate, $Acting, $ActingRateCode, $ActingPayRate ) {

        $conn = conn();
        $sql = "INSERT INTO `dutysheetpreaccount` (`DutySheetId`, `EventId`, `CompanyId`, `ForceNumber`, `Natregno`, `OfficerName`, 
          `Hours`, `RateCode`, `PayRate`,`Acting`, `Status`, `DelFlag`) VALUES 
        ('$DutySheetId', '$EventId', '$CompanyId', '$ForceNumber', '$Natregno', '$OfficerName',"
                . " '$Hours','$RateCode', '$PayRate','$Acting','$ActingRateCode','$ActingPayRate','Active','N') ";

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
