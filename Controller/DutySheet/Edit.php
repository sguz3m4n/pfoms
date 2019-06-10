<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;


require 'Classes/Event.php';
require 'Classes/Company.php';
require 'Classes/Audit.php';
require 'Classes/DutySheet.php';
//require 'Classes/PreAccount.php';
require 'Controller/base_template.php';

static $eventnameerr = "";
static $eventnamewrapper = "";

class EditDutySheetController extends PermissionController {

function __construct() {
$this->setRoles(['Manager', 'Administrator', 'Super User']);
}

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


if (isset($_POST['btn-update'])) {
$eventinst = new \BarcomModel\Event();
$audinst = new \BarcomModel\Audit();

//Get Id from browser interface
$eventinst->EventId = $EventId = $_POST["EventId"];

//Check to see if the record already exists            
//If it does execute update
//if ($eventinst->IfExists($EventId) === 1) {

$eventinst->EventName = $EventName = $_POST["EventName"];
$eventinst->EventDate = $EventDate = $_POST["EventDate"];
$eventinst->EventCost = $EventCost = $_POST["EventCost"];
$eventinst->Comments = $Comments = $_POST["Comments"];
//$eventinst->EventId = $EventId = $_POST["EventId"];
//$eventinst->DelFlg = $DelFlg = "N";
//$eventinst->RecEntered = $RecEntered = "";
$eventinst->RecModifiedBy = $RecModifiedBy = $username;
$eventinst->OperationalSupport = $OperationalSupport = $_POST["OperationalSupport"];
$eventinst->PoliceServices = $PoliceServices = $_POST["PoliceServices"];
$eventinst->VATPoliceServices = $VATPoliceServices = $_POST["VATPoliceServices"];


$eventinst->UpdateEvent($EventId);
//if validation succeeds then commit info to database
if ($eventinst->auditok == 1) {
$tranid = $audinst->TranId = $audinst->GenerateTimestamp('CEMP');
$TranDesc = 'Update complete for Event Name: ' . $EventName . ' Event ID: ' . $EventId;
$User = $username;
$audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
$token = '<br><br><span class="label label-success">Event Name</span> ' . '<span class="label label-info"> ' . $EventName . '</span><br><br><br>' .
'<span class="label label-success">Event Id</span> ' . '<span class="label label-info">' . $EventId . '</span><br>';
$token1 = 'Record Successfully Updated';
header("Location:" . "/success?result=$token&header=$token1&args=");
}
}
else
if (isset($_GET)) {
$model = new \BarcomModel\Company();
//$parishes = $model->GetParishes();
$template = new MasterTemplate();
$template->load("Views/DutySHeet/dutysheet_edit.html");
//            $template->replace("parishes", $parishes);
//          $template->replace("title", " Create New Company ");
$template->replace("val_CompanyName", "");
$template->publish();
}
}

}


//class DutySheetTableController {

//     function __construct() {
//        $this->setRoles(['Administrator', 'Manager', 'Super User']);
//    }
//    
//    function show($params) {
////GetSelectedDutySheet 
//$dutysheetinst = new \BarcomModel\DutySheet();
//
//
//$EventId = $_REQUEST['GEventId'];
//
//$results = $dutysheetinst->GetSelectedDutySheet($EventId);
//if (empty($results)) {
//$table = "<tr>Error fetching results</tr>";
//} else {
//foreach ($results as $value) {
//if ($value["CloseDate"] != '') {
//$rowClass = 'class="active"';
//
//$buttonCode = "<td><button type='button' class='btn btn-info btn-sm edit' disabled id=" . $value["RN"] . ">Closed</button></td>";
//if ($canUnlock) {
//$unlockButton = "<td><button type='button' class='btn btn-info btn-sm unlock' id=" . $value["TransId"] . "><span class='glyphicon glyphicon-lock'></span></button></td>";
//$buttonCode = $buttonCode . $unlockButton;
//}
//} else {
//$rowClass = "class='danger'";
//$buttonCode = "<td><button type='button' class='btn btn-info btn-sm edit' data-toggle='modal' id=" . $value["TransId"] . ">Edit</button></td>";
//$AmendButton = "<td><button type='button' class='btn btn-info btn-sm amend' data-toggle='modal' id=" . $value["BillRefNo"] . ">Amend</button></td>";
//$AmendButton = "<td><button type='button' class='btn btn-info btn-sm amend'  id=" . $value["BillRefNo"] . ">Amend</button></td>";
//}
//
//$table = $table . "<tr" . $rowClass . "><td>" . $value["BillRefNo"] . "</td><td>" . $value["RN"] . "</td>"
//. "<td>" . $value["CompanyName"] . "</td><td>" . $value["FirstName"] . " " . $value["LastName"] . " " . $value["Natregno"] . "</td>"
//. "<td>" . $value["HoursWorked"] . "</td><td>" . $value["TotalPaymentAmount"] . "</td>"
//. $buttonCode . $AmendButton . "</tr>";
//}
//}
//$template = new BaseTemplate();
//$template->load("Views/Payment/table.html");
//$template->replace("unlock", $unlock);
//$template->replace("table", $table);
//$template->publish();
//
//}
//}
//    function show($params) {
//        $roles = $_SESSION["user_roles"];
//        $canUnlock = in_array($roles, array('Administrator', 'Manager', 'Super User')) ? true : false;
//        $unlock = $canUnlock == 1 ? "<th>Unlock</th>" : "";
//        $table = "";
//
//        $pymtinst = new \BarcomModel\DutySheet();
//        $filterBy = array();
//        if (isset($_REQUEST['compname'])) {
//            $filterBy['companyName'] = "B.CompanyName='" . $_REQUEST['compname'] . "'";
//        }
//
//        if (isset($_REQUEST['empid'])) {
//            $filterBy['employeeName'] = "concat_ws(' ',C.FirstName,C.LastName)  LIKE '" . $_REQUEST['empid'] . "'";
//        }
//
//        if (isset($_REQUEST['enddate'])) {
//            $filterBy['endDate'] = "DATE(A.EndDate) <='" . $_REQUEST['enddate'] . "'";
//        }
//
//        if (isset($_REQUEST['startdate'])) {
//            $filterBy['startDate'] = "DATE(A.StartDate) >='" . $_REQUEST['startdate'] . "'";
//        }
//        $filterBy['status'] = " AND A.Status='Active'";
//    }
//}

?>
