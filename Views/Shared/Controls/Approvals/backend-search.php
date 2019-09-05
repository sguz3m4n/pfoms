<?php

//include '../../../../dbconfig.php';
//$type = $_GET['type'];
$conn = conn();


$sql = "SELECT event.`EventId`,`EventName`,`CompanyName`,`ContactName`,`ContactEmail`,`ContactNumber`,`EventDateStart`,`EventDateEnd`,proforma.EventCOst "
        . "FROM`event` as event ,`proforma` as proforma WHERE "
        . "event.EventId=proforma.EventId AND "
        . "event.Status!='Approved' AND "
        . "event.DelFlg='N'";
if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    // Set parameters
//        $param_term = '%' . $_REQUEST['term'] . '%';
//        $stmt->bindParam(1, $param_term, PDO::PARAM_STR);
    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $result = $stmt->fetchAll();

        // Check number of rows in the result set
        if (!empty($result)) {
            // Fetch result rows as an associative array
            foreach ($result as $value) {
                echo '<div class="dashboard-stat dashboard-stat-v2 yellow tiles" data-id="' . $value["EventId"] . '" id="' . $value["EventId"] . '">
                                        <div class="visual">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span  style="font-size: xx-large" data-counter="counterup"></span>
                                            </div>
                                            <div class="desc"> ' . $value["EventName"] . ' </div>
                                        </div>
                                    </div>';
            }
        } else {
            echo "<p>No matches found</p>";
        }
    } else {
        echo "ERROR: Not able to execute $sql. " . mysqli_error($conn);
    }
}

// Close statement

$conn = NULL;


// close connection

$conn = NULL;
?>
