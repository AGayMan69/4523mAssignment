<?php
include 'database_connection.php';

if (isset($_GET['selectDate'])){
    $conn = getDBconnection();
    $targetDate = '%'.$_GET['selectDate'].'%';

    $query =
        "SELECT staffID,staffName,Count(orderID) AS NoOfOrder, SUM(orderAmount) AS OrderAmount FROM staff NATURAL JOIN orders WHERE position='Staff' and dateTime LIKE '$targetDate' GROUP BY staffID;";
    $rs = mysqli_query($conn, $query) or die(mysqli_connect_error());

        //Convert to associate array
    $reportData = array();
    while ($row = mysqli_fetch_assoc($rs)){
        extract($row);

        $reportData[] =[
            'staffID' => $staffID,
            'staffName' => $staffName,
            'NoOfOrder' => $NoOfOrder,
            'OrderAmount' => $OrderAmount,
        ];
    }
    mysqli_free_result($rs);

    //Get the employee that NoOfOrder ==0
    $query =
            "SELECT staffID,staffName FROM staff WHERE position='Staff' AND staffID NOT IN (SELECT staffID FROM orders WHERE dateTime LIKE '$targetDate')";
    $rs = mysqli_query($conn, $query) or die(mysqli_connect_error());

    //Convert to associate array
    while ($row = mysqli_fetch_assoc($rs)){
        extract($row);
        $reportData[] = [
            'staffID' => $staffID,
            'staffName' => $staffName,
            'NoOfOrder' => 0,
            'OrderAmount' => 0,
        ];
    }

    //Sort Associative Arrays by staffID
    $staffIDArray = array();
    foreach ($reportData as $key => $row)
    {
        $staffIDArray[$key] = $row['staffID'];
    }
    array_multisort($staffIDArray, SORT_ASC, $reportData);

    //convert to JSON
    echo json_encode($reportData,JSON_PRETTY_PRINT);

    //Close connection
    mysqli_close($conn);
    //Release result set
    mysqli_free_result($rs);
}











