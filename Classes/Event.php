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
    public $CompanyId;
    public $CompanyName;
    public $ContactName;
    public $ContactNumber;
    public $ContactEmail;
    public $EventDate;
    public $Comments;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $Status;
    public $DelFlg;
            

  
    function CreateEvent($EventId, $EventName, $CompanyId, $CompanyName, $ContactName, $ContactNumber, $ContactEmail, $EventDate, $Comments, $RecEntered, $RecEnteredBy,$DelFlg) {

        $conn = conn();
        $sql = "INSERT INTO `event` (`EventId`, `EventName`, `CompanyId`, `CompanyName`, `ContactName`, 
    `ContactEmail`,`ContactNumber`, `EventDate`, `Comments`, `RecEntered`, `RecEnteredBy`, `Status`, `DelFlg`)
            VALUES ('$EventId', '$EventName', '$CompanyId', '$CompanyName', '$ContactName',"
                . "'$ContactEmail','$ContactNumber', '$EventDate', '$Comments', NOW(), '$RecEnteredBy','Active','N')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        
    }
    
    function  getEvent($EventId){
         $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT `EventId`, `EventName`, `CompanyId`, `CompanyName`, `ContactName`, `ContactEmail`, `ContactNumber`, "
                . "`EventDate`, `Comments`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `Status`,"
                . " `DelFlg` FROM `event` WHERE EventId = '$EventId' and DelFlg ='N';");
        $stmt->execute();
       $result = $stmt->fetchAll();
     
        return $result;
        
        
    }
    
    function  RemoveEvent($EventId){
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
    
        $sql = "UPDATE `event` SET `EventName`=" . $this->EventName . ",`ContactName`="
                . $this->ContactName . ",`ContactEmail`=" . $this->ContactEmail . ", `ContactNumber`='"
                . $this->ContactNumber . "', `EventDate`=" . $this->EventDate
                . ", `Comments`='" . $this->Comments . "',`RecEntered`="
                . $this->RecEntered . ", `RecEnteredBy`=" . $this->RecEnteredBy
                . ", `RecModified`=" . $this->RecModified . ",`RecModifiedBy`=" . $this->RecModifiedBy 
                . " WHERE EventId ='" . $EventId . "'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
       
    }

    
}