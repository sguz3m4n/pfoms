<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Audit.php';
require 'Controller/base_template.php';
require 'Classes/Employee.php';

class EmployeeDeactivateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    function show($params) {

        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-delete'])) {
            $empinst = new \BarcomModel\Employee();
            $audinst = new \BarcomModel\Audit();
            $EmpId = $_POST['Natid'];
            //Check to see if the record already exists            
            //If it does execute delete
            if ($empinst->IfExists($EmpId) === 1) {
                //Get Id from browser interface
                $varid = $EmpId;
                $EmpName = $_POST['Name'];
                $empinst->RecModifiedBy = $username;

                $empinst->DeleteEmployee($EmpId);
                if ($empinst->auditok == 1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('DCMP');
                    $TranDesc = 'Delete Employee ' . $varid . " Name " . $EmpName;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $token = '<br><br><span class="label label-success">Company Name</span> ' . '<span class="label label-info"> ' . $EmpName . '</span><br><br><br>' .
                            '<span class="label label-success">Company Id</span> ' . '<span class="label label-info">' . $varid . '</span><br>';
                    $token1 = 'Record Successfully Deleted';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            }
        }
    }

}
