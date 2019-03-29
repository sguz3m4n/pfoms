<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace BarcomModel;

class BankAccount {

    public $AccountNumber;
    public $BankCode;
    public $BankName;
    public $EntityId;
    public $RecEntered;
    public $RecEnteredBy;
    public $RecModified;
    public $RecModifiedBy;
    public $DelFlg;

    public function CreateBankAccount($AccountNumber, $BankCode, $BankName, $EntityId, $username) {
        $conn = conn();
        $sql = "INSERT INTO `bankaccount`(`AccountNumber`, `BankCode`, `BankName`, `EntityId`, `RecEntered`, `RecEnteredBy`, `RecModified`, `RecModifiedBy`, `DelFlg`) "
                . "VALUES ('$AccountNumber','$BankCode','$BankName','$EntityId',NOW(),'$username',NOW(),'$username','N')";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
    }

}
