<?php

namespace BarcomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

class Account {

   
    public $AccountId;
    public $Name;
    public $Type;    
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;
            

  
    function CreateAccount($AccountId, $Name, $Type, $RecEntered, $RecEnteredBy,$DelFlg) {

        $conn = conn();
        $sql = "INSERT INTO `account` (`AccountId`, `Name`, `Type`, `RecEntered`, `RecEnteredBy`,`DelFlg`)
            VALUES ('$AccountId', '$Name', '$Type', NOW(), '$RecEnteredBy','N')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }
    
    function  getAccount($AccountId){
         $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `AccountId`, `Name`, `Type`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `DelFlg`"
                . " FROM `account` "
                . "WHERE AccountId = '$AccountId' "
                . "and DelFlg ='N';");
        $stmt->execute();
        $result = $stmt->fetchAll();
     
        return $result;
        
    }
    
    function  RemoveAccount($AccountId){
       $conn = conn();
        $sql = "UPDATE `account` SET DelFlg='Y' WHERE AccountId='$AccountId'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
        
    }
            
     function UpdateAccount($AccountId) {
        $conn = conn();
    
        $sql = "UPDATE `account` SET `Name`=" . $this->Name . ",`Type`="
                . $this->Type . "',`RecEntered`="
                . $this->RecEntered . ", `RecEnteredBy`=" . $this->RecEnteredBy
                . ", `RecModified`=" . $this->RecModified . ",`RecModifiedBy`=" . $this->RecModifiedBy 
                . " WHERE AccountId ='" . $AccountId . "'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    
}