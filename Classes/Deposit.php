<?php

/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */

namespace BarcomModel;

class Deposit {

    //Employee class properties map directly to employee table
    public $TransId;
    public $EventId;
    public $ProformaNumber;
    public $InvoiceNumber;
    public $ReceiptNumber;
    public $ReceiptDate;
    public $GOBAVJ;
    public $GOBAVJDate;
    public $TranType;
    public $CompanyName;
    public $CompanyId;
    public $PreviousBalance;
    public $CurrentBalance;
    public $CompanyBalance;
    public $DepositAmount;
    public $Comments;
    public $RecEntered;
    public $ReEnteredBy;
    //Employee class properties map directly to employee table

    public $auditok;

    //Method used to calculate current balance
    function CurrentBalance($depamount, $prevamount) {
        $total = $prevamount + $depamount;
        return $total;
    }

    function GetPreAccountList() {
        $result = "";
        $conn = conn();
        $stmt = $conn->prepare("SELECT rolename,ratecode FROM employeeroles ORDER BY rolename ASC;");
        $stmt->execute();
        $result_array = $stmt->fetchAll();
        foreach ($result_array as $value) {
            $accountcode = $value['ratecode'];
            $result .= "<option id='$accountcode' >" . $value['rolename'] . "</option>";
        }
        return $result;
        $conn = NULL;
    }

    function RefundBalance($refamount, $curamount) {
        $total = $curamount - $refamount;
        return $total;
    }

    function MakePayment($payment, $currentbal, $companyid) {
        $newbal = $this->RefundBalance(number_format($currentbal, 2, '.', ''), number_format($payment, 2, '.', ''));
        $conn = conn();
        $sql = "UPDATE `deposit` SET `PreviousBalance`='$payment',`CurrentBalance`='$newbal',`Comments`='Payment',`RecEntered`=NOW(),RecEnteredBy='$this->ReEnteredBy' WHERE `CompanyId`='$companyid'";
        if ($conn->exec($sql)) {
            return 1;
        } else {
            return 0;
        }
        $conn = NULL;
    }

    function ReturnMakePayment($balance, $giveback, $payment, $companyid) {
        $this->CompanyBalance = $rebate = $this->RefundBalance(number_format($giveback, 2, '.', ''), number_format($balance, 2, '.', ''));
        $this->MakePayment($rebate, $payment, $companyid);
        /* $conn = conn();
          $sql = "UPDATE `deposit` SET `PreviousBalance`='$newbal',`CurrentBalance`='$newbal',`Comments`='Payment',`RecEntered`=NOW(),RecEnteredBy='$this->ReEnteredBy' WHERE `CompanyId`='$companyid'";
          if ($conn->exec($sql)) {
          return 1;
          } else {
          return 0;
          }
          $conn = NULL; */
    }

    //Method to create first time new company deposit
    function CreateDeposit() {
        $conn = conn();

        $sql = "INSERT INTO `deposit`(`CompanyId`, `DepositAmount`, `PreviousBalance`, `CurrentBalance`, `Comments`, `RecEntered`, `RecEnteredBy`) VALUES "
                . "('$this->CompanyId','$this->DepositAmount','$this->PreviousBalance','$this->CurrentBalance','$this->Comments',NOW(), '$this->ReEnteredBy')";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    function CreateDepositTransactionRecord($tranid, $proforma, $invoiceno, $receiptno, $receiptdate, $trantype, $companyname, $companyid, $eventid, $GOBAvj, $GOBDate, $PrevBal, $CurBal, $CompBal, $DepAmt, $Comments, $username) {
        $conn = conn();
        $sql = "INSERT INTO `deposittransaction` (`TransId`, `ProformaNumber`, `InvoiceNumber`, `ReceiptNumber`, `ReceiptDate`, `TranType`, `CompanyName`, `CompanyId`, `EventId`, `GOBAvj`, `GOBDate`, `PreviousBalance`, `CurrentBalance`, `CompanyBalance`, `DepositAmount`, `Comments`, `RecEntered`, `RecEnteredBy`)"
                . " VALUES ('$tranid', '$proforma','$invoiceno','$receiptno','$receiptdate', '$trantype','$companyname','$companyid','$eventid','$GOBAvj','$GOBDate','$PrevBal','$CurBal','$CompBal','$DepAmt','$Comments',NOW(), '$username')";
        if ($conn->exec($sql)) {
            //echo "New record created successfully";
        } else {
            //echo "New record created successfully";
        }
        $conn = NULL;
    }

    //Method to update existing company deposit
    function EditDeposit($companyid) {
        $conn = conn();
        $sql = "UPDATE `deposit` SET `CompanyId`='$this->CompanyId',`DepositAmount`='$this->DepositAmount',`PreviousBalance`='$this->PreviousBalance',
                  `CurrentBalance`='$this->CurrentBalance',`Comments`='$this->Comments',`RecEntered`=NOW(),RecEnteredBy='$this->ReEnteredBy' WHERE `CompanyId`='$companyid'";
        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

    //Method to check if company already exists
    function IfExists($companyid) {
        $conn = conn();
        $sql = "SELECT * FROM deposit WHERE companyid='$companyid'";
        $stmt = $conn->prepare($sql);
        $status = $stmt->execute();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            return 1;
        } else {
            return 0;
        }

        $conn = NULL;
    }

}
