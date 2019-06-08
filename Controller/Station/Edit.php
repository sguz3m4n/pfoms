<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Division.php';
require 'Classes/Audit.php';
require 'Controller/base_template.php';


class StationEditController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $DivisionId = "";
    private $DivisionName = "";   
    private $RecEntered = "";
    private $RecEnteredBy = "";
    private $RecModified = "";
    private $RecModifiedBy = "";
    private $DelFlg = "N";
    private $MyDivisionRecords = "";

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
            //$compinst = new \BarcomModel\Division();
            $compinst = new \BarcomModel\Station();
            $audinst = new \BarcomModel\Audit();

            //Get Id from browser interface
            $StationId = $_POST['StationId'];
            $StationName = $_POST['StationName'];
            $DivisionId = $_POST['DivisionId'];

            //Check to see if the record already exists            
            //If it does execute update
            if ($compinst->IfExists($StationId) === 1) {
//                $this->DivisionId = $compid = $compinst->DivisionId = $_POST['DivisionId'];
//                $this->DivisionName = $compinst->DivisionName = $_POST['DivisionName'];
//                $this->MyStationRecords = $stationrecs = json_decode($_POST['stationlist'], TRUE);
                $compinst->DelFlg = 'N';

                $compinst->RecModifiedBy = $username;

                //Send elements to be validated
//                $validateme = ["DivisionName"];
//                $this->ValidationEngine($validateme);

                //if validation succeeds then commit info to database
                if (1) {
                    if (1) {
                        $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                        //$TranDesc = 'Update Division :' . $DivisionId . " Name " . $DivisionName;
                        $User = $username;
                        $TranDesc = 'Update Station: ' . $StationId . " Name " . $StationName;
                        $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                        $compinst->UpdateStation($DivisionId, $StationId, $StationName, $username);
                        
                        $token = $token . '<br><br><span class="label label-success">Station Name</span> ' . '<span class="label label-info"> ' . $StationName . '</span><br><br><br>' .
                            '<span class="label label-success">Station Id</span> ' . '<span class="label label-info">' . $StationId . '</span><br>';
                        $token1 = 'Record Successfully Updated';
                        header("Location:" . "/success?result=$token&header=$token1&args=");
                        //$compinst->EditDivision($DivisionId);

//                        $token = '<br><br><span class="label label-success">Division Name</span> ' . '<span class="label label-info"> ' . $DivisionName . '</span><br><br><br>' .
//                        '<span class="label label-success">Division Id</span> ' . '<span class="label label-info">' . $DivisionId . '</span><br>';

//                        foreach ($stationrecs as list($StationId, $StationName)) {
//                            $compinst->UpdateStation($DivisionId, $StationId, $StationName, $username);
//                            $TranDesc = 'Update Station: ' . $StationId . " Name " . $StationName;
//                            $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
//                            $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
//                            $token = $token . '<br><br><span class="label label-success">Station Name</span> ' . '<span class="label label-info"> ' . $StationName . '</span><br><br><br>' .
//                                '<span class="label label-success">Station Id</span> ' . '<span class="label label-info">' . $StationId . '</span><br>';
//                        }                        
                    }
                } else {
                    //if validation fails do postback to main page with validation error 
                    $template = new MasterTemplate();
                    $template->load("Views/Station/station_edit.html");
                    //$template->replace("parishes", $parishes);
                    $template->replace("title", " Create New Division ");

                    $template->publish();
                }
            }
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Station();
            $template = new MasterTemplate();
            $template->load("Views/Station/station_edit.html");
            $template->replace("title", " Create New Division ");
            $template->publish();
        }
    }

}
