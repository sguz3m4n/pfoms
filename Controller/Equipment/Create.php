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

    public $ItemName = "";
    public $Category = "";
    public $UnitCost = "";
    public $UnitMeasurement = "";
    
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
            $equipinst = new \BarcomModel\Equipment();
            $audinst = new \BarcomModel\Audit();
            $this->EquipmentId = $compid = $equipinst->EquipmentId = $_POST['EquipmentId'];

            $this->ItemName = $equipinst->ItemName = $_POST['ItemName'];
            $this->Category = $equipinst->Category = $_POST['Category'];
            $this->UnitCost = $equipinst->UnitCost = $_POST['UnitCost'];
            $this->UnitMeasurement = $equipinst->UnitMeasurement = $_POST['UnitMeasurement'];
           
            $this->RecEntered = $equipinst->RecEntered = $_POST['RecEntered'];
            $this->RecEnteredBy = $equipinst->RecEnteredBy = $_POST['RecEnteredBy'];
            $this->RecModified = $equipinst->RecModified = $_POST['RecModified'];
            $this->RecModifiedBy = $equipinst->RecModifiedBy = $_POST['RecModifiedBy'];
            
            $equipinst->DelFlg = 'N';

//Send elements to be validated
            //$validateme = ["EquipmentId"];
            //$this->ValidationEngine($validateme);

//if validation succeeds then commit info to database
            if (1) {
//                if ($equipinst->IfExists($equipinst->EquipmentId) === 0) {
//                    $equipinst->CreateEquipment($username);
//                }

//if validation succeeds then log audit record to database
                if (1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                    $TranDesc = 'Create New Equipment for ' . $EquipmentId . " Name " . $ItemName;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $equipinst->CreateEquipment($EquipmentId, $ItemName, $Category,$UnitCost, $UnitMeasurement,$RecEntered, $RecEnteredBy,$DelFlg);
                    $token = '<br><br><span class="label label-success">Equipment Name</span> ' . '<span class="label label-info"> ' . $ItemName . '</span><br><br><br>' .
                            '<span class="label label-success">Equipment Id</span> ' . '<span class="label label-info">' . $EquipmentId . '</span><br>';
                    $token1 = 'Record Successfully Created';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                    
                }
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
