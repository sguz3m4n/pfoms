<?php

namespace BarcomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler
  Property of Barbados Customs and Excise Department 2017
  Consultation and Analysis by Data Processing Department
  October 2017
 */

class Event {

    public $EventId;
    public $EventName;
    public $EventCost;
    public $CompanyId;
    public $CompanyName;
    public $ContactName;
    public $ContactNumber;
    public $ContactEmail;
    public $EventDateStart;
        public $EventDateEnd;
    public $Comments;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $Status;
    public $DelFlg;
    public $OperationalSupport = "";
    public $PoliceServices = "";
    public $VATPoliceServices = "";

    function GetPreAccounts() {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT AccountName,AccountId FROM account ORDER BY AccountName ASC;");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $accountcode = $value['AccountId'];
            $result .= "<option id='$accountcode' >" . $value['AccountName'] . "</option>";
        }
        return $result;
        $conn = NULL;
    }

//    
    function GetRoleRates() {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT rates.RateCode,roles.rolename,rates.RateAmount FROM paymentrates rates , employeeroles roles WHERE"
                . " rates.RateCode=roles.RateCode;");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $ratecode = $value['RateCode'];
            $rateamount = $value['RateAmount'];
            $result .= "<option id='$ratecode' value='$rateamount' >" . $value['rolename'] . "</option>";
        }
        return $result;
        $conn = NULL;
    }

    function GetVat() {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT ItemValue FROM config WHERE `ItemName` = 'VAT' and DelFlg = 'N';");
        $stmt->execute();
        $result = $stmt->fetchAll();
        //    $result = "0.1750";
        foreach ($result as $value) {
            $ItemValue = $value['ItemValue'];
        }
        return $ItemValue;
    }

    function GenerateTimestamp($schema) {
        $varschema = $schema;
        $vardatestamp = date("ymdGis", time());

        return $varschema . $vardatestamp;
    }

    function CreateEvent($EventId, $EventName, $EventCost, $CompanyId, $CompanyName, $ContactName, $ContactNumber, $ContactEmail, $EventDateStart,$EventDateEnd, $Comments, $RecEnteredBy, $OperationalSupport, $PoliceServices, $VATPoliceServices) {

        $conn = conn();
        $sql = "INSERT INTO `event` (`EventId`, `EventName`,`EventCost`, `CompanyId`, `CompanyName`, `ContactName`, 
    `ContactEmail`,`ContactNumber`, `EventDateStart`, `EventDateEnd`, `Comments`, `RecEntered`, `RecEnteredBy`, `Status`, `DelFlg`, `OperationalSupport`, `PoliceServices`, `VATPoliceServices`)
            VALUES ('$EventId', '$EventName', '$EventCost', '$CompanyId', '$CompanyName', '$ContactName',"
                . "'$ContactEmail','$ContactNumber', '$EventDateStart','$EventDateEnd', '$Comments', NOW(), '$RecEnteredBy','Active','N', $OperationalSupport, $PoliceServices, $VATPoliceServices)";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
    }

    function GetEvent($EventId) {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `EventId`, `EventName`, `EventCost`,`CompanyId`, `CompanyName`, `ContactName`, `ContactEmail`, `ContactNumber`, "
                . "`EventDate`, `Comments`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `Status`,`OperationalSupport`, `PoliceServices`, `VATPoliceServices`,"
                . " `DelFlg` FROM `event` WHERE EventId = '$EventId' and DelFlg ='N';");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    function RemoveEvent($EventId) {
        $conn = conn();
        $sql = "UPDATE event SET DelFlg='Y' WHERE EventId='$EventId'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
    }

    function UpdateEvent($EventId) {
        $conn = conn();
        $sql = "UPDATE `event` SET `EventName` = '$this->EventName', "
                . "`EventDate`= '$this->EventDate', `EventCost`= '$this->EventCost' "
                . ", `Comments`='$this->Comments' , `RecModified`= NOW() ,`RecModifiedBy`= '$this->RecModifiedBy'"
                . ", `OperationalSupport`= '$this->OperationalSupport',`PoliceServices`= '$this->PoliceServices' "
                . ",`VATPoliceServices`= '$this->VATPoliceServices' "
                . " WHERE EventId ='" . $EventId . "'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
    }

}
