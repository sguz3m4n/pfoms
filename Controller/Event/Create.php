<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados  Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace Controllers;

require 'Classes/Event.php';
require 'Classes/Company.php';
require 'Classes/Audit.php';
require 'Controller/base_template.php';
/*
  static $EventId = "";
  static $EventName = "";
  static $CompanyId = "";
  static $CompanyName = "";
  static $ContactName = "";
  static $ContactNumber = "";
  static $ContactEmail = "";
  static $EventDate = "";
 */

class EventCreateController extends PermissionController {
    /* function __construct() {
      $this->setRoles(['Human Resource Clerk', 'Manager', 'Administrator', 'Super User']);
      }

     */

    private $EventId = "";
    private $EventName = "";
    private $CompanyId = "";
    private $CompanyName = "";
    private $ContactName = "";
    private $ContactNumber = "";
    private $ContactEmail = "";
    private $EventDate = "";
    private $EventCost = "";
    private $Comments = "";
    
                function show($params) {
        $username = $_SESSION["login_user"];

        if (isset($_POST['btn-create'])) {
            $eventinst = new \BarcomModel\Event();
            $eventinst = new \BarcomModel\Company();
            $audinst = new \BarcomModel\Audit();

            //(isset($_POST['CompId']) ? $this->CompId = $varid = $refinst->CompanyId = $_POST['CompId'] : $this->CompId = $varid = $refinst->CompanyId = "");
            $eventinst->EventName = $EventName = $_POST["EventName"];
            $eventinst->EventDate = $EventDate = $_POST["EventDate"];
            $eventinst->EventCost = $EventCost = $_POST["EventCost"];
             $eventinst->Comments = $Comments = $_POST["Comments"];
            $eventinst->EventId = $eventinst->GenerateTimestamp("EVNT");
            $eventinst->DelFlg = $DelFlg = "N";
            $eventinst->CreateEvent($EventId, $EventName, $EventCost, $CompanyId, $CompanyName, $ContactName, $ContactNumber, $ContactEmail, $EventDate, $Comments, NOW(), $RecEnteredBy, $DelFlg);
        } else
        if (isset($_GET)) {
            $template = new MasterTemplate();
            $template->load("Views/Event/event.html");
            $template->replace("EventName", "");
            $template->replace("CompanyName", "");
            $template->replace("ContactName", "");
            $template->replace("ContactNumber", "");
            $template->replace("ContactEmail", "");
            $template->replace("EventDate", "");
            $template->replace("EventCost", "");

            $template->publish();
        }
    }

}
?>



