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

    function show($params) {
        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-approve'])) {
            $approveinst= new \BarcomModel\Approve();
            
            $EventId = $_POST['EventId'];
            $approveinst->ApproveIt($EventId);
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Approve();

            $template = new MasterTemplate();
            $template->load("Views/Approve/approve.html");

            $template->replace("title", " Create New Account ");
            $template->publish();
        }
    }

}

?>