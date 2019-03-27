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


class ConfigEditController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $ItemCode = "";
    private $ItemName = "";
    private $Value = "";
    private $Comments = "";

    //Validation Engine will execute any validation on the fields in the interface
    function ValidationEngine($elements) {
        foreach ($elements as $value) {
        }
    }

    //Validation Engine will execute any validation on the fields in the interface
    ////Render page contents depeding on http method call
    //If there is a GET call just render the page contens
    //If there is a POST call and data entered passes validation then submit to database
    //else POSTBACK data 
    //with validations errors
    function show($params) {

        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-update'])) {
            $compinst = new \BarcomModel\Config();
            $audinst = new \BarcomModel\Audit();

            //Get Id from browser interface
            $ConfigId = $_POST['ConfigId'];

            //Check to see if the record already exists            
            //If it does execute update
            if ($compinst->IfExists($ConfigId) === 1) {
                $this->ConfigId = $compid = $compinst->ConfigId = $_POST['ConfigId'];
                $this->ItemName = $compname = $compinst->ItemName = $_POST['ItemName'];
                $this->ItemCode = $compinst->ItemCode = $_POST['ItemCode'];
                $this->Value = $compinst->Value = $_POST['Value'];
                $this->Comments = $compinst->Comments = $_POST['Comments']; 
                
                
                $compinst->RecModifiedBy = $username;

                //Send elements to be validated
//                $validateme = ["ConfigName"];
//                $this->ValidationEngine($validateme);

                //if validation succeeds then commit info to database
                if ($this->NameIsValid) {
                    $compinst->EditConfig($ConfigId);

                    if ($compinst->auditok == 1) {
                        $tranid = $audinst->TranId = $audinst->GenerateTimestamp('UCMP');
                        $TranDesc = 'Update Config for ' . $compid . " Name " . $compname;
                        $User = $username;
                        $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                        $token = '<br><br><span class="label label-success">Config Name</span> ' . '<span class="label label-info"> ' . $compname . '</span><br><br><br>' .
                                '<span class="label label-success">Config Id</span> ' . '<span class="label label-info">' . $compid . '</span><br>';
                        $token1 = 'Record Successfully Updated';
                        header("Location:" . "/success?result=$token&header=$token1&args=");
                    }
                } else {
                    //if validation fails do postback to main page with validation error 
                    $template = new MasterTemplate();
                    $template->load("Views/Config/config_edit.html");
                    //$template->replace("parishes", $parishes);
                    $template->replace("title", " Create New Config ");
                    $template->replace("ConfigName", $this->Name);
                    $template->publish();
                }
            }
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Config();
            $template = new MasterTemplate();
            $template->load("Views/Config/config_edit.html");
            $template->replace("title", " Create New Config ");
            $template->publish();
        }
    }

}
