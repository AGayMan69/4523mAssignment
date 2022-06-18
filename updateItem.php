<?php
//var_dump($_POST);
if (!empty($_POST)) {
    include 'database_connection.php';
    $conn = getDBconnection();
    extract($_POST);
    $sql = "UPDATE item SET itemName='$name',  itemDescription='$description', stockQuantity='$quantity', price='$price' WHERE itemID='$itemID'";
    $conn->query($sql);
}
header("Location: viewOrder.php");
