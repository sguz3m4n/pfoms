<!DOCTYPE html>
<?php
include '../../../../dbconfig.php';
include '../../../../Classes/Employee.php';
include '../../../../Classes/Payment.php';


$q = $_GET['q'][0];
$StartDate = $_GET['InspectionDateStart'][0];
$conn = conn();

$sql = "SELECT * FROM employee emp , paymentrates rates WHERE rates.ratecode=emp.ratecode AND CONCAT_WS(' ',FirstName,LastName) = '" . $q . "' AND DelFlg='N'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$empinst = new PfomModel\Employee();

$PayRate;

$roles = $empinst->GetRoles();
if (!empty($result)) {
    foreach ($result as $value) {
        /* $buffer_data['Natregno'] = $_GET["Natregno"] = $empinst->Natregno = $value['Natregno'];
          //$empinst->FirstName = $row['FirstName'];
          $_GET["RateAmount"] = $empinst->PayRate = $value['RateAmount']; */
        $empinst->RateCode = $value['RateCode'];
        $empinst->PayRate = $value['RateAmount'];
        $empinst->Natregno = $varid = $value['Natregno'];
        $empinst->RoleName = $value['RoleName'];
        $empinst->ForceNumber = $value['ForceNumber'];
        $Employeename = $value['FirstName'] . ' ' . $value['LastName'];
        //$EndDate = $_GET['InspectionDateEnd'];
        $test = new \PfomModel\PayScale();
        //$test->IsRange($StartDate, $EndDate);
        //If date selected isnt a range
        // if (!$test->IsRange($StartDate, $EndDate)) {
        //$wknd = $test->IsWeekend($StartDate);
        //Calculate For Weekend Rates
        if ($test->IsWeekend($StartDate)) {
            $test->GetPayRate($varid, NULL, "WKND");
        } else
        if ($test->IsHoliday($StartDate)) {
            $test->GetPayRate($varid, $StartDate, "HLDY");
        } else
        if ((!$test->IsWeekend($StartDate)) && (!$test->IsHoliday($StartDate))) {
            $test->GetPayRate($varid, NULL, "RGLR");
            //$test->PayRate = $test->GetRegular($empid);
        }
        //}
    }
} else {
    $sql = "SELECT * FROM employee emp WHERE CONCAT_WS(' ',FirstName,LastName) = '" . $q . "'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if (!empty($result)) {
        foreach ($result as $value) {
            $empinst->PayRate = 0;
            $empinst->Natregno = $varid = $value['Natregno'];
            $empinst->RoleName = $value['RoleName'];
            $Employeename = $value['FirstName'] . ' ' . $value['LastName'];
        }
    }
}
$conn = NULL;
?>
<div class="row center-block">
    <div class="row">
        <div class="col-md-12">
            <div class="dashboard-stat dashboard-stat-v2 green" >
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-value="2" id="submitteremployee" style="font-size:medium"    data-counter="counterup" ></span>
                    </div>
                    <div class="desc" id="submitteremployeename"><span class="glyphicon glyphicon-barcode"></span></div>
                    <div class="desc" id="submitterforcenumber"><?php echo $empinst->ForceNumber; ?></div>
                    <div class="desc" id="submitterrolename"><?php echo $empinst->RoleName; ?></div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="dashboard-stat dashboard-stat-v2 blue" >
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span class="glyphicon glyphicon-usd" style="font-size:medium" ></span> <span data-value="2" id="submitterrates" style="font-size: xx-large" data-counter="counterup">0</span>
                    </div>
                    <div class="desc"> Officer Pay Rate</div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info" id="empinfo">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="number" id="hours" name="hours" class="form-control"  placeholder="Hours" >
                        </div>
                        <div class="col-md-4">
                            <label >Acting ?</label>
                        </div>
                        <div class="col-md-4"> 
                            <label class="switch" >
                                <input class="checkbox"  type="checkbox" id="acting" name="acting" >
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group" id="employee">
                        <div class="row">
                            <div class="col-md-12">
                                <label id="lblPost" name="lblPost">Post</label>
                                <select name="RoleName" class="form-control" id="RoleName" onchange="myFunction()">
                                    <option></option>
                                    <?php echo $empinst->GetRoles(); ?>
                                </select>
                                <input type="hidden" name="RateCode" id="RateCode"   />
                                <script>
                                    function myFunction() {
                                        //alert("Hello! I am an alert box!!");
                                        var mylist = document.getElementById("RoleName");
                                        document.getElementById("RateCode").value = mylist.options[mylist.selectedIndex].id;
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label id="lblComments" name="lblComments">Comments</label>
                                <textarea  class="form-control" id="Comments" name="Comments" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="row center-block">
                            <div class="col-xs-3">
                                <input type="hidden" class="form-control" id="Natregno"  name="Natregno" value="<?php echo $empinst->Natregno; ?>">
                            </div>
                            <div class="col-xs-3">
                                <input type="hidden" class="form-control" id="PayRate"  name="PayRate" value="<?php echo PfomModel\PayScale::$PayRate; ?>">
                            </div>
                            <div class="col-xs-3">
                                <input type="hidden" class="form-control" id="RateCode"  name="RateCode" value="<?php echo $empinst->RateCode; ?>">
                                <input type="hidden" class="form-control" id="ForceNumber"  name="ForceNumber" value="<?php echo $empinst->ForceNumber; ?>">
                            </div>
                            <div class="col-xs-3">
                                <input type="hidden" class="form-control" id="EmpName"  name="EmpName" value="<?php echo $Employeename; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>











