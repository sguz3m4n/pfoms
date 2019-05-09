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

static $compiderr = "";
static $compidwrapper = "";

class AccountCreateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Manager', 'Administrator', 'Super User']);
    }

    private $AccountId = "";
    private $AccountName = "";
    private $Type = "";
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
            $acctinst = new \BarcomModel\Account();
            $audinst = new \BarcomModel\Audit();
            $compid = $acctinst->AccountId = $AccountId = $_POST['AccountId'];
            $this->Name = $AccountName = $_POST['AccountName'];
            $this->Type = $Type = $_POST['Type'];
            $acctinst->DelFlg = 'N';

//Send elements to be validated
            //$validateme = ["AccountId"];
            //$this->ValidationEngine($validateme);
//if validation succeeds then commit info to database
            if (1) {  
                $acctinst->CreateAccount($AccountId, $AccountName, $Type, $username);
//                if ($acctinst->IfExists($acctinst->AccountId) === 0) {
//                    $acctinst->CreateAccount($username);
//                }
//if validation succeeds then log audit record to database
                if (1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                    $TranDesc = 'Create New Account for ' . $AccountId . " Name " . $AccountName;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
  
                    $token = '<br><br><span class="label label-success">Account Name</span> ' . '<span class="label label-info"> ' . $AccountName . '</span><br><br><br>' .
                            '<span class="label label-success">Account Id</span> ' . '<span class="label label-info">' . $AccountId . '</span><br>';
                    $token1 = 'Record Successfully Created';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            } else {
                //if validation fails do postback with values already entered
                $model = new \BarcomModel\Account();
                $template = new MasterTemplate();
                $template->load("Views/Account/account.html");
                $template->replace("AccountId", $this->AccountId);
                $template->replace("AccountName", $this->Name);

                $template->replace("val_AccountId", $_SESSION['$compidwrapper']);
                $template->publish();
            }
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Account();

            $template = new MasterTemplate();
            $template->load("Views/Account/account.html");
            $template->replace("AccountId", "");
            $template->replace("Type", "");
            $template->replace("RecEntered", "");
            $template->replace("RecEnteredBy", "");
            $template->replace("RecModified", "");
            $template->replace("RecModifiedBy", "");

            $template->replace("title", " Create New Account ");
            $template->publish();
        }
    }

}

?>
