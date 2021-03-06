<?php
/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Equipment.php';
require 'Classes/Audit.php';
require 'Controller/base_template.php';

class EquipmentDeactivateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    function show($params) {

        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-delete'])) {
            $compinst = new \PfomModel\Equipment();
            $audinst = new \PfomModel\Audit();

            $TIN= $_POST['EquipmentId'];
            //Check to see if the record already exists            
            //If it does execute delete
            if ($compinst->IfExists($TIN) === 1) {
                //Get Id from browser interface
                $varid = $TIN;
                $compname = $_POST['EquipmentId'];
                $compinst->RecModifiedBy = $username;

                $compinst->RemoveEquipment($compname);
                if ($compinst->auditok == 1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('DCMP');
                    $TranDesc = 'Delete Company for ' . $varid . " Name " . $compname;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $token = '<br><br><span class="label label-success">Company Name</span> ' . '<span class="label label-info"> ' . $compname . '</span><br><br><br>' .
                            '<span class="label label-success">Company Id</span> ' . '<span class="label label-info">' . $varid . '</span><br>';
                    $token1 = 'Record Successfully Deleted';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            }
        }
    }

}
