<!DOCTYPE html>
<?php
include '../../../../dbconfig.php';
include '../../../../Classes/Equipment.php';

$q = $_GET['q'];
$conn = conn();

$sql = "SELECT * FROM equipment  WHERE ItemName = '" . $q . "' AND DelFlg='N'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$equipinst = new PfomModel\Equipment();
$PayRate;
if (!empty($result)) {
    foreach ($result as $value) {
        $equipinst->ItemName = $value['ItemName'];
        $equipinst->UnitCost = $value['UnitCost'];
        $equipinst->UnitMeasurement = $value['UnitMeasurement'];
        $equipinst->EquipmentId = $value['EquipmentId'];
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
                        <span data-value="2" id="submittersupport" style="font-size:medium"    data-counter="counterup" ></span>
                    </div>

                    <div class="desc" id="submittername"><?php echo $equipinst->ItemName; ?></div>
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
                        <span class="glyphicon glyphicon-usd" style="font-size:medium" ></span> <span data-value="2" id="submitterrates" style="font-size: xx-large" data-counter="counterup"><?php echo $equipinst->UnitCost; ?></span>
                    </div>
                    <div class="desc" id="submitterunitmeasurement">per <?php echo $equipinst->UnitMeasurement; ?></div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info" id="equipinfo">
                <div class="panel-heading"><h4>Resource</h4></div>
                <div class="panel-body">
                    <div class="form-group" id="equipment">
                        <div class="row">
                            <div class="col-md-6">
                                <label> Resources</label> 
                                <input type="number" id="opsuppamt" name="opsuppamt" class="form-control" autocomplete="off" placeholder="Enter resource amount" required>
                            </div>  <div class="col-md-6">

                            </div>
                        </div>
                        <div class="row center-block">
                            <div class="col-xs-3">
                                <input type="hidden" class="form-control" id="ItemId"  name="ItemId" value="<?php echo $equipinst->EquipmentId; ?>">
                                <input type="hidden" class="form-control" id="UnitCost"  name="UnitCost" value="<?php echo $equipinst->UnitCost; ?>">
                                <input type="hidden" class="form-control" id="ItemName"  name="ItemName" value="<?php echo $equipinst->ItemName; ?>">
                                <input type="hidden" class="form-control" id="unitmeasurement"  name="unitmeasurement" value="<?php echo $equipinst->UnitMeasurement; ?>">
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>










