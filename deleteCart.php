<?php
session_start();

var_dump($_POST['removeItemID']);
var_dump($_SESSION['cart']);
if (isset($_POST['removeItemID']) && isset($_SESSION['cart'])){
    unset($_SESSION['cart'][$_POST['removeItemID']]);
    var_dump($_SESSION['cart']);
}
//if(isset($_POST['removeItem']) && isset($_SESSION['cart'])){
//    var_dump($_POST['removeItem']);
//    foreach ($_SESSION['cart'] as $key => $value){
//        if($value['itemID'] == $_POST['removeitemID']){
//            unset($_SESSION['cart'][$key]);
//            unset($_POST['removeItem']);
//        }
//    }
//    var_dump($_POST['removeitemID']);
//}
//header("location:placeOrder.php");
