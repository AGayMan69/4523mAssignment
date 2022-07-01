<?php
session_start();
include 'database_connection.php';



//Empid & Discount is hard coding *******
//unset Session['cart'] in line 263 *******

//var_dump($_POST);
//var_dump($_SESSION['cart']);

//Retrieve new order id
function GetNewOrderID($conn){

    //$query = "SELECT IFNULL(max(orderID), 0)+1  AS nextid FROM orders";
    $query ="SELECT IFNULL(MAX(CAST(orderID AS int)), 0)+1 AS nextid FROM orders";

    $rs = mysqli_query($conn, $query) or die(mysqli_connect_error());
    while ($rc=mysqli_fetch_assoc($rs)){
        extract($rc);
        mysqli_free_result($rs);
        return $nextid;
    }
    return null;
}

// Receive the $_POST FROM checkoutCustomer.php / checkoutShipment.php
if(isset($_POST['checkoutForResult'])){

    if (isset($_SESSION['cart'])){

        $conn = getDBconnection();
        $newOrderId = GetNewOrderID($conn);
        $orderCreateDate = date("Y/m/d");
        $discount = $_SESSION['discountRate'];
        $current_user = $_SESSION['User']['ID'];

        //customername,phonenumber,emailaddress,customeraddress,deliverydat,checkoutForResult
        extract($_POST);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    <!--Bootstrap CSS-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

</head>
<body>
<?php include "nav.php";?>

<div class="container py-2">


    <!--Breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item lead" ><a href="#" style="text-decoration: none">Cart</a></li>
            <li class="breadcrumb-item active lead" aria-current="page">New Order</li>
        </ol>
    </nav>
    <!--Breadcrumb-->

    <div class="row">

        <div class="col-md-8 offset-md-2">

            <div class="card p-4">

                <div class="card-body mb-3">
                    <h5 class="card-title text-left">Order ID# <span><?=$newOrderId?></span></h5>
                    <p class="card-text text-center" ><i class="bi bi-check-circle-fill" style="font-size:5em;"></i>.</p>
                    <h2 class="card-text text-center">Transaction successful</h2>
                    <p class="card-text text-center"><small class="text-muted">Order Date: <?=$orderCreateDate?></small></p>
                </div>

                <!--Progress Bar-->
                    <div class="position-relative mt-5 mx-4 mb-5">
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                        <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                        <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">3</button>
                    </div>
                <!--Progress Bar-->


                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="col-md-1">#</th>
                        <th scope="col" class="col-md-7">Name</th>
                        <th scope="col" class="col-md-2">Quantity</th>
                        <th scope="col" class="col-md-1">Total</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php

                    $orderAmount =0;
                    $itemCount = 1;
                    $itemList = array();

                    //Return an array to hold all item and total price
                    foreach ($_SESSION['cart'] as $items){
                        extract($items);

                        $itemList[$itemCount]["itemID"] = $itemID;
                        $itemList[$itemCount]["qty"] = $qty;
                        $orderAmount += $itemList[$itemCount]["soldPrice"] = $qty*$price;

                    ?>
                    <!--column will insert here-->
                    <tr>
                        <th scope="row"><?=$itemCount?></th>
                        <td><?=$itemName?></td>
                        <td><?=$qty?></td>
                        <td><?=$qty*$price?></td>
                    </tr>

                    <!--column will insert here-->

                    <?php
                        $itemCount++;
                    }
//                    var_dump($itemList);

                    ?>

                    </tbody>
                </table>

                <hr class="my-2">

                <div class="row">


                    <div class="card-body col-4 ">
                        <h6 class="card-title">Customer name</h6>
                        <p class="card-text" id="name"><?=$customername?></p>
                    </div>


                    <div class="card-body col-3">
                        <h6 class="card-title">Phone</h6>
                        <p class="card-text" id="phone"><?= $phonenumber?></p>
                    </div>

                    <div class="card-body col-4">
                        <h6 class="card-title">Email</h6>
                        <p class="card-text" id="email"><?= $emailaddress?></p>
                    </div>

                    <?php

                    if(isset($_POST['deliverydate'])){
                    ?>

                    <div class="card-body col-3">
                        <h6 class="card-title">Shipping date</h6>
                        <p class="card-text" id="shippingDate"><?=$deliverydate?></p>
                    </div>

                    <div class="card-body col-9">
                        <h6 class="card-title">Address</h6>
                        <p class="card-text" id="address"><?=$customeraddress?></p>
                    </div>
                    </div>

                <?php
                    }
                ?>


<!--                <div class="row">-->
<!---->
<!--                    <div class="col-12 my-1">-->
<!---->
<!--                            <div class="fw-semibold">Delivery Date</div>-->
<!--                            <span >0</span>-->
<!---->
<!--                    </div>-->
<!---->
<!--                    <div class="col-12">-->
<!--                        <div class="fw-semibold">Delivery Date</div>-->
<!--                        <span>0</span>-->
<!--                    </div>-->
<!--                </div>-->


                <!-- Display total price-->
                <div class="order my-5">
                    <div class="d-flex flex-row justify-content-between  mx-3">
                        <h6>Subtotal</h6>
                        <span id="subTotal">HK$<?=$orderAmount?></span>
                    </div>

                    <div class="d-flex flex-row justify-content-between  mx-3">
                        <h6>Discount</h6>
                        <span id="discount">-<?=$orderAmount * $discount?></span>
                    </div>

                    <div class="d-flex flex-row justify-content-between  mx-3">
                        <h6>Total</h6>
                        <span id="total"><?=$orderAmount * (1-$discount)?></span>
                    </div>
                </div>
                <?php

                //INSERT NEW ORDER TO DB

                //Retrieve Customer information
                //extract($_POST);
                //Check customer exist
                $sql = "SELECT * FROM customer WHERE customerEmail ='$emailaddress'";
                mysqli_query($conn, $sql) or die (mysqli_error($conn));

                //No record found in mysql -> add new customer
                if (mysqli_affected_rows($conn)==0){
                    $sql = "INSERT INTO customer VALUES ('$emailaddress','$customername','$phonenumber')";
                    mysqli_query($conn, $sql) or die (mysqli_error($conn));

                }else{
                    //Check Customer information match
                    $sql = "SELECT * FROM customer WHERE customerEmail ='$emailaddress' AND customerName='$customername' AND phoneNumber='$phonenumber'";
                    mysqli_query($conn, $sql) or die (mysqli_error($conn));

                    //Return 0 = customerinfo is different from original
                    if (mysqli_affected_rows($conn)==0){
                        $sql = "UPDATE customer SET customerName='$customername',phoneNumber='$phonenumber' WHERE customerEmail ='$emailaddress'";
                        mysqli_query($conn, $sql) or die (mysqli_error($conn));
                    }
                }

                //Insert to orders table
                $sql = "INSERT INTO orders VALUES ";
                $new_Price = $orderAmount*(1-$discount);
                if (isset($_POST['deliverydate'])){
                    $sql.= "('$newOrderId','$emailaddress','$current_user',NOW(),'$customeraddress','$deliverydate','$new_Price')";
                }else{
                    $sql.= "('$newOrderId','$emailaddress','$current_user',NOW(),NULL,NULL,'$new_Price')";
                }
                mysqli_query($conn, $sql) or die (mysqli_error($conn));
                $result = mysqli_affected_rows($conn);

                //Insert itemorders to DB
                if($result!=0){
                    foreach ($itemList as $items){
                        extract($items);

                        $sql= "INSERT INTO itemorders VALUES('$newOrderId','$itemID','$qty','$soldPrice')";
                        mysqli_query($conn, $sql) or die (mysqli_error($conn));

                        //Update qty after create itemorders
                        if (mysqli_affected_rows($conn)!=0){

                            $newStockQuantity = $_SESSION['cart'][$itemID]['stockQuantity'] - $qty;

//                            echo "butQty: $qty \n";
//                            echo "itemorignalQty: {$_SESSION['cart'][$itemID]['stockQuantity']} \n";
//                            echo "newStockQuantity: $newStockQuantity \n";

                            $sql = "UPDATE item SET stockQuantity='$newStockQuantity' WHERE itemID ='$itemID'";
                            mysqli_query($conn, $sql) or die (mysqli_error($conn));
                        }
                    }
                }

                unset($_SESSION['cart']);
                unset($_SESSION['discountRate']);
                mysqli_close($conn);

            }
        }
                ?>

                <!-- Display total price-->
                <form action="placeOrder.php">
                    <div class="d-grid gap-2 col-4 mx-auto">
                        <button type="submit"  class="btn btn-outline-dark" >BACK</button>
                    </div>
                </form>
                <!-- Display total price-->


<!--                <div class="progress position-absolute bottom-0 start-0 w-100 " style="height:10px">-->
<!---->
<!--                    <div class="progress-bar w-100" role="progressbar"  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" ></div>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</div>

    <!--Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</body>
</html>
