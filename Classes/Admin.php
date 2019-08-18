<?php
/*
  Developed by Kitji Studios
  Development Team: Shayne Marshall, Frederick Masterton Chandler, Kamar Durant
  Property of Barbados Royal Barbados Police Force
  Consultation and Analysis by Data Processing Department
  2019
 */
namespace PfomModel;


class UserModule {

    public $Natregno;
    public $UserName;
    public $Password;
    public $FirstName;
    public $Roles;
    public $LastLogin;
    public $SystemRoles = array('Human Resource Clerk', 'Manager', 'Administrator', 'Super User', 'Receipt Clerk', 'Payment Clerk', 'Disable');

    //Create New User
    function CreateNewUser() {
        $conn = conn();
        $this->Password = $this->Hasher($this->Password);
        $sql = "INSERT INTO `users`(`national_id`, `username`, `password`, `firstname`, `roles`, `lastlogon`) VALUES  ('$this->Natregno','$this->UserName','$this->Password','$this->FirstName','$this->Roles',NULL)";

        if ($conn->exec($sql)) {
            return 1;
        } else {
            return 0;
        }
        $conn = NULL;
    }

    //Method to hash password
    private function Hasher($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    //Edit Existing User
    function UpdateExistingUser($Natid) {
        $conn = conn();
        $this->Password = $this->Hasher($this->Password);

        $sql = "UPDATE `users` SET `national_id`='$this->Natregno',`username`='$this->UserName',`password`='$this->Password',`firstname`='$this->FirstName',`roles`='$this->Roles' WHERE national_id='$Natid'";
        if ($conn->exec($sql)) {
            return 1;
        } else {
            return 0;
        }
        $conn = NULL;
    }

    //Check to see if user currently exists
    function IfExists($natregno) {
        $conn = conn();
        $sql = "SELECT * FROM users WHERE national_id='$natregno'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            return 0;
        }
        return 1;
        $conn = NULL;
    }

}




