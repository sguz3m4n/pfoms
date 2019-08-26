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


//class DutySheetTableController extends MakePaymentController {
//
//    function show($params) {
//        $roles = $_SESSION["user_roles"];
//        $canUnlock = in_array($roles, array('Administrator', 'Manager', 'Super User')) ? true : false;
//        $unlock = $canUnlock == 1 ? "<th>Unlock</th>" : "";
//        $table = "";
//
//        $pymtinst = new \PfomModel\Payment();
//        $filterBy = array();
//
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
//
//        $filterBy['status'] = " AND A.Status='Active'";
//        $results = $pymtinst->GetFilteredPayments($filterBy);
//
//        if (empty($results)) {
//            $table = "<tr>Error fetching results</tr>";
//        } else {
//            foreach ($results as $value) {
//                if ($value["CloseDate"] != '') {
//                    $rowClass = 'class="active"';
//
//                    $buttonCode = "<td><button type='button' class='btn btn-info btn-sm edit' disabled id=" . $value["RN"] . ">Closed</button></td>";
//                    if ($canUnlock) {
//                        $unlockButton = "<td><button type='button' class='btn btn-info btn-sm unlock' id=" . $value["TransId"] . "><span class='glyphicon glyphicon-lock'></span></button></td>";
//                        $buttonCode = $buttonCode . $unlockButton;
//                    }
//                } else {
//                    $rowClass = "class='danger'";
//                    $buttonCode = "<td><button type='button' class='btn btn-info btn-sm edit' data-toggle='modal' id=" . $value["TransId"] . ">Edit</button></td>";
//                    $AmendButton = "<td><button type='button' class='btn btn-info btn-sm amend' data-toggle='modal' id=" . $value["BillRefNo"] . ">Amend</button></td>";
//                    $AmendButton = "<td><button type='button' class='btn btn-info btn-sm amend'  id=" . $value["BillRefNo"] . ">Amend</button></td>";
//                }
//
//                $table = $table . "<tr" . $rowClass . "><td>" . $value["BillRefNo"] . "</td><td>" . $value["RN"] . "</td>"
//                        . "<td>" . $value["CompanyName"] . "</td><td>" . $value["FirstName"] . " " . $value["LastName"] . " " . $value["Natregno"] . "</td>"
//                        . "<td>" . $value["HoursWorked"] . "</td><td>" . $value["TotalPaymentAmount"] . "</td>"
//                        . $buttonCode . $AmendButton . "</tr>";
//            }
//        }
//        $template = new BaseTemplate();
//        $template->load("Views/Payment/table.html");
//        $template->replace("unlock", $unlock);
//        $template->replace("table", $table);
//        $template->publish();
//    }
//
//}


?>
