<?php
//var_dump($_POST);
if (!empty($_POST)) {
    include 'database_connection.php';
    $conn = getDBconnection();
    extract($_POST);
    $sql = "INSERT INTO item (itemName, itemDescription, stockQuantity, price) VALUES ('$name', '$description', '$quantity', '$price')";
    $conn->query($sql);
}
header("Location: items.php");
