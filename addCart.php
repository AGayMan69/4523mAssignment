<?php
session_start();

$received = json_decode(file_get_contents("php://input"), true);
extract($received);
if (!(isset($_SESSION['cart'][$itemID]))){
    $session_array= array(
        "itemID" => $itemID,
        "itemName" => $itemName,
        "stockQuantity" => $stockQuantity,
        "price" => $price,
        "qty" => $qty
    );
    $_SESSION['cart'][$itemID] =  $session_array;
}
echo json_encode($_SESSION['cart']);
