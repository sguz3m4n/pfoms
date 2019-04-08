<?php

namespace BarcomModel;

require 'Classes/Account.php';
/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

class PreAccount extends Account {


    public $TranId;
    public $AccountName;
    public $TranAmt;
    public $EventId;

    function GenerateTimestamp($schema) {
        $varschema = $schema;
        $vardatestamp = date("ymdGis", time());

        return $varschema . $vardatestamp;
    }

    function CreatePreAccountTransaction($tranid, $accountid, $accountname, $tramamt, $eventid) {
        $conn = conn();
        /* $sql = "INSERT INTO `prntransaction`(`TranId`, `BillFormNum`, `RequestorID`, `RequestorName`, `CompanyId`, `PRNCount`, `EnterBy`, `EnterDate`) 
          VALUES ('$tranid','$BillRef','$this->RequestorId','$this->RequestorName','$this->CompanyId','$this->RequestCount','$user',NOW())"; */
        $sql = "  INSERT INTO `preaccounttransactions`(`AccountId`, `AccountName`, `TranId`, `TranAmt`, `EventId`) "
                . "VALUES ('$accountid','$accountname','$tranid','$tramamt','$eventid')";
        $stmt = $conn->prepare($sql);
        $status = $stmt->execute();
        if ($status) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    function CreatePRNManager($tranid, $PRNumber, $user) {
        $conn = conn();
        $sql = "INSERT INTO `prnmanage`(`TranId`, `PRNumber`, `Status`, `EnterBy`, `EnterDate`, `ModifiedBy`, `ModifiedDate`, `CloseDate`) VALUES 
        ('$tranid','$PRNumber','Active','$user',NOW(),NULL,NULL,NOW())";
        $stmt = $conn->prepare($sql);
        $status = $stmt->execute();
        //$result = $stmt->fetchAll();
        if ($status) {
            $this->prnmanok = 1;
        } else {
            $this->prnmanok = 0;
        }
        $conn = NULL;
    }

    function ListPRNTransactions() {
        $conn = conn();
        $sql = "SELECT * FROM `prnmanage` WHERE  `RequestorID`, `RequestorName`, `CompanyId` `EnterBy`, `EnterDate`) 
        ('$tranid','$PRNumber','Active','$user',NOW(),NULL,NULL)";
        $stmt = $conn->prepare($sql);
        $status = $stmt->execute();
        //$result = $stmt->fetchAll();
        if ($status) {
            $this->prnmanok = 1;
        } else {
            $this->prnmanok = 0;
        }
        $conn = NULL;
    }

    function GetPRNDetails() {
        $conn = conn();
        $sql = "SELECT * FROM `prntransaction` WHERE  `RequestorID`, `RequestorName`, `CompanyId` `EnterBy`, `EnterDate`) 
        ('$tranid','$PRNumber','Active','$user',NOW(),NULL,NULL)";
        $stmt = $conn->prepare($sql);
        $status = $stmt->execute();
        //$result = $stmt->fetchAll();
        $conn = NULL;
    }

    function UpdatePRNTransaction($companyId, $tranid, $UpdateCount, $user) {
        $conn = conn();
        $sql = "UPDATE `prntransaction` SET `CompanyId`='$companyId',`PRNCount`='$UpdateCount',`EnterBy`='$user',`EnterDate`=NOW() WHERE `TranId`='$tranid'";
        $stmt = $conn->prepare($sql);
        $status = $stmt->execute();
        if ($status) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    function UpdatePRNManager($tranid, $PRNumber, $user) {
        $conn = conn();
        $sql = "UPDATE `prnmanage` SET `TranId`='$tranid', `EnterBy`='$user', `EnterDate`=NOW(), "
                . "`ModifiedBy`= NULL, `ModifiedDate`= NULL WHERE "
                . "`PRNumber`='$PRNumber'";
        $stmt = $conn->prepare($sql);
        $status = $stmt->execute();
        //$result = $stmt->fetchAll();
        if ($status) {
            $this->prnmanok = 1;
        } else {
            $this->prnmanok = 0;
        }
        $conn = NULL;
    }

    function ChangePRNStatus($rn) {
        $conn = conn();
        $sql = "UPDATE `prnmanage` SET `Status`='Active'"
                . " WHERE PRNumber ='" . $rn . "'";
        if ($conn->exec($sql)) {
            return true;
        } else {
            return false;
        }
        $conn = NULL;
    }

    function GetFilteredPRN(array $args) {
        $conn = conn();
        $sql = "SELECT * FROM prntransaction as A JOIN company as B ON A.CompanyId = B.CompanyId "
                . "JOIN prnmanage as C ON A.TranId = C.TranId WHERE ";
        $argCount = count($args);
        $sql = $sql . implode(" AND ", $args);

        if ($stmt = $conn->prepare($sql)) {
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                // Check number of rows in the result set
                if (!empty($result)) {
                    return $result;
                }
            } else {
                return array();
            }
        }
    }

}
