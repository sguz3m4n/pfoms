<?php

namespace PfomModel;

/**
 * Description of Approve
 *
 * @author Shayne Marshall
 */
class Approve {

    public $Approve;
   public $auditok;
    function ApproveIt($EventId) {

        $conn = conn();
        $sql = "UPDATE `event` SET `Status`='Approved' WHERE `EventId`='$EventId' AND `DelFlg`='N'";

        if ($conn->exec($sql)) {
            $this->auditok = 1;
        } else {
            $this->auditok = 0;
        }
        $conn = NULL;
    }

}
