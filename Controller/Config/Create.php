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


class ConfigCreateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $ItemCode = "";
    private $ItemName = "";
    private $Value = "";
    private $Comments = "";
    
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
            $compinst = new \PfomModel\Config();
            $audinst = new \PfomModel\Audit();
            $this->ConfigId = $compid = $compinst->ConfigId = $_POST['ConfigId'];

            $this->ItemName = $ItemName = $compinst->ItemName = $_POST['ItemName'];
            $this->ItemCode = $ItemCode = $compinst->ItemCode = $_POST['ItemCode'];
            $this->Value = $Value =  $compinst->Value = $_POST['Value'];
            $this->Comments = $Comments =  $compinst->Comments = $_POST['Comments'];
            
//            $this->RecEntered = $Comments = $compinst->RecEntered = $_POST['RecEntered'];
            $this->RecEnteredBy = $Comments = $compinst->RecEnteredBy = $username;
//            $this->RecModified = $Comments = $compinst->RecModified = $_POST['RecModified'];
//            $this->RecModifiedBy = $Comments = $compinst->RecModifiedBy = $_POST['RecModifiedBy'];
            
            $compinst->DelFlg = $DelFlg = 'N';

//Send elements to be validated
            //$validateme = ["ConfigId"];
            //$this->ValidationEngine($validateme);

//if validation succeeds then commit info to database
            if (1) {
                $compinst->CreateConfig($ItemCode, $ItemName, $Value, $Comments, $RecEnteredBy, $DelFlg);
                    
//                if ($compinst->IfExists($compinst->ConfigId) === 0) {
//                    $compinst->CreateConfig($username);
//                }

//if validation succeeds then log audit record to database
                if ($compinst->auditok == 1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                    $TranDesc = 'Create New Config for ' . $ItemCode . " Name " . $ItemName;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $token = '<br><br><span class="label label-success">Config Name</span> ' . '<span class="label label-info"> ' . $ItemName . '</span><br><br><br>' .
                            '<span class="label label-success">Config Id</span> ' . '<span class="label label-info">' . $ItemCode . '</span><br>';
                    $token1 = 'Record Successfully Created';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            } else {
                //if validation fails do postback with values already entered
                $model = new \PfomModel\Config();
                $template = new MasterTemplate();
                $template->load("Views/Config/config.html");
                $template->replace("ConfigId", $this->ConfigId);
                $template->replace("ItemName", $this->ItemName);
                $template->replace("ItemCode", $this->ItemCode);
                $template->replace("Value", $this->Value);
                $template->replace("Comments", $this->Comments);
                

                $template->replace("val_ConfigId", $_SESSION['$compidwrapper']);
                $template->publish();
            }
        } else
        if (isset($_GET)) {
            $model = new \PfomModel\Config();

            $template = new MasterTemplate();
            $template->load("Views/Config/config.html");
            $template->replace("ConfigId", "");
            
            $template->replace("ItemName", "");
            $template->replace("ItemCode", "");
            $template->replace("Value", "");
            $template->replace("Comments", "");
            
            $template->replace("RecEntered", "");
            $template->replace("RecEnteredBy", "");
            $template->replace("RecModified", "");
            $template->replace("RecModifiedBy", "");
            
            $template->replace("title", " Create New Config ");
            $template->publish();
        }
    }

}
?>
