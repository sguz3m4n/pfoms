<?php
/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Config.php';
require 'Classes/Audit.php';
require 'Controller/base_template.php';

class ConfigDeactivateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    function show($params) {

        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-delete'])) {
            $compinst = new \PfomModel\Config();
            $audinst = new \PfomModel\Audit();
            $ItemCode = $_POST['ItemCode'];
            //Check to see if the record already exists            
            //If it does execute delete
            if ($compinst->IfExists($ItemCode) === 1) {
                //Get Id from browser interface
                $varid = $_POST['ItemName'];
                
                $compinst->RecModifiedBy = $username;

                $compinst->RemoveConfig($ItemCode);
                if ($compinst->auditok == 1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('DCMP');
                    $TranDesc = 'Delete Company for ' . $varid . " Name " . $ItemCode;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $token = '<br><br><span class="label label-success">Acount Id</span> ' . '<span class="label label-info"> ' . $ItemCode . '</span><br><br><br>' .
                            '<span class="label label-success">Account Name</span> ' . '<span class="label label-info">' . $varid . '</span><br>';
                    $token1 = 'Record Successfully Deleted';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            }
        }
    }

}
