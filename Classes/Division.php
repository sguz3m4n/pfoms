<?php

namespace PfomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

class Division {

    public $DivisionId;
    public $DivisionName;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;

    function CreateDivision($DivisionId, $DivisionName, $RecEnteredBy) {
        $conn = conn();
        $sql = "INSERT INTO `division` (`DivisionId`, `DivisionName`, `RecEntered`, `RecEnteredBy`,`DelFlg`)
            VALUES ('$DivisionId', '$DivisionName', NOW(), '$RecEnteredBy','N')";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    function GetDivision($DivisionId) {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `DivisionId`, `DivisionName`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `DelFlg`"
                . " FROM `division` "
                . "WHERE DivisionId = '$DivisionId' "
                . "AND DelFlg ='N';");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    function RemoveDivision($DivisionId) {
        $conn = conn();
        $sql = "UPDATE `division` SET DelFlg='Y' WHERE DivisionId='$DivisionId'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    function UpdateDivision($DivisionId) {
        $conn = conn();

        $sql = "UPDATE `division` SET `DivisionName`=" . $this->DivisionName . ", `RecEntered`="
                . $this->RecEntered . ", `RecEnteredBy`=" . $this->RecEnteredBy
                . ", `RecModified`=" . $this->RecModified . ",`RecModifiedBy`=" . $this->RecModifiedBy
                . " WHERE DivisionId ='" . $DivisionId . "'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }
    
        //Check to see if Employee currently exist Method
    function IfExists($DivisionId) {
        $conn = conn();
        $stmt = $conn->prepare("SELECT * FROM division WHERE DivisionId = '$DivisionId' ;");
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
    function GetDivisions() {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `DivisionId`, `DivisionName` FROM division ORDER BY `DivisionName` ASC;");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $divisionid= $value['DivisionId'];
            $result .= "<option id='$divisionid' >" . $value['DivisionName'] . "</option>";
        }
        return $result;
        $conn = NULL;
    }
    //base on division
     function  GetListOfStations(){
         $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `StationName`, `DivisionId`"
                . " FROM `station` "
                . "WHERE DelFlg ='N';");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
     
        foreach ($result_array as $value) {
            $DivCode = $value['DivisionId'];
            if ($DivCode == "BDIV"){
                $result .= "<option id='$DivCode' >" . $value['StationName'] . "</option>";
            }
            else {$result .= "<option id='$DivCode' style='display:none;' >" . $value['StationName'] . "</option>";}
            
        }
        return $result;
        $conn = NULL;
     
    }

}
