<?php
include 'database_connection.php';

//Mysql statement to retrieve all staff monthly report
$conn = getDBconnection();
$query =
    "SELECT staffID,staffName,Count(orderID) AS NoOfOrder , SUM(orderAmount) AS OrderAmount FROM staff NATURAL JOIN orders GROUP BY staffID;";
$rs = mysqli_query($conn, $query) or die(mysqli_connect_error());

//Convert to associate array
$reportData = array();
while ($row = mysqli_fetch_array($rs)){
    $reportData[] = $row;
}
//convert to JSON
echo json_encode($reportData,JSON_PRETTY_PRINT);

//Close connection
mysqli_close($conn);
//Release result set
mysqli_free_result($rs);
