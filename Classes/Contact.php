<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace PfomModel;
require 'Classes/Company.php';
class Contact extends Company {

    function __construct() {
        
    }

    //Company class properties map directly to company table
    public $ContactName;
    public $ContactEmail;
    public $ContactNumber;
    public $DelFlg;
    public $Companyid;

    //Create Company Method
    function CreateContact($contactname,$contactemail,$contactnumber,$companyid) {
        $conn = conn();
        $sql = "INSERT INTO `contact`(`ContactName`, `ContactEmail`, `ContactNumber`, `CompanyId`, `DelFlg`) VALUES"
                . " ('$contactname','$contactemail','$contactnumber','$companyid','N')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

}
