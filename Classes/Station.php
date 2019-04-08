<?php

namespace BarcomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

class Station {

   
    public $StationId;
    public $StationName;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;
            

  
    function CreateEquipment($StationId, $StationName, $RecEnteredBy) {

        $conn = conn();
        $sql = "INSERT INTO `station` (`StationId`, `StationName`, `RecEntered`, `RecEnteredBy`,`DelFlg`)
            VALUES ('$StationId', '$StationName', NOW(), '$RecEnteredBy','N')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }
    
    function  getEquipment($StationId){
         $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `StationId`, `StationName`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `DelFlg`"
                . " FROM `station` "
                . "WHERE StationId = '$StationId' "
                . "and DelFlg ='N';");
        $stmt->execute();
        $result = $stmt->fetchAll();
     
        return $result;
        
    }
    
    function  RemoveEquipment($StationId){
       $conn = conn();
        $sql = "UPDATE `station` SET DelFlg='Y' WHERE StationId='$StationId'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
        
    }
            
     function UpdateEquipment($StationId) {
        $conn = conn();
    
        $sql = "UPDATE `station` SET `StationName`=" . $this->StationName .", `RecEntered`=" 
                . $this->RecEntered . ", `RecEnteredBy`=" . $this->RecEnteredBy
                . ", `RecModified`=" . $this->RecModified . ",`RecModifiedBy`=" . $this->RecModifiedBy 
                . " WHERE StationId ='" . $StationId . "'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    
}