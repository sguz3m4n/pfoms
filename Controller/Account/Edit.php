<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Account.php';
require 'Classes/Audit.php';
require 'Controller/base_template.php';


class AccountEditController extends PermissionController {

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
            $compinst = new \BarcomModel\Account();
            $audinst = new \BarcomModel\Audit();

            //Get Id from browser interface
            $AccountId = $_POST['AccountId'];

            //Check to see if the record already exists            
            //If it does execute update
            if ($compinst->IfExists($AccountId) === 1) {
                $this->AccountId = $compid = $compinst->AccountId = $_POST['AccountId'];
                $this->Name = $compname = $compinst->AccountName = $_POST['AccountName'];
                $this->Type = $compinst->Type = $_POST['Type'];
                
                $compinst->RecModifiedBy = $username;

                //Send elements to be validated
//                $validateme = ["AccountName"];
//                $this->ValidationEngine($validateme);

                //if validation succeeds then commit info to database
                if (1) {
                    $compinst->EditAccount($AccountId);

                    if (1) {
                        $tranid = $audinst->TranId = $audinst->GenerateTimestamp('UCMP');
                        $TranDesc = 'Update Account for ' . $compid . " Name " . $compname;
                        $User = $username;
                        $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                        $compinst->UpdateAccount($AccountId);
                        $token = '<br><br><span class="label label-success">Account Name</span> ' . '<span class="label label-info"> ' . $compname . '</span><br><br><br>' .
                                '<span class="label label-success">Account Id</span> ' . '<span class="label label-info">' . $compid . '</span><br>';
                        $token1 = 'Record Successfully Updated';
                        header("Location:" . "/success?result=$token&header=$token1&args=");
                    }
                } else {
                    //if validation fails do postback to main page with validation error 
                    $template = new MasterTemplate();
                    $template->load("Views/Account/account_edit.html");
                    //$template->replace("parishes", $parishes);
                    $template->replace("title", " Create New Account ");
                    $template->replace("AccountName", $this->Name);
                    $template->publish();
                }
            }
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Account();
            $template = new MasterTemplate();
            $template->load("Views/Account/account_edit.html");
            $template->replace("title", " Create New Account ");
            $template->publish();
        }
    }

}
