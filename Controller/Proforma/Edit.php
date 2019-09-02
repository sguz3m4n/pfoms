<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

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
            $id = $_REQUEST['id'];

            $eventinst = new \PfomModel\Event();
            $audinst = new \PfomModel\Audit();
            $profinst = new \PfomModel\Proforma();
            $eventinst->Value = $Value = $_POST['value'];
            $eventinst->AssetName = $AssetName = $_POST['assetname'];
            $eventinst->Rate = $Rate = $_POST['rate'];
            $eventinst->Quantity = $Quantity = $_POST['quantity'];
            isset($_POST['hours']) ? $eventinst->Hours = $Hours = $_POST['hours'] : $eventinst->Hours = $Hours = 0;
            $eventinst->EventId = $EventId = $_POST['eventid'];
            $PoliceServices = $_POST['polserv'];
            $OperationalSupport = $_POST['opssupp'];
            $VatPolServices = $_POST['vatpolserv'];
            $CurrentCost = $_POST['eventcost'];
            $EventCost = 0;
            $Type = $_POST['type'];
            $Vat = $eventinst->GetVat();
            if ($Hours == 0) {
                $FixOppsupp = $profinst->CalculateOpsupportFixed($Quantity, $Rate);
                $FixOppsupp >= $Value ? $CostAdjust = (abs($Value - $FixOppsupp)) * -1 : $CostAdjust = $FixOppsupp ;
                $OperationalSupport = $FixOppsupp;
                $profinst->UpdateProformaDetails($id, $Quantity, $Hours, $OperationalSupport, $Rate, $Type);
//                $EventCost = $profinst->EventCost($PoliceServices, $OperationalSupport, $VatPolServices);
                $EventCost = $CurrentCost + $CostAdjust;
                $profinst->UpdateProforma($EventId, $EventCost, $OperationalSupport, $PoliceServices, $VatPolServices, $username);
            } else {
                if ($Type == 'PLCSRV') {
                    $PolServ = $profinst->CalculatePoliceServices($Quantity, $Hours, $Rate);
                    $PolServ >= $Value ? $CostAdjust = (abs($Value - $PolServ)) * -1 : $CostAdjust = $PolServ ;
                    $PoliceServices = $PolServ;
                    $profinst->UpdateProformaDetails($id, $Quantity, $Hours, $PoliceServices, $Rate, $Type);
                    $VATPoliceServices = $profinst->CalcutlateVat($PoliceServices, $Vat);
//                    $EventCost = $profinst->EventCost($PoliceServices, $OperationalSupport, $VatPolServices);
                    $EventCost = $CurrentCost + $CostAdjust;
                    $profinst->UpdateProforma($EventId, $EventCost, $OperationalSupport, $PoliceServices, $VATPoliceServices, $username);
                } else
                if ($Type == 'OPPSPP') {
                    $Oppsupp = $profinst->CalculateOpsupportVariable($Quantity, $Hours, $Rate);
                    $Oppsupp >= $Value ? $CostAdjust = (abs($Value - $Oppsupp)) * -1 : $CostAdjust = $Oppsupp ;
                    $OperationalSupport = $Oppsupp;
                    $profinst->UpdateProformaDetails($id, $Quantity, $Hours, $OperationalSupport, $Rate, $Type);
//                    $EventCost = $profinst->EventCost($PoliceServices, $OperationalSupport, $VatPolServices);
                    $EventCost = $CurrentCost + $CostAdjust;
                    $profinst->UpdateProforma($EventId, $EventCost, $OperationalSupport, $PoliceServices, $VatPolServices, $username);
                }
            }



//            $profinst->UpdateProforma($Cost, $OppSupport, $PoliceServices, $VATPoliceServices, $user)
//                $eventinst->CreateUpdateProforma($EventId, $EventCost, $OperationalSupport, $PoliceServices, $VATPoliceServices, $RecEnteredBy);
//                //need to find out how to log them
//                $TimeStamp = $audinst->GenerateTimestamp('TS');
//                $TransId = $audinst->GenerateTimestamp('TID');

            if ($profinst->auditok == 1) {
                $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CEMP');
                $TranDesc = 'Edit proforma detail: ' . $id . ' Event ID: ' . $EventId;
                $User = $username;
                $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                $token = '<br><br><span class="label label-success">Event Name</span> ' . '<span class="label label-info"> ' . $id . '</span><br><br><br>' .
                        '<span class="label label-success">Proforma Id</span> ' . '<span class="label label-info">' . $EventId . '</span><br>';
                $token1 = 'Record Successfully Created';
                header("Location:" . "/success?result=$token&header=$token1&args=");
            } else {
                $template = new MasterTemplate();
                $template->load("Views/Proforma/proforma_edit.html");
                $model = new \PfomModel\Event();
                $rolerates = $model->GetRoleRates();
                $template->replace("RoleRates", $rolerates);
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
//        $unlock = $canUnlock == 1 ? "<th>Unlock</th>" : "";
        $table = "";

//        $pymtinst = new \PfomModel\Payment();
//        $filterBy = array();

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