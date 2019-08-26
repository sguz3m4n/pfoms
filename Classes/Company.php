<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace PfomModel;

class Company {

    function __construct() {
    
    }

    //Company class properties map directly to company table
    public $CompanyId;
    public $CaipoId;
    public $TIN;
    public $CompanyName;
    public $AddressLine1;
    public $AddressLine2;
    public $AddressLine3;
    public $Parish;
    public $PostalCode;
    public $ContactName;
    public $PhoneNumber;
    public $BankAccountNumber;
    public $FaxNumber;
    public $Email;
    public $Notes;
    public $CompStatus;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;
    //Company class properties map directly to company table

    public $auditok;
    public $ActiveCompanies;
    public $ZeroBalance;
    public $CompanyAddress;

    //Create Company Method
    function CreateCompany($username) {
        $conn = conn();
        $sql = "INSERT INTO `company`(`CompanyId`, `CaipoId`, `TIN`, `CompanyName`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `Parish`, `PostalCode`, `ContactName`, `PhoneNumber`, `FaxNumber`, `Email`, `Notes`, `CompStatus`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `DelFlg`) VALUES "
                . "('$this->CompanyId', '$this->CaipoId', '$this->TIN', '$this->CompanyName', '$this->AddressLine1', '$this->AddressLine2', '$this->AddressLine3', '$this->Parish', '$this->PostalCode', '$this->ContactName', '$this->PhoneNumber', '$this->FaxNumber', '$this->Email', '$this->Notes', '$this->CompStatus',NOW() , '$username', NULL, '$this->RecModifiedBy', '$this->DelFlg')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }



    //Update Company Method
    function EditCompany($compid) {
        $conn = conn();
        $sql = "UPDATE `company` SET `CompanyId`='$this->CompanyId',`CaipoId`='$this->CaipoId',`TIN`='$this->TIN',"
                . "`CompanyName`='$this->CompanyName',`AddressLine1`='$this->AddressLine1',`AddressLine2`='$this->AddressLine2',"
                . "`AddressLine3`='$this->AddressLine3',`Parish`='$this->Parish',`PostalCode`='$this->PostalCode',`ContactName`='$this->ContactName',"
                . "`PhoneNumber`='$this->PhoneNumber',`FaxNumber`='$this->FaxNumber',`Email`='$this->Email',`Notes`='$this->Notes',"
                . "`CompStatus`='$this->CompStatus',`RecModified`=NOW(),`RecModifiedBy`='$this->RecModifiedBy'"
                . " WHERE `TIN`='$compid' AND DelFlg='N'";
        //$conn = conn();
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Delete Company Method
    function DeleteCompany($compid) {
        $conn = conn();
        $sql = "UPDATE company SET DelFlg='Y' WHERE TIN='$compid'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Check to see if company currently exists
    function IfExists($compid) {
        $conn = conn();
        $sql = "SELECT * FROM company WHERE TIN='$compid'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (($result)) {
            return 1;
        }
        return 0;
        $conn = NULL;
    }

    //List of Parishes
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

    //Get Active Company Method
    function CountActive() {
        $conn = conn();
        $sql = "SELECT count(CompanyId) val FROM company WHERE CompStatus='Active' AND DelFlg='N'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $this->ActiveCompanies = $value['val'];
        }
        return $this->ActiveCompanies;
        $conn = NULL;
    }

    //Get Zero Balance Company Method
    function CountZeroBalance() {
        $conn = conn();
        $sql = "SELECT count( dep.CurrentBalance) val FROM deposit dep , company comp WHERE dep.companyid=comp.CompanyId AND comp.DelFlg='N' AND comp.CompStatus='Active' AND dep.CurrentBalance<=0 ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $this->ZeroBalance = $value['val'];
        }
        if (empty($result_array)) {
            return $this->ZeroBalance = '0';
        } else {
            return $this->ZeroBalance;
        }

        $conn = NULL;
    }

    function GetCompanyId($compname) {
        $conn = conn();
        $sql = "SELECT companyId FROM company WHERE CompanyName='$compname'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        if (empty($result)) {
            return 0;
        }
        return $result['companyId'];
        $conn = NULL;
    }

}
