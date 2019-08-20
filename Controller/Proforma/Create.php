<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Company.php';
require 'Classes/Equipment.php';
require 'Classes/Audit.php';
require 'Classes/PreAccount.php';
require 'Classes/Division.php';
require 'Classes/Event.php';
require 'Classes/Proforma.php';
require 'Controller/base_template.php';

class MakeProformaController extends PermissionController {

    function __construct() {
        $this->setRoles(['Human Resource Clerk', 'Manager', 'Administrator', 'Super User']);
    }

    private $EventId = "";
    private $CompanyId = "";
    private $CompanyName = "";
    private $Comments = "";
    private $RecEntered = "";
    private $RecEnteredBy = "";
    private $OperationalSupport = "";
    private $PoliceServices = "";
    private $VATPoliceServices;
    private $Assets = "";
    private $AssetName = "";
    private $Quantity = "";
    private $Value = "";
    private $Hours = "";
    private $assetsbreakdown;
    private $arrbreakdown;

//private $MyPaymentsRecords;

    function show($params) {
        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-create'])) {

            $eventinst = new \PfomModel\Event();
            $profinst = new \PfomModel\Proforma();
            $audinst = new \PfomModel\Audit();

            $eventinst->EventDateStart = $EventDateStart = $_POST["EventDateStart"];
            $eventinst->EventDateEnd = $EventDateEnd = $_POST["EventDateEnd"];
            $eventinst->EventCost = $EventCost = $_POST["hdnEventCost"];
            $eventinst->Comments = $Comments = $_POST["Comments"];
            $eventinst->EventId = $EventId = $_POST["EventId"];
            $eventinst->EventName = $EventName = $_POST["EventName"];
            $eventinst->Division = $Division = $_POST["Division"];
            $eventinst->Station = $Station = $_POST["Station"];
            //$eventinst->DelFlg = $DelFlg = "N";
            $eventinst->RecEntered = $RecEntered = "";
            $eventinst->RecEnteredBy = $RecEnteredBy = $username;
            $PoliceServices = 0;
            $VATPoliceServices = 0;
            $OperationalSupport = 0;
//            $eventinst->PoliceServices = $PoliceServices = $_POST["hdnPoliceServices"];
//            $eventinst->VATPoliceServices = $VATPoliceServices = $_POST["hdnVATPoliceServices"];
//            $eventinst->OperationalSupport = $OperationalSupport = $_POST["hdnOperationalSupport"];

            $eventinst->CompanyId = $CompanyId = $_POST["CompanyId"];
            $eventinst->CompanyName = $CompanyName = $_POST["CompanyName"];
            $eventinst->Assets = $Assets = json_decode($_POST['hdnAsset'], TRUE);
            $ContactEmail = '';
            $ContactName = '';
            $ContactNumber = '';

//            $eventinst->CreatedteEvent($EventId, $EventName, $CompanyId, $CompanyName, $ContactName, $ContactNumber, $ContactEmail, $EventDateStart, $EventDateEnd, $Comments, $RecEnteredBy, $Division, $Station);
            $TransId = $audinst->GenerateTimestamp('TID');
            foreach ($Assets as $Asset) {

                $eventinst->Value = $Value = $Asset[1];
                $eventinst->AssetName = $AssetName = $Asset[2];
                $eventinst->Rate = $Rate = $Asset[3];
                $eventinst->Quantity = $Quantity = $Asset[4];
                $eventinst->Hours = $Hours = $Asset[5];
                $Type = $Asset[6];
                $profinst->CreateProformaDetails($TransId, $AssetName, $Quantity, $Hours, $Value, $Rate);
                $Oppsupp;
                $FixOppsupp;
                $PolServ;
                $ValueAddTax;
                if ($Hours == '') {
                    $FixOppsupp = $profinst->CalculateOpsupportFixed($Quantity, $Rate);
                    $OperationalSupport = $OperationalSupport + $FixOppsupp;
                } else {
                    if ($Type == 'PolServ') {
                        $PolServ = $profinst->CalculatePoliceServices($Quantity, $Hours, $Rate);
                        $PoliceServices = $PoliceServices + $PolServ;
                    } else
                    if ($Type == 'OppSupp') {
                        $Oppsupp = $profinst->CalculateOpsupportVariable($Quantity, $Hours, $Rate);
                        $OperationalSupport = $OperationalSupport + $Oppsupp;
                    }
                }
            }
            $VATPoliceServices = $profinst->CalcutlateVat($PoliceServices, 0.1750);
            $profinst->CreateProformaTransaction($TransId, $EventId, $OperationalSupport, $PoliceServices, $VATPoliceServices, $RecEnteredBy);
            $EventCost = $OperationalSupport + $PoliceServices + $VATPoliceServices;
            $profinst->CreateUpdateProforma($EventId, $EventCost, $OperationalSupport, $PoliceServices, $VATPoliceServices, $RecEnteredBy);
// //if validation succeeds then log audit record to database
            if ($profinst->auditok == 1) {
                $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CEMP');
                $TranDesc = 'Created new Event Name: ' . $EventName . ' Event ID: ' . $EventId;
                $User = $username;
                $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                $token = '<br><br><span class="label label-success">Event Name</span> ' . '<span class="label label-info"> ' . $EventName . '</span><br><br><br>' .
                        '<span class="label label-success">Event Id</span> ' . '<span class="label label-info">' . $EventId . '</span><br>';
                $token1 = 'Record Successfully Created';
                header("Location:" . "/success?result=$token&header=$token1&args=");
            }
        } else
        if (isset($_GET)) {
            $model = new \PfomModel\Event();
            $divmodel = new \PfomModel\Division ();
            $equipmodel = new \PfomModel\Equipment ();
            $divisions = $divmodel->GetDivisions();
            $rolerates = $model->GetRoleRates();
            $equipment = $equipmodel->GetEquipmentItems();
            $stations = $model->GetListOfStations();
            $VAT = $model->getVat();
//put prefix from division drop down id here
            //$EventId = $model->GenerateTimestamp('BDIV');
            $template = new MasterTemplate();
            $template->load("Views/Proforma/proforma.html");
            $template->replace("VATDBval", $VAT);
            $template->replace("Divisions", $divisions);
            $template->replace("RoleRates", $rolerates);
            $template->replace("Equipment", $equipment);
            //$template->replace("Stations", $stations);
            $template->publish();
        }
    }

}
?>



