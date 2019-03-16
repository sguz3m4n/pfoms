<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace BarcomModel;

class Employee {

    //Employee class properties map directly to employee table
    public $Natregno;
    public $TIN;
    public $NISNo;
    public $ForceNumber;
    public $LastName;
    public $FirstName;
    public $Initial;
    public $Title;
    public $AddressLine1;
    public $AddressLine2;
    public $AddressLine3;
    public $Parish;
    public $PostalCode;
    public $WorkPhone;
    public $HomePhone;
    public $CellNo;
    public $Ext;
    public $RoleName;
    public $PostType;
    public $DateOfBirth;
    public $Age;
    public $Gender;
    public $RateCode;
    public $Notes;
    public $Email;
    public $EmpStatus;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;
    //Employee class properties map directly to employee table

    public $PayRate;
    public $auditok;
    public $activepersons;
    public $BankAccountNumber;

    //CRUD FUNCTIONALITY
    //Create Employee Method
    function CreateEmployee($username) {
        $conn = conn();
        $sql = "INSERT INTO `employee`(`Natregno`, `TIN`, `NISNo`, `ForceNumber`, `LastName`, `FirstName`, `Initial`, `Title`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `Parish`, `PostalCode`, `WorkPhone`, `HomePhone`, `CellNo`, `Ext`, `RoleName`, `PostType`, `DateOfBirth`, `Age`, `Gender`, `RateCode`, `Notes`, `Email`, `EmpStatus`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `DelFlg`) VALUES "
                . "('$this->Natregno', '$this->TIN', '$this->NISNo', '$this->ForceNumber', '$this->LastName', '$this->FirstName', '$this->Initial', '$this->Title', '$this->AddressLine1', '$this->AddressLine2', '$this->AddressLine3', '$this->Parish', '$this->PostalCode', '$this->WorkPhone', '$this->HomePhone', '$this->CellNo', '$this->Ext', '$this->RoleName', '$this->PostType', '$this->DateOfBirth', '$this->Age', '$this->Gender', '$this->RateCode', '$this->Notes', '$this->Email', '$this->EmpStatus', NOW(), '$username', NULL, '$this->RecModifiedBy', '$this->DelFlg')";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Update Employee Method
    function EditEmployee($natregno) {
        $conn = conn();

        $sql = "UPDATE `employee` SET `Natregno`='$this->Natregno',`TIN`='$this->TIN',`NISNo`='$this->NISNo',"
                . "`ForceNumber`='$this->ForceNumber',`LastName`='$this->LastName',`FirstName`='$this->FirstName',"
                . "`Initial`='$this->Initial',`Title`='$this->Title',`AddressLine1`='$this->AddressLine1',"
                . "`AddressLine2`='$this->AddressLine2',`AddressLine3`='$this->AddressLine3',`Parish`='$this->Parish',"
                . "`PostalCode`='$this->PostalCode',`WorkPhone`='$this->WorkPhone',`HomePhone`='$this->HomePhone',"
                . "`CellNo`='$this->CellNo',`Ext`='$this->Ext',`RoleName`='$this->RoleName',"
                . "`PostType`='$this->PostType',`DateOfBirth`='$this->DateOfBirth',`Age`='$this->Age',"
                . "`Gender`='$this->Gender',`RateCode`='$this->RateCode',"
                . "`Notes`='$this->Notes',`Email`='$this->Email',`EmpStatus`='$this->EmpStatus',"
                . "`RecModified`=NOW(),`RecModifiedBy`='$this->RecModifiedBy'"
                . "WHERE Natregno='$natregno' AND DelFlg='N'";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Delete Employee Method
    function DeleteEmployee($natregno) {
        $conn = conn();
        $sql = "UPDATE employee SET DelFlg='Y' WHERE Natregno='$natregno'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Check to see if Employee currently exist Method
    function IfExists($natregno) {
        $conn = conn();
        $stmt = $conn->prepare("SELECT * FROM employee WHERE Natregno='$natregno';");
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (($result)) {
            return 1;
        }
        return 0;
        $conn = NULL;
    }

    //Get Role and RateCode from table Method
    //This is to provide values for drop down control on the browser interface
    function GetRoles() {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT rolename,ratecode FROM employeeroles ORDER BY rolename ASC;");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $ratecode = $value['ratecode'];
            $result .= "<option id='$ratecode' >" . $value['rolename'] . "</option>";
        }
        return $result;
        $conn = NULL;
    }

    //Get Parishes from table Method
    //This is to provide values for drop down control on the browser interface
    function GetParishes() {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT parish FROM parish ORDER BY parish ASC;");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $result .= "<option>" . $value['parish'] . "</option>";
        }
        return $result;
        $conn = NULL;
    }

    //Get Active Employees Method
    function CountActive() {
        $conn = conn();
        $stmt = $conn->prepare("SELECT count(Natregno) val FROM employee WHERE EmpStatus='Active' AND DelFlg='N';");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $this->activepersons = $value['val'];
        }
        return $this->activepersons;
        $conn = NULL;
    }

    function GetEmployee($natregno) {
        $sql = " SELECT * FROM `paymentrates` payrate,`employee` emp WHERE emp.ratecode=payrate.ratecode AND Natregno='$natregno'";
        $conn = conn();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

//View functionality is contained in the shared controls in the Views folder
}
