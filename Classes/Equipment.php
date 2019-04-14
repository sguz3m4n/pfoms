<?php

namespace BarcomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

class Equipment {

   
    public $EquipmentId;
    public $ItemName;
    public $Category;
    public $UnitCost;
    public $UnitMeasurement;

    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;
            

  
    function CreateEquipment($EquipmentId, $ItemName, $Category,$UnitCost, $UnitMeasurement,$RecEntered, $RecEnteredBy,$DelFlg) {

        $conn = conn();
        $sql = "INSERT INTO `equipment` (`EquipmentId`, `ItemName`, `Category`, `UnitCost`, `UnitMeasurement`, `RecEntered`, `RecEnteredBy`,`DelFlg`)
            VALUES ('$EquipmentId', '$ItemName', '$Category','$UnitCost','$UnitMeasurement', NOW(), '$RecEnteredBy','N')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }
    
    function  getEquipment($EquipmentId){
         $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `EquipmentId`, `ItemName`, `Category`, `UnitCost`, `UnitMeasurement`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `DelFlg`"
                . " FROM `equipment` "
                . "WHERE EquipmentId = '$EquipmentId' "
                . "and DelFlg ='N';");
        $stmt->execute();
        $result = $stmt->fetchAll();
     
        return $result;
        
    }
    
    function  RemoveEquipment($EquipmentId){
       $conn = conn();
        $sql = "UPDATE `equipment` SET DelFlg='Y' WHERE EquipmentId='$EquipmentId'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
        
    }
            
     function UpdateEquipment($EquipmentId) {
        $conn = conn();
    
        $sql = "UPDATE `equipment` SET `ItemName`=" . $this->ItemName . ",`Category`="
                . $this->Category . ", `UnitCost`=" . $this->UnitCost . ",`UnitMeasurement`=" . $this->UnitMeasurement .", `RecEntered`=" 
                . $this->RecEntered . ", `RecEnteredBy`=" . $this->RecEnteredBy
                . ", `RecModified`=" . $this->RecModified . ",`RecModifiedBy`=" . $this->RecModifiedBy 
                . " WHERE EquipmentId ='" . $EquipmentId . "'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    
}