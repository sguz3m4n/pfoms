<?php

namespace BarcomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

class WorkFlow {

   
    public $RoleId;
    public $RoleName;
        public $Comments;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;
            

  
    function CreateEquipment($RoleId, $RoleName, $Comments, $RecEnteredBy) {

        $conn = conn();
        $sql = "INSERT INTO `workflow` (`RoleId`, `RoleName`, `Comments`, `RecEntered`, `RecEnteredBy`,`DelFlg`)
            VALUES ('$RoleId', '$RoleName', '$Comments', NOW(), '$RecEnteredBy','N')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }
    
    function  getEquipment($RoleId){
         $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `RoleId`, `RoleName`, `Comments`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `DelFlg`"
                . " FROM `workflow` "
                . "WHERE RoleId = '$RoleId' "
                . "and DelFlg ='N';");
        $stmt->execute();
        $result = $stmt->fetchAll();
     
        return $result;
        
    }
    
    function  RemoveEquipment($RoleId){
       $conn = conn();
        $sql = "UPDATE `workflow` SET DelFlg='Y' WHERE RoleId='$RoleId'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
        
    }
            
     function UpdateEquipment($RoleId) {
        $conn = conn();
    
        $sql = "UPDATE `workflow` SET `RoleName`=" . $this->RoleName . ",`Comments`=" . $this->Comments .", `RecEntered`=" 
                . $this->RecEntered . ", `RecEnteredBy`=" . $this->RecEnteredBy
                . ", `RecModified`=" . $this->RecModified . ",`RecModifiedBy`=" . $this->RecModifiedBy 
                . " WHERE RoleId ='" . $RoleId . "'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    
}