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

class EquipmentCreateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $EquipmentId = "";
    private $ItemName = "";
    private $Category = "";
    private $UnitCost = "";
    private $UnitMeasurement = "";
    private $DelFlg = "";

//Validation Engine will execute any validation on the fields in the interface
    function ValidationEngine($elements) {
        foreach ($elements as $value) {
            
        }
    }

//Validation Engine will execute any validation on the fields in the interface
//Render page contents depeding on http method call
//If there is a GET call just render the page contens
//If there is a POST call and data entered passes validation then submit to database
//else POSTBACK data with validations errors
    function show($params) {
        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-create'])) {
//variables for data input 
            $conn = conn();
            $equipinst = new \BarcomModel\Equipment();
            $audinst = new \BarcomModel\Audit();
            $this->EquipmentId = $EquipmentId = $_POST['EquipmentId'];
            $this->ItemName = $ItemName = $_POST['ItemName'];
            $this->Category = $Category = $_POST['Category'];
            $this->UnitCost = $UnitCost = $_POST['UnitCost'];
            $UnitCost = number_format($UnitCost, 2, '.', '');
            $this->UnitMeasurement = $UnitMeasurement = $_POST['UnitMeasurement'];

            $equipinst->DelFlg = 'N';
//if validation succeeds then commit info to database
//put validation if statement here
            if ($equipinst->IfExists($equipinst->EquipmentId) === 0) {
                $equipinst->CreateEquipment($EquipmentId, $ItemName, $Category, $UnitCost, $UnitMeasurement, $username);


//if validation succeeds then log audit record to database
                //check to see it autdit ok
                $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                $TranDesc = 'Create New Equipment for ' . $EquipmentId . " Name " . $ItemName;
                $User = $username;
                $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);

                $token = '<br><br><span class="label label-success">Equipment Name</span> ' . '<span class="label label-info"> ' . $ItemName . '</span><br><br><br>' .
                        '<span class="label label-success">Equipment Id</span> ' . '<span class="label label-info">' . $EquipmentId . '</span><br>';
                $token1 = 'Record Successfully Created';
                header("Location:" . "/success?result=$token&header=$token1&args=");
            } else {
                //if validation fails do postback with values already entered
                $model = new \BarcomModel\Equipment();
                $template = new MasterTemplate();
                $template->load("Views/Equipment/equipment.html");
                $template->replace("EquipmentId", $this->EquipmentId);

                $template->publish();
            }
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Equipment();

            $template = new MasterTemplate();
            $template->load("Views/Equipment/equipment.html");
            $template->replace("EquipmentId", "");
            $template->replace("ItemName", "");
            $template->replace("Category", "");
            $template->replace("UnitCost", "");
            $template->replace("UnitMeasurement", "");
            $template->replace("RecEntered", "");
            $template->replace("RecEnteredBy", "");
            $template->replace("RecModified", "");
            $template->replace("RecModifiedBy", "");
            $template->replace("title", " Create New Equipment ");
            $template->publish();
        }
    }

}

?>
