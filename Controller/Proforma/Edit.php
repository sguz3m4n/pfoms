<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler
  Property of Barbados Customs and Excise Department 2017
  Consultation and Analysis by Data Processing Department
  October 2017
 */

namespace Controllers;

//require 'Create.php';

class EditProformaController extends MakeProformaController {

    private $EventId = "";
    private $EventName = "";
    private $EventDate = "";
    private $EventCost = "";
    private $Comments = "";
    private $RecModifiedBy = "";
    private $OperationalSupport = "";
    private $PoliceServices = "";
    private $VATPoliceServices = "";

    function show($params) {
        $username = $_SESSION["login_user"];

        if (isset($_POST['update'])) {

            if (isset($_POST['btn-create'])) {

                $eventinst = new \PfomModel\Event();
                $audinst = new \PfomModel\Audit();
                $eventinst->EventCost = $EventCost = $_POST["hdnEventCost"];
                $eventinst->Comments = $Comments = $_POST["Comments"];
                $eventinst->EventId = $EventId = $_POST["EventId"];
                $eventinst->EventName = $EventName = $_POST["EventName"];
                $eventinst->RecEntered = $RecEntered = "";
                $eventinst->RecEnteredBy = $RecEnteredBy = $username;
                $eventinst->OperationalSupport = $OperationalSupport = $_POST["hdnOperationalSupport"];
                $eventinst->PoliceServices = $PoliceServices = $_POST["hdnPoliceServices"];
                $eventinst->VATPoliceServices = $VATPoliceServices = $_POST["hdnVATPoliceServices"];

                //all coming from Company/getuser 
                $eventinst->CompanyId = $CompanyId = $_POST["CompanyId"];
                $eventinst->CompanyName = $CompanyName = $_POST["CompanyName"];
                $eventinst->Assets = $Assets = json_decode($_POST['hdnAsset'], TRUE);


                foreach ($Assets as $Asset) {

                    $eventinst->AssetName = $AssetName = $Asset[2];
                    $eventinst->Value = $Value = $Asset[1];
                    $eventinst->Quantity = $Quantity = $Asset[3];
                    $eventinst->Hours = $Hours = $Asset[4];
                    if ($Hours == '0') {
                        $Hours = '1';
                    }

                    $eventinst->CreateEventPreAccount($EventId, $AssetName, $Quantity, $Hours, $Value, $CompanyName, $CompanyId);
                }

                $eventinst->CreateUpdateProforma($EventId, $EventCost, $OperationalSupport, $PoliceServices, $VATPoliceServices, $RecEnteredBy);
                //need to find out how to log them
                $TimeStamp = $audinst->GenerateTimestamp('TS');
                $TransId = $audinst->GenerateTimestamp('TID');

                $eventinst->CreateProformaTransaction($EventId, $OperationalSupport, $PoliceServices, $VATPoliceServices, $RecEnteredBy, $TimeStamp, $TransId);



// //if validation succeeds then log audit record to database
                if ($eventinst->auditok == 1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CEMP');
                    $TranDesc = 'Created new Event Name: ' . $EventName . ' Event ID: ' . $EventId;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $token = '<br><br><span class="label label-success">Event Name</span> ' . '<span class="label label-info"> ' . $EventName . '</span><br><br><br>' .
                            '<span class="label label-success">Event Id</span> ' . '<span class="label label-info">' . $EventId . '</span><br>';
                    $token1 = 'Record Successfully Created';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            } else {
                $template = new MasterTemplate();
                $template->load("Views/Payment/edit.html");
                $template->replace("title", "Create New Bill Payment");
                $template->replace("val_CompanyBalance", $_SESSION['$companybalwrapper']);
                $template->replace("val_Insufficient", $_SESSION['$insuffwrapper']);
                $template->publish();
            }
        } else

        if (isset($_GET)) {

            $template = new MasterTemplate();
            $template->load("Views/Proforma/proforma_edit.html");
            $model = new \PfomModel\Event();
            $rolerates = $model->GetRoleRates();
            $template->replace("RoleRates", $rolerates);
            $template->publish();
        }
    }

}

class ProformaTableController extends MakeProformaController {

    function show($params) {
        $roles = $_SESSION["user_roles"];
        $canUnlock = in_array($roles, array('Administrator', 'Manager', 'Super User')) ? true : false;
        $unlock = $canUnlock == 1 ? "<th>Unlock</th>" : "";
        $table = "";

//        $pymtinst = new \BarcomModel\Payment();
        $filterBy = array();

        if (isset($_REQUEST['eventid'])) {
            $eventid = $_REQUEST['eventid'];
            $proform = new \PfomModel\Proforma();
            $results = $proform->GetListProforma($eventid);

            if (empty($results)) {
                $table = "<tr>Error fetching results</tr>";
            } else {
                foreach ($results as $value) {
//                    if ($value["CloseDate"] != '') {
//                        $rowClass = 'class="active"';
//
//                        $buttonCode = "<td><button type='button' class='btn btn-info btn-sm edit' disabled id=" . $value["RN"] . ">Closed</button></td>";
//                        if ($canUnlock) {
//                            $unlockButton = "<td><button type='button' class='btn btn-info btn-sm unlock' id=" . $value["TransId"] . "><span class='glyphicon glyphicon-lock'></span></button></td>";
//                            $buttonCode = $buttonCode . $unlockButton;
//                        }
//                    } else {
                    $rowClass = "class='danger'";
                    $EditButton = "<td><button type='button' class='btn btn-info btn-sm edit' data-toggle='modal' id=" . $value["EventId"] . ">Edit</button></td>";
                    $OfficerAmend = "<td><button type='button' class='btn btn-info btn-sm amend' data-toggle='modal' data-target='#officermodal' id=" . $value["EventId"] . ">Amend</button></td>";
                    $SupportAmend = "<td><button type='button' class='btn btn-info btn-sm amend' data-toggle='modal' data-target='#supportmodal' id=" . $value["EventId"] . ">Amend</button></td>";
//                    }

                    $table = $table . "<tr" . $rowClass . "><td>" . $value["EventId"] . "</td><td>" . $value["EventName"] . "</td>"
                            . "<td>" . $value["EventCost"] . "</td><td>" . $value["ContactName"] . "</td><td>" . $value["ContactEmail"] . "</td><td>" . $value["ContactNumber"] . "</td>"
                            . "<td>" . $value["EventDateStart"] . "</td><td>" . $value["EventDateEnd"] . "</td>"
                            . $EditButton .
                            $OfficerAmend .
                            $SupportAmend .
                            "</tr>";
                }
            }
            $template = new BaseTemplate();
            $template->load("Views/Proforma/table.html");
//            $template->replace("unlock", $unlock);
            $template->replace("table", $table);
            $template->publish();
        }
    }

}

?>