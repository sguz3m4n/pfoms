<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Employee.php';
require 'Classes/Audit.php';
require 'Classes/BankAccount.php';
require 'Controller/base_template.php';

static $natregerr = "";
static $natregwrapper = "";
static $nisnoerr = "";
static $nisnowrapper = "";
static $natregunqerr = "";
static $natregunqwrapper = "";

class EmployeeCreateController extends PermissionController {

    function __construct() {
        $this->setRoles(['Human Resource Clerk', 'Manager', 'Administrator', 'Super User']);
    }

    private $Natregno = "";
    private $TIN = "";
    private $NISNo = "";
    private $ForceNumber = "";
    private $Lastname = "";
    private $FirstName = "";
    private $MiddleName = "";
    private $Title = "";
    private $AddressLine1 = "";
    private $AddressLine2 = "";
    private $AddressLine3 = "";
    private $Parish = "";
    private $PostalCode = "";
    private $WorkPhone = "";
    private $HomePhone = "";
    private $CellNo = "";
    private $Ext = "";
    private $RoleName = "";
    private $PostType = "";
    private $DateOfBirth;
    private $Age = null;
    private $Gender = "";
    private $PayRate;
    private $RateCode = "";
    private $Notes = "";
    private $Email = "";
    private $EmpStatus;
    private $NatRegIsValid;
    private $NISNoIsValid = "";
    private $NatRegExists = "";
    private $MyPaymentsRecords;

    //Validation Engine will execute any validation on the fields in the interface
    function ValidationEngine($elements) {
        $empinst = new \BarcomModel\Employee();
        foreach ($elements as $value) {
            if ($value == "Natregno") {
                if ((strlen($this->Natregno) < 10) || (strlen($this->Natregno) > 10)) {
                    $natregerr = "National Reg No is invalid length";
                    $_SESSION['$natregwrapper'] = '<span style="color:red" >' . " * " . $natregerr . '</span>';
                    $this->NatRegIsValid = 0;
                } else {
                    $this->NatRegIsValid = 1;
                    $_SESSION['$natregwrapper'] = NULL;
                }
            }
            if ($value == "Natregno") {
                if ($empinst->IfExists($this->Natregno) === 0) {
                    $natregunqerr = "This National Registration currently exists";
                    $_SESSION['$natregunqwrapper'] = '<span style="color:red" >' . " * " . $natregunqerr . '</span>';
                    $this->NatRegExists = 0;
                } else {
                    $this->NatRegExists = 1;
                    $_SESSION['$natregunqwrapper'] = NULL;
                }
            }
            if ($value == "NISNo") {
                if (strlen($this->NISNo) < 6) {
                    $nisnoerr = "NIS No is invalid length";
                    $_SESSION['$nisnowrapper'] = '<span style="color:red">' . " * " . $nisnoerr . '</span>';
                    $this->NISNoIsValid = 0;
                } else {
                    $this->NISNoIsValid = 1;
                    $_SESSION['$nisnowrapper'] = NULL;
                }
            }
        }
    }

