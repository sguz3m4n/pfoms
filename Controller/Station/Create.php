<?php
/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Station.php';
require 'Classes/Audit.php';
require 'Controller/base_template.php';


class StationCreateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $EquipmentId = "";
    private $ItemName = "";
    private $Category = "";
    private $UnitCost = "";
    private $UnitMeasurement = "";
    private $RecEntered = "";
    private $RecEnteredBy = "";
    private $RecModified = "";
    private $RecModifiedBy = "";
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
            $compinst = new \BarcomModel\Station();
            $audinst = new \BarcomModel\Audit();
            $this->EquipmentId = $compid = $compinst->EquipmentId = $_POST['EquipmentId'];
            $this->ItemName = $compinst->ItemName = $_POST['ItemName'];
            $this->Category = $compinst->Category = $_POST['Category'];
            $this->UnitCost = $compinst->UnitCost = $_POST['UnitCost'];
            $this->UnitMeasurement = $compinst->UnitMeasurement = $_POST['UnitMeasurement'];
            
            $compinst->DelFlg = 'N';

//Send elements to be validated
//            $validateme = ["EquipmentId"];
//            $this->ValidationEngine($validateme);

//if validation succeeds then commit info to database
            if ($this->EquipmentIdIsValid) {
//                if ($compinst->IfExists($compinst->EquipmentId) === 0) {
//                    $compinst->CreateStation($username);
//                }

//if validation succeeds then log audit record to database
                if ($compinst->auditok == 1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                    $TranDesc = 'Create New Station for ' . $compid . " Name " . $compname;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $token = '<br><br><span class="label label-success">Station Name</span> ' . '<span class="label label-info"> ' . $compname . '</span><br><br><br>' .
                            '<span class="label label-success">Station Id</span> ' . '<span class="label label-info">' . $compid . '</span><br>';
                    $token1 = 'Record Successfully Created';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            } else {
                //if validation fails do postback with values already entered
                $model = new \BarcomModel\Station();
                $parishes = $model->GetParishes();
                $template = new MasterTemplate();
                $template->load("Views/Station/station.html");
                $template->replace("EquipmentId", $this->EquipmentId);
                $template->replace("ItemName", $this->ItemName);
                $template->replace("Category", $this->Category);
                $template->replace("UnitCost", $this->UnitCost);
                $template->replace("UnitMeasurement", $this->UnitMeasurement);

                $template->publish();
            }
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Station();
            
            $template = new MasterTemplate();
            $template->load("Views/Station/station.html");
            $template->replace("EquipmentId", "");
            $template->replace("ItemName", "");
            $template->replace("Category", "");
            $template->replace("UnitCost", "");
            $template->replace("UnitMeasurement", "");
            
            $template->replace("title", " Create New Station ");
            $template->publish();
        }
    }

}

?>
