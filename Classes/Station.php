<?php

namespace BarcomModel;
require_once 'Division.php';
/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

class Station extends Division {

    public $DivisionId;
    public $StationId;
    public $StationName;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;
            

  
    function CreateStation($DivisionId, $StationId, $StationName, $RecEnteredBy) {
        $conn = conn();
        $sql = "INSERT INTO `station` (`DivisionId`, `StationId`, `StationName`, `RecEntered`, `RecEnteredBy`,`DelFlg`)
            VALUES ('$DivisionId', '$StationId', '$StationName', NOW(), '$RecEnteredBy','N')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }
    
    function  GetStation($StationId){
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
    
    function  RemoveStation($StationId){
       $conn = conn();
        $sql = "UPDATE `station` SET DelFlg='Y' WHERE StationId='$StationId'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
        
    }
            
    function UpdateStation($DivisionId, $StationId, $StationName, $username) {
        $conn = conn();
    
        $sql = "UPDATE `station` SET `DivisionId`='" . $DivisionId ."', `StationName`='" . $StationName
                . "', `RecModified`=NOW(),`RecModifiedBy`='" . $username 
                . "' WHERE StationId ='" . $StationId . "'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }
    
    //Check to see if company currently exists
    function IfExists($StationId) {
        $conn = conn();
        $sql = "SELECT * FROM station WHERE StationId='$StationId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (($result)) {
            return 1;
        }
        return 0;
        $conn = NULL;
    }

 
    
}
//SELECT division.DivisionName FROM `station` station,`division` division WHERE station.DivisionId=division.DivisionId