<?php

include '../../../../dbconfig.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
  server with default setting (user 'root' with no password) */
//$link = mysqli_connect("localhost", "root", "", "demo");
$type = $_GET['type'];
$conn = conn();

if (isset($_REQUEST['term'])) {
    // Prepare a select statement
    //$sql = "SELECT CONCAT_WS(' ',ItemName,ItemName) FROM employee WHERE ItemName LIKE ?";
    if ($type == 'name') {
        $sql = 'SELECT * FROM account WHERE AccountName LIKE ? AND DelFlg="N"';
    } else
    if ($type == 'equipmentid') {
        $sql = 'SELECT * FROM account WHERE AccountId LIKE ? AND DelFlg="N"';
    }

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        // Set parameters
        $param_term = $_REQUEST['term'] . '%';
        $stmt->bindParam(1, $param_term, PDO::PARAM_STR);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();

            // Check number of rows in the result set
            if (!empty($result)) {
                // Fetch result rows as an associative array
                foreach ($result as $value) {
                    echo "<p><strong>" . $value["AccountName"] . "</strong></p>";
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
}
// Close onnection
$conn = NULL;
?>
