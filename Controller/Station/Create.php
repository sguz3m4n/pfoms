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

    public $DivisionId;
    public $DivisionName;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;
    public $MyStationRecords;

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
            $compinst = new \PfomModel\Station();
            $audinst = new \PfomModel\Audit();
            $this->DivisionId = $DivisionId = $compinst->DivisionId = $_POST['DivisionId'];
            $this->DivisionName = $compinst->DivisionName = $DivisionName = $_POST['DivisionName'];
            $this->MyDivisionRecords = $stationrecs = json_decode($_POST['stationlist'], TRUE);
            $compinst->DelFlg = 'N';

//Send elements to be validated
//            $validateme = ["EquipmentId"];
//            $this->ValidationEngine($validateme);
//if validation succeeds then commit info to database
            if (1) {
//                if ($compinst->IfExists($compinst->EquipmentId) === 0) {
//                    $compinst->CreateDivision($username);
//                }
//if validation succeeds then log audit record to database
                if (1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                    $TranDesc = 'Create New Division for ' . $DivisionId . " Name " . $DivisionName;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $compinst->CreateDivision($DivisionId, $DivisionName, $username);
                    
                    $token = '<br><br><span class="label label-success">Division Name</span> ' . '<span class="label label-info"> ' . $DivisionName . '</span><br><br><br>' .
                    '<span class="label label-success">Division Id</span> ' . '<span class="label label-info">' . $DivisionId . '</span><br>';
                    
                    foreach ($stationrecs as list($StationId, $StationName)) {
                        $compinst->CreateStation($DivisionId, $StationId, $StationName, $username);
                        $TranDesc = 'Create New Station for ' . $StationId . " Name " . $StationName;
                        $token = $token . '<br><br><span class="label label-success">Station Name</span> ' . '<span class="label label-info"> ' . $StationName . '</span><br><br><br>' .
                            '<span class="label label-success">Station Id</span> ' . '<span class="label label-info">' . $StationId . '</span><br>';
                    }
//                    
//                     $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
//                        $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
//                       
                    
                    $token1 = 'Record Successfully Created';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            } else {
                //if validation fails do postback with values already entered
                $model = new \PfomModel\Station();
                $template = new MasterTemplate();
                $template->load("Views/Station/station.html");
                $template->replace("DivisionId", $this->DivisionId);
                $template->replace("DivisionName", $this->DivisionName);

                $template->publish();
            }
        } else
        if (isset($_GET)) {
            $model = new \PfomModel\Station();

            $template = new MasterTemplate();
            $template->load("Views/Station/station.html");
            $template->replace("DivisionId", "");
            $template->replace("DivisionName", "");

            $template->replace("title", " Create New Division ");
            $template->publish();
        }
    }

}

?>
