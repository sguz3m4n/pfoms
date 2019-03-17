<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */
namespace BarcomModel;

class ManagePOT {

    public $RoleCode;
    public $RoleName;
    public $RateCode;
    public $RateAmount;
    public $DateModified;
    public $ModifiedBy;

    //Create New Overtime Payment Rate
    function CreateNewPOT() {
        $conn = conn();
        $sqlprnt = "INSERT INTO `employeeroles`(`RoleCode`, `RoleName`, `RateCode`, `DateModified`, `MofidiedBy`) VALUES "
                . "('$this->RoleCode','$this->RoleName','$this->RateCode',NOW(),'$this->ModifiedBy')";
        $sql = "INSERT INTO `paymentrates`(`RateCode`, `RateAmount`, `DateModified`, `ModifiedBy`) 
        VALUES ('$this->RateCode','$this->RateAmount',NOW(),'$this->ModifiedBy')";
        if (($conn->exec($sqlprnt)) && ($conn->exec($sql))) {
            return 1;
        } else {
            return 0;
        }
        $conn = NULL;
    }

    //Edit Overtime Payment Rate
    function UpdateOT($RateCode) {
        $conn = conn();
        $sql = "UPDATE `paymentrates` SET `RateCode`='$this->RateCode',`RateAmount`='$this->RateAmount',
        `DateModified`=NOW(),`ModifiedBy`='$this->ModifiedBy' WHERE `RateCode`='$RateCode'";
        if ($conn->exec($sql)) {
            return 1;
        } else {
            return 0;
        }
        $conn = NULL;
    }


    //Check to see if rate currently exists
    function IfExists($ratecode) {
        $conn = conn();
        $sql = "SELECT * FROM `paymentrates` WHERE RateCode='$ratecode'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            return 1;
        }
        return 0;
        $conn = NULL;
    }

    //Get Travel Codes
    function GetRateCode() {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT paymentrates.RateCode,employeeroles.RoleName FROM `employeeroles` employeeroles,`paymentrates` paymentrates WHERE employeeroles.RoleCode=paymentrates.RateCode ");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $item = $value['RateCode'];
            $result .= "<option id='$item' >" . $value['RoleName'] . "</option>";
        }
        return $result;
        $conn = NULL;
    }

}