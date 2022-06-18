<?php
if (!empty($_POST)) {
    include 'database_connection.php';
    $conn = getDBconnection();
    extract($_POST);
    var_dump($_POST);

    $sql = "DELETE FROM itemorders where orderID='$targetID'";
    $conn->query($sql);
    $sql = "DELETE FROM orders where orderID='$targetID'";
    $conn->query($sql);
}
header("Location: viewOrder.php");
