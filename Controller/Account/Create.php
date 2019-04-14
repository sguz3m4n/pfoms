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
    private $Name = "";
    private $Type = "";
    
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
            $compinst = new \BarcomModel\Account();
            $audinst = new \BarcomModel\Audit();
            $this->AccountId = $compid = $compinst->AccountId = $_POST['AccountId'];

            $this->Name = $compname = $compinst->Name = $_POST['Name'];
            $this->Type = $compinst->Type = $_POST['Type'];
            $this->RecEntered = $compinst->RecEntered = $_POST['RecEntered'];
            $this->RecEnteredBy = $compinst->RecEnteredBy = $_POST['RecEnteredBy'];
            $this->RecModified = $compinst->RecModified = $_POST['RecModified'];
            $this->RecModifiedBy = $compinst->RecModifiedBy = $_POST['RecModifiedBy'];
            
            $compinst->DelFlg = 'N';

//Send elements to be validated
            //$validateme = ["AccountId"];
            //$this->ValidationEngine($validateme);

//if validation succeeds then commit info to database
            if (1) {
//                if ($compinst->IfExists($compinst->AccountId) === 0) {
//                    $compinst->CreateAccount($username);
//                }

//if validation succeeds then log audit record to database
                if (1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CCMP');
                    $TranDesc = 'Create New Account for ' . $compid . " Name " . $compname;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $compinst->CreateAccount($AccountId, $Name, $Type, $RecEntered, $RecEnteredBy,$DelFlg);
                    $token = '<br><br><span class="label label-success">Account Name</span> ' . '<span class="label label-info"> ' . $compname . '</span><br><br><br>' .
                            '<span class="label label-success">Account Id</span> ' . '<span class="label label-info">' . $compid . '</span><br>';
                    $token1 = 'Record Successfully Created';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            } else {
                //if validation fails do postback with values already entered
                $model = new \BarcomModel\Account();
                $template = new MasterTemplate();
                $template->load("Views/Account/account.html");
                $template->replace("AccountId", $this->AccountId);
                

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
