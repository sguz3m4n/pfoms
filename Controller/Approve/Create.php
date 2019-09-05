<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Approve.php';
require 'Classes/Audit.php';
require 'Controller/base_template.php';

class ApproveCreateController extends PermissionController {

    private $approvals;

    function show($params) {
        $username = $_SESSION["login_user"];

        if (isset($_POST['btnCreateApproval'])) {
            $approveinst = new \PfomModel\Approve();
 $audinst = new \PfomModel\Audit();
            $this->approvals = $approvalrecs = json_decode($_POST['approvalarr'], TRUE);
            foreach ($approvalrecs as $value) {
                $EventId = $value;
                $approveinst->ApproveIt($EventId);
            }
            if ($approveinst->auditok == 1) {
                $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                $TranDesc = 'Create Approval for ';
                $User = $username;
                $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                $token = '<br><br><span class="label label-success">Company Name</span> ' . '<span class="label label-info"> COmpany here</span><br><br><br>' .
                        '<span class="label label-success">Company Id</span> ' . '<span class="label label-info">ID here</span><br>';
                $token1 = 'Record Successfully Approved';
                header("Location:" . "/success?result=$token&header=$token1&args=");
            }
        } else
        if (isset($_GET)) {
            $model = new \PfomModel\Approve();

            $template = new MasterTemplate();
            $template->load("Views/Approve/approve.html");

            $template->replace("title", " Create New Account ");
            $template->publish();
        }
    }

}

?>