    //Render page contents depeding on http method call
    //If there is a GET call just render the page contens
    //If there is a POST call and data entered passes validation then submit to database
    //else POSTBACK data with validations errors
    function show($params) {
        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-create'])) {
            //variables for data input 
            $empinst = new \BarcomModel\Employee();
            $audinst = new \BarcomModel\Audit();
            $bankaccount = new \BarcomModel\BankAccount();
            //ternary operator example
            (isset($_POST['Natregno']) ? $this->Natregno = $empid = $empinst->Natregno = $_POST['Natregno'] : $this->Natregno = $empid = $empinst->Natregno = "");
            $this->MyPaymentsRecords = $pymntrecs = json_decode($_POST['accountlist'], TRUE);
            $this->TIN = $TIN = $empinst->TIN = $_POST['TIN'];
            $this->NISNo = $NISNo = $empinst->NISNo = $_POST['NISNo'];
            $this->ForceNumber = $ForceNumber = $empinst->ForceNumber = $_POST['ForceNumber'];
            $this->Lastname = $empinst->LastName = $_POST['LastName'];
            $this->FirstName = $empinst->FirstName = $_POST['FirstName'];
            $this->MiddleName = $empinst->MiddleName = $_POST['MiddleName'];
            $this->Title = $empinst->Title = $_POST['Title'];
            $this->AddressLine1 = $empinst->AddressLine1 = $_POST['AddressLine1'];
            $this->AddressLine2 = $empinst->AddressLine2 = $_POST['AddressLine2'];
            $this->AddressLine3 = $empinst->AddressLine3 = $_POST['AddressLine3'];
            $this->Parish = $empinst->Parish = $_POST['Parish'];
            $this->PostalCode = $empinst->PostalCode = $_POST['PostalCode'];
            $this->WorkPhone = $empinst->WorkPhone = $_POST['WorkPhone'];
            $this->HomePhone = $empinst->HomePhone = $_POST['HomePhone'];
            $this->CellNo = $empinst->CellNo = $_POST['CellNo'];
            $this->Ext = $empinst->Ext = $_POST['Ext'];
            $this->RoleName = $empinst->RoleName = $_POST['RoleName'];
            //$this->PostType = $empinst->PostType = $_POST['PostType'];
            $this->DateOfBirth = $birthDate = $empinst->DateOfBirth = $_POST['DateOfBirth'];
            $this->Age = $empinst->Age = $age = (date('Y') - date('Y', strtotime($birthDate)));
            $_POST['Gender'] == "Male" ? $empinst->Gender = "M" : $empinst->Gender = "F";
            // $this->PayRate = $empinst->PayRate = $_POST['PayRate'];
            $this->RateCode = $empinst->RateCode = $_POST['RateCode'];
            $this->Notes = $empinst->Notes = $_POST['Notes'];
            $this->Email = $empinst->Email = $_POST['Email'];

            $name = $empinst->FirstName . " " . $empinst->LastName;
            $empinst->EmpStatus = 'Active';
            $empinst->DelFlg = 'N';

            //Send elements to be validated
            $validateme = ["Natregno", "NISNo"];
            $this->ValidationEngine($validateme);

            //if validation succeeds then commit info to database
            if (($this->NatRegIsValid) && ($this->NISNoIsValid) && (!$this->NatRegExists)) {
                // if ($empinst->IfExists($empinst->Natregno) === 0) {
                $empinst->CreateEmployee($username);
                foreach ($pymntrecs as $value) {
                    $bankaccount->AccountNumber = $accountnumber = $value[3];
                    $bankaccount->BankCode = $bankcode = $value[1];
                    $bankaccount->BankName = $bankname = $value[2];
                    $bankaccount->EntityId = $ForceNumber;
                    $bankaccount->CreateBankAccount($accountnumber, $bankcode, $bankname, $ForceNumber, $username);
                }
                // }
                //if validation succeeds then log audit record to database
                if ($empinst->auditok == 1) {
                    $tranid = $audinst->TranId = $audinst->GenerateTimestamp('CEMP');
                    $TranDesc = 'Create New Employee for ' . $empid . " Name " . $name;
                    $User = $username;
                    $audinst->CreateUserAuditRecord($tranid, $User, $TranDesc);
                    $token = '<br><br><span class="label label-success">Employee Name</span> ' . '<span class="label label-info"> ' . $name . '</span><br><br><br>' .
                            '<span class="label label-success">Employee Id</span> ' . '<span class="label label-info">' . $empid . '</span><br>';
                    $token1 = 'Record Successfully Created';
                    header("Location:" . "/success?result=$token&header=$token1&args=");
                }
            } else {
                //if validation fails do postback with values already entered 
                $model = new \BarcomModel\Employee();
                $roles = $model->GetRoles();
                $parishes = $model->GetParishes();
                $template = new MasterTemplate();
                $template->load("Views/Employee/employee.html");
                $template->replace("Natregno", $this->Natregno);
                $template->replace("TIN", $this->TIN);
                $template->replace("NISNo", $this->NISNo);
                $template->replace("ForceNumber", $this->ForceNumber);
                $template->replace("LastName", $this->Lastname);
                $template->replace("FirstName", $this->FirstName);
                $template->replace("MiddleName", $this->MiddleName);
                $template->replace("Title", $this->Title);
                $template->replace("AddressLine1", $this->AddressLine1);
                $template->replace("AddressLine2", $this->AddressLine2);
                $template->replace("AddressLine3", $this->AddressLine3);
                $template->replace("Parish", $this->Parish);
                $template->replace("PostalCode", $this->PostalCode);
                $template->replace("WorkPhone", $this->WorkPhone);
                $template->replace("HomePhone", $this->HomePhone);
                $template->replace("CellNo", $this->CellNo);
                $template->replace("Ext", $this->Ext);
                $template->replace("Email", $this->Email);

                $template->replace("title", " Create New Customs Employee");
                $template->replace("val_Natregno", $_SESSION['$natregwrapper']);
                $template->replace("val_NISNo", $_SESSION['$nisnowrapper']);
                $template->replace("val_Unique", $_SESSION['$natregunqwrapper']);
                $template->replace("roles", $roles);
                $template->replace("parishes", $parishes);
                $template->replace("username", $username);
                $template->publish();
                //if validation fails do postback with values already entered 
            }
        } else
        if (isset($_GET)) {
            $model = new \BarcomModel\Employee();
            $roles = $model->GetRoles();
            $parishes = $model->GetParishes();
            $actives = $model->CountActive();
            $template = new MasterTemplate();
            $template->load("Views/Employee/employee.html");
            $template->replace("roles", $roles);
            $template->replace("parishes", $parishes);
            $template->replace("username", $username);
            $template->replace("activeemployees", $actives);
            $template->replace("title", " Create New Customs Employee");

            $template->replace("Natregno", "");
            $template->replace("TIN", "");
            $template->replace("NISNo", "");
            $template->replace("ForceNumber", "");
            $template->replace("LastName", "");
            $template->replace("FirstName", "");
            $template->replace("MiddleName", "");
            $template->replace("Title", "");
            $template->replace("AddressLine1", "");
            $template->replace("AddressLine2", "");
            $template->replace("AddressLine3", "");
            $template->replace("PostalCode", "");
            $template->replace("WorkPhone", "");
            $template->replace("HomePhone", "");
            $template->replace("CellNo", "");
            $template->replace("Ext", "");
            $template->replace("DateOfBirth", "");
            $template->replace("Email", "");

            $template->replace("val_Natregno", "");
            $template->replace("val_DOB", "");
            $template->replace("val_NISNo", "");
            $template->replace("val_Title", "");
            $template->replace("val_FirstName", "");
            $template->replace("val_MiddleName", "");
            $template->replace("val_LastName", "");
            $template->replace("val_AddressLine1", "");
            $template->replace("val_AddressLine2", "");
            $template->replace("val_AddressLine3", "");
            $template->replace("val_PostalCode", "");
            $template->replace("val_WorkPhone", "");
            $template->replace("val_Ext", "");
            $template->replace("val_FaxNum", "");
            $template->replace("val_HomePhone", "");
            $template->replace("val_CellNo", "");
            $template->replace("val_Email", "");
            $template->replace("val_Unique", "");
            $template->publish();
        }
    }

}
?>



