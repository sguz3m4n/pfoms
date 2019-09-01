<?php
/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Workflow.php';
require 'Classes/Audit.php';
require 'Controller/base_template.php';


class WorkflowCreateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $WorkflowId = "";

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
            $compinst = new \PfomModel\Workflow();
            $audinst = new \PfomModel\Audit();
            $this->WorkflowId = $compid = $compinst->WorkflowId = $_POST['WorkflowId'];

            $this->Name = $compname = $compinst->Name = $_POST['Name'];
            $this->ItemName = $compinst->ItemName = $_POST['ItemName'];
            $this->Category = $compinst->Category = $_POST['Category'];
            $this->UnitCost = $compinst->UnitCost = $_POST['UnitCost'];
            $this->UnitMeasurement = $compinst->UnitMeasurement = $_POST['UnitMeasurement'];
           
            $this->RecEntered = $compinst->RecEntered = $_POST['RecEntered'];
            $this->RecEnteredBy = $compinst->RecEnteredBy = $_POST['RecEnteredBy'];
            $this->RecModified = $compinst->RecModified = $_POST['RecModified'];
            $this->RecModifiedBy = $compinst->RecModifiedBy = $_POST['RecModifiedBy'];
            
            $compinst->DelFlg = 'N';

//Send elements to be validated
            //$validateme = ["WorkflowId"];
            //$this->ValidationEngine($validateme);

//if validation succeeds then commit info to database
            if (1) {
//                if ($compinst->IfExists($compinst->WorkflowId) === 0) {
//                    $compinst->CreateWorkflow($username);
//                }

//if validation succeeds then log audit record to database
                if (1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                    $TranDesc = 'Create New Workflow for ' . $compid . " Name " . $compname;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $compinst->CreateWorkflow($EquipmentId, $ItemName, $Category, $UnitCost, $UnitMeasurement, $RecEntered, $RecEnteredBy, $DelFlg);
                    $token = '<br><br><span class="label label-success">Workflow Name</span> ' . '<span class="label label-info"> ' . $compname . '</span><br><br><br>' .
                            '<span class="label label-success">Workflow Id</span> ' . '<span class="label label-info">' . $compid . '</span><br>';
                    $token1 = 'Record Successfully Created';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            } else {
                //if validation fails do postback with values already entered
                $model = new \PfomModel\Workflow();
                $template = new MasterTemplate();
                $template->load("Views/Workflow/workflow.html");
                $template->replace("WorkflowId", $this->WorkflowId);
                
                $template->publish();
            }
        } else
        if (isset($_GET)) {
            $model = new \PfomModel\Workflow();

            $template = new MasterTemplate();
            $template->load("Views/Workflow/workflow.html");
            $template->replace("WorkflowId", "");
            
            $template->replace("Name", "");
            $template->replace("ItemName", "");
            $template->replace("Category", "");
            $template->replace("UnitCost", "");
            $template->replace("UnitMeasurement", "");

            $template->replace("RecEntered", "");
            $template->replace("RecEnteredBy", "");
            $template->replace("RecModified", "");
            $template->replace("RecModifiedBy", "");
            
            $template->replace("title", " Create New Workflow ");
            $template->publish();
        }
    }

}
?>
