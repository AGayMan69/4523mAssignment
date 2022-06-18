<?php
if (!empty($_POST)) {
    include 'database_connection.php';
    $conn = getDBconnection();
    extract($_POST);
    $sql = "DELETE it FROM itemorders it INNER JOIN orders o ON o.orderID=it.orderID WHERE o.customerEmail='$targetID'";
    $conn->query($sql);
    $sql = "DELETE FROM orders WHERE customerEmail='$targetID'";
    $conn->query($sql);
    $sql = "DELETE FROM customer where customerEmail='$targetID'";
    $conn->query($sql);
}
header("Location: customers.php");
