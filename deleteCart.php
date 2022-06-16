<?php
session_start();
if (isset($_POST['removeItemID']) && isset($_SESSION['cart'])){
    unset($_SESSION['cart'][$_POST['removeItemID']]);
}
header("location:placeOrder.php");
