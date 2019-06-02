<?php

namespace BarcomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

class Config {

   
    public $ItemCode;
    public $ItemName;
    public $Value;
    public $Comments;
   
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;
            

  
    function CreateConfig($ItemCode, $ItemName, $Value,$Comments,$RecEnteredBy,$DelFlg) {

        $conn = conn();
        $sql = "INSERT INTO `config` (`ItemCode`, `ItemName`, `Value`, `Comments`, `RecEntered`, `RecEnteredBy`,`DelFlg`)
            VALUES ('$ItemCode', '$ItemName', '$Value','$Comments', NOW(), '$RecEnteredBy','N')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }
    
    function  getConfig($ItemCode){
         $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `ItemCode`, `ItemName`, `Value`, `Comments`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `DelFlg`"
                . " FROM `config` "
                . "WHERE ItemCode = '$ItemCode' "
                . "and DelFlg ='N';");
        $stmt->execute();
        $result = $stmt->fetchAll();
     
        return $result;
        
    }
    
    function  RemoveConfig($ItemCode){
       $conn = conn();
        $sql = "UPDATE `config` SET DelFlg='Y' WHERE ItemCode='$ItemCode'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
        
    }
            
     function UpdateConfig($ItemCode) {
        $conn = conn();
    
        $sql = "UPDATE `config` SET `ItemCode`= '$this->ItemCode' ,`ItemName`="
                . "'$this->ItemName', `Value`= '$this->Value',`Comments`= '$this->Comments' , "
                . "`RecModified`= '$this->RecModified' ,`RecModifiedBy`= '$this->RecModifiedBy' "
                .  "WHERE ItemCode ='" . $ItemCode . "'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }
    
    function IfExists($ItemCode) {
        $conn = conn();
        $stmt = $conn->prepare("select * from `config` WHERE `ItemCode`='$ItemCode';");
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (($result)) {
            return 1;
        }    
    }

    
}