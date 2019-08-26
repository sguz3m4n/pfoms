<?php

namespace PfomModel;

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
    public $ResourceId;
    public $ResourceCount;
    public $ResourceRate;
    public $auditok;
    public $Comments;
    public $Status;

    //Method to calcuate payment based on overtime hours worked
    function OTEarned($hours, $rate) {
        $earnings = $rate * $hours;
        $earnings = number_format($earnings, 2, '.', '');
        return $earnings;
    }

    function GetListDutySheet($dutysheetid) {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT company.CompanyName, dutysheet.* FROM `dutysheetevent` as dutysheet,`company` as company WHERE company.CompanyId=dutysheet.CompanyId AND dutysheet.DutySheetId='" . $_REQUEST['dutysheetid'] . "' AND dutysheet.DelFlg='N';");

        $stmt->execute();
        $result_array = $stmt->fetchAll();
//        $result = "<option id=' ' >" . " " . "</option>";
//        foreach ($result_array as $value) {
//            $PRNNo = $value['PRNumber'];
//            $result .= "<option id='$PRNNo' >" . $value['PRNumber'] . "</option>";
//        }
        return $result_array;
        $conn = NULL;
    }

    //Method to create Duty Sheet preaccounts records in database
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

    //Method to create Duty Sheet preaccounts records in database
    function CreateDutySheet($DutySheetId, $EventId, $CompanyId, $DateOfDuty, $DispatchTime, $ArrivalTime, $DismissalTime, $ReturnTime, $HoursEngaged, $RecEnteredBy) {

        $conn = conn();
        $sql = "INSERT INTO `dutysheetevent` (`DutySheetId`, `EventId`, `CompanyId`,`DutyDate`, `DispatchTime`,
         `ArrivalTime`, `DismissalTime`, `ReturnTime`, `HoursEngaged`, `RecEntered`,  `RecEnteredBy`,
            `RecModified`,`RecModifiedBy`,  DelFlg) VALUES 
        ('$DutySheetId', '$EventId','$CompanyId', '$DateOfDuty', '$DispatchTime', '$ArrivalTime', '$DismissalTime', 
        '$ReturnTime','$HoursEngaged', NOW(), '$RecEnteredBy',NOW(),'$RecEnteredBy','N') ";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Method to create Duty Sheet preaccounts records in database
    function CreateDSPA($DutySheetId, $ForceNumber, $Natregno, $OfficerName, $Hours, $RateCode, $PayRate, $Acting, $ActingRateCode, $ActingPayRate, $Comments, $Status) {

        $conn = conn();
        $sql = "INSERT INTO `dutysheetservices`(`DutySheetId`, `ForceNumber`, `Natregno`, `OfficerName`, `Hours`,
            `RateCode`, `PayRate`, `Acting`, `ActingRateCode`, `ActingPayRate`, `Comments`, `Status`, `DelFlag`) VALUES 
        ('$DutySheetId', '$ForceNumber', '$Natregno', '$OfficerName',"
                . " '$Hours','$RateCode', '$PayRate','$Acting','$ActingRateCode','$ActingPayRate','$Comments','Active','N') ";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Method to create Duty Sheet preaccounts records in database
    function CreateOPSUP($DutySheetId, $ResourceId, $ResourceCount, $ResourceRate) {
        $conn = conn();
        $sql = "INSERT INTO `dutysheetopsupport`(`DutySheetId`, `ResourceId`, `ResourceCount`, `ResourceRate`, `Status`, `DelFlag`) VALUES
        ('$DutySheetId', '$ResourceId', '$ResourceCount', '$ResourceRate','Active','N') ";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Method to create Duty Sheet preaccounts records in database
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

    //Method to create Duty Sheet preaccounts records in database
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
