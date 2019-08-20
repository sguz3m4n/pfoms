<?php

namespace PfomModel;

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler
  Property of Barbados Customs and Excise Department 2017
  Consultation and Analysis by Data Processing Department
  October 2017
 */

class Proforma {

    function __construct() {
        
    }

    public $TranId;
    public $TranType;
    public $BllFormNo;
    public $BillRefNo;
    public $TransNumber;
    public $PRN;
    public $RecEntered;
    public $OfficerId;
    public $OfficerName;
    public $Post;
    public $PayRate;
    public $RateCode;
    public $CompanyId;
    public $CompanyName;
    public $CompanyAddress;
    public $AgentName;
    public $ContactName;
    public $PhoneNumber;
    public $FaxNumber;
    public $Email;
    public $CurrentBalance;
    public $PreviousBalance;
    public $CompanyLocation;
    public $CompanyCoordinates;
    public $OfficerLocation;
    public $OfficerCoordinates;
    public $Distance;
    public $TravelAmount;
    public $OvertimeAmount;
    public $SubsistenceAmount;
    public $RefundAmount;
    public $HolidayAmount;
    public $OtherAmount;
    public $TotalAmount;
    public $Passengers;
    public $NumberPx;
    public $HoursWorked;
    public $Subsistence;
    public $CompanyBalance;
    public $InspectionDate;
    public $StartDate;
    public $EndDate;
    public $DateIssued;
    public $Comments;
    public $DatePayment;
    public $NISDeductions;
    public $PAYEDeductions;
    public $RecEnteredBy;
    public $auditok;

    function GetEventId($eventid) {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT prnmanage.PRNumber,prntran.RequestorID FROM `prnmanage` as prnmanage, prntransaction as prntran WHERE prnmanage.TranId=prntran.TranId and prnmanage.status='Active' and prntran.CompanyId='$compid';");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        $result = "<option id=' ' >" . " " . "</option>";
        foreach ($result_array as $value) {
            $PRNNo = $value['PRNumber'];
            $result .= "<option id='$PRNNo' >" . $value['PRNumber'] . "</option>";
        }
        return $result;
        $conn = NULL;
    }

    function GetListProforma($eventid) {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT * FROM `proforma` as pro,"
                . "`proformatransaction` as trans,"
                . "`event` as event WHERE "
                . "pro.EventId=+trans.EventId AND "
                . "event.EventId=+pro.EventId AND "
                . "pro.Eventid='" . $_REQUEST['eventid'] . "' AND pro.delflag='N';");

        $stmt->execute();
        $result_array = $stmt->fetchAll();
//        $result = "<option id=' ' >" . " " . "</option>";
//        foreach ($result_array as $value) {
//            $PRNNo = $value['PRNumber'];
//            $result .= "<option id='$PRNNo' >" . $value['PRNumber'] . "</option>";
//        }
        return $result_array;
        $conn = NULL;
    }

    function CreateUpdateProforma($EventId, $EventCost, $OppSupport, $PoliceServices, $VATPoliceServices, $RecEnteredBy) {

        $conn = conn();
        $sqlgetevent = $conn->prepare("SELECT * FROM proforma where `EventId` = '$EventId' and DelFlag ='N';");
        $sqlgetevent->execute();
        $result_array = $sqlgetevent->fetchAll();

        if (empty($result_array)) {
            $sql = "INSERT INTO `proforma` (`EventId`, `EventCost`, `OperationalSupport`, `PoliceServices`, `VATPoliceServices`,`Status`,`DelFlag`)
            VALUES ('$EventId', '$EventCost', '$OppSupport','$PoliceServices','$VATPoliceServices','Registered','N')";
        } else {
            $sql = "Update `proforma` SET `OperationalSupport` = `OperationalSupport` + '$OppSupport',"
                    . "`PoliceServices` = `PoliceServices` + '$PoliceServices',"
                    . " `VATPoliceServices` = `VATPoliceServices` + '$VATPoliceServices',"
                    . "  `EventCost` = `EventCost` + '$EventCost' WHERE `EventId` = '$EventId' ";
        }
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
    }

    function CreateProformaDetails($TransId, $AssetName, $Quantity, $Hours, $Value, $Rate) {

        $conn = conn();
        $sql = "INSERT INTO `proformadetails` (`TransId`, `AssetName`, `Quantity`, `Hours`,`Rate`, `Value`)
            VALUES ('$TransId', '$AssetName', '$Quantity','$Hours','$Rate','$Value')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
    }

    function CreateProformaTransaction($TransId, $EventId, $OppSupport, $PoliceServices, $VATPoliceServices, $RecEnteredBy) {

        $conn = conn();
        $sql = "INSERT INTO `proformatransaction`(`TransId`, `EventId`, `PoliceServicesVat`, `OppSupport`, `PoliceServices`, `TimeStamp`, `RecEnteredBy`) VALUES"
                . " ('$TransId','$EventId','$VATPoliceServices', '$OppSupport','$PoliceServices',NOW(),'$RecEnteredBy')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
    }

    function CalcutlateVat($policeservices, $vatrate) {
        $totalvat = $policeservices * $vatrate;
        $totalvat = number_format($totalvat, 2, '.', '');
        return $totalvat;
    }

    function CalculatePoliceServices($quantity, $hours, $rate) {
        $totalcost = $quantity * $hours * $rate;
        $totalcost = number_format($totalcost, 2, '.', '');
        return $totalcost;
    }

    function CalculateOpsupportFixed($quantity, $rate) {
        $totalcost = $quantity * $rate;
        $totalcost = number_format($totalcost, 2, '.', '');
        return $totalcost;
    }

    function CalculateOpsupportVariable($quantity, $hours, $rate) {
        $totalcost = $quantity * $hours * $rate;
        $totalcost = number_format($totalcost, 2, '.', '');
        return $totalcost;
    }

    function EventCost($policeservice, $opsupport, $vat) {
        $totalcost = $policeservice + $opsupport + $vat;
        $totalcost = number_format($totalcost, 2, '.', '');
        return $totalcost;
    }

}
