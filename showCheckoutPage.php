<?php
session_start();

//check the cart is empty
if(!empty($_SESSION['cart'])){

    // Redirect to shipment or customer form page
    if(isset($_POST['checkoutShipment'])){
        //var_dump($_SESSION['cart']);
        header("location:checkoutShipment.php");   # redirect browser to this page

    }elseif(isset($_POST['checkoutCustomer'])){
        //var_dump($_SESSION['cart']);
        header("location:checkoutCustomer.php"); # redirect browser to this page
    }
}

