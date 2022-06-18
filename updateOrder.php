<?php
if (!empty($_POST)) {
   include 'database_connection.php';
   $conn = getDBconnection();
   extract($_POST);
   $sql = "UPDATE orders SET deliveryAddress='$delAddress',  deliveryDate='$delDate' WHERE orderID='$delID'";
   $conn->query($sql);
}
header("Location: viewOrder.php");