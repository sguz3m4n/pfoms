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


class EquipmentEditController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $Name = "";

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
            $equipinst = new \BarcomModel\Equipment();
            $audinst = new \BarcomModel\Audit();

            //Get Id from browser interface
            $EquipmentId = $_POST['EquipmentId'];

            //Check to see if the record already exists            
            //If it does execute update
            if ($equipinst->IfExists($EquipmentId) === 1) {
                $this->EquipmentId = $equipid = $equipinst->EquipmentId = $_POST['EquipmentId'];
                
                $this->ItemName = $compname = $equipinst->ItemName = $_POST['ItemName'];
                $this->Category = $equipinst->Category = $_POST['Category'];
                $this->UnitCost = $equipinst->UnitCost = $_POST['UnitCost'];
                $this->UnitMeasurement = $equipinst->UnitMeasurement = $_POST['UnitMeasurement'];
                
                $equipinst->RecModifiedBy = $username;

                //Send elements to be validated
//                $validateme = ["EquipmentName"];
//                $this->ValidationEngine($validateme);

                //if validation succeeds then commit info to database
                if ($this->NameIsValid) {
                    $equipinst->EditEquipment($EquipmentId);

                    if ($equipinst->auditok == 1) {
                        $tranid = $audinst->TranId = $audinst->GenerateTimestamp('UCMP');
                        $TranDesc = 'Update Equipment for ' . $equipid . " Name " . $compname;
                        $User = $username;
                        $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                        $token = '<br><br><span class="label label-success">Equipment Name</span> ' . '<span class="label label-info"> ' . $compname . '</span><br><br><br>' .
                                '<span class="label label-success">Equipment Id</span> ' . '<span class="label label-info">' . $equipid . '</span><br>';
                        $token1 = 'Record Successfully Updated';
                        header("Location:" . "/success?result=$token&header=$token1&args=");
                    }
                } else {
                    //if validation fails do postback to main page with validation error 
                    $template = new MasterTemplate();
                    $template->load("Views/Equipment/equipment_edit.html");
                    //$template->replace("parishes", $parishes);
                    $template->replace("title", " Create New Equipment ");
                    $template->replace("EquipmentName", $this->ItemName);
                    $template->publish();
                }
            }
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Equipment();
            $template = new MasterTemplate();
            $template->load("Views/Equipment/equipment_edit.html");
            $template->replace("title", " Create New Equipment ");
            $template->publish();
        }
    }

}
