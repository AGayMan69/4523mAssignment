<?php

//Remove item function
//Purchase function
//Delivery checkbox

session_start();
if (!isset($_SESSION['User']) ) {
    header("Location: index.php");
//    echo "Heading to index";
}else if ($_SESSION['User']['Position'] != "Staff") {
    header("Location: salesReport.php");
//    echo "Heading salesReport";
}

include "database_connection.php";


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body>
<?php
include "nav.php"?>
<div class="container" xmlns="http://www.w3.org/1999/html">



    <!--Breadcrumb-->
<!--    <nav aria-label="breadcrumb">-->
<!--        <ol class="breadcrumb py-2">-->
<!--            <li class="breadcrumb-item active lead" aria-current="page">Cart</li>-->
<!--        </ol>-->
<!--    </nav>-->
    <!--Breadcrumb-->

    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <div class="col-md-12">
        <div class="row text-center">
            <div class="col-md-6">
                <h2 class="text-center py-3">Item List</h2>
                <div class="col-md-12">
                    <div class="row">
                        <?php
                        $query ="SELECT * FROM item";
                        $conn = getDBconnection();
                        $rs = mysqli_query($conn,$query);

                        while ($row = mysqli_fetch_assoc($rs)){
                            // $itemID $itemName $itemDescription $stockQuantity $price
                            extract($row);
                            ?>

                            <!--CARD-->
                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-self-stretch py-2">
                                <div class="card shadow-sm mb-4">
                                    <!--Product Image-->
                                    <img src="images/products/<?=$itemID?>.png" class="card-img-top" alt="">
                                    <div class="card-body d-flex flex-column">
                                        <!--Product Name-->
                                        <h6 class="card-title text-uppercase"><?=$itemName?></h6>
                                        <p class="text-muted"></p>
                                        <div class="mt-auto border border-white ">
                                            <!--Price tag-->
                                            <p class="text-uppercase mb-0 py-2">HK$<?=$price?></p>

                                            <!--Page anchor #form-anchor id="form-anchor"-->
                                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="addCarti<?=$itemID?>" >

                                                <!--Hidden element-->
                                                <input type="hidden" name="itemID" value="<?=$itemID?>">
                                                <input type="hidden" name="itemName" value="<?=$itemName?>">
                                                <input type="hidden" name="price" value="<?=$price?>">
                                                <input type="hidden" name="stockQuantity" value="<?=$stockQuantity?>">
                                                <!--Hidden element-->

                                                <!--Submit button-->

                                                <?php

                                                    if ($stockQuantity==0){
                                                        echo '<input type="button" class="btn btn-secondary " value="Out Of Stock" disabled>';
                                                    }else{
                                                        echo '<input type="button" class="btn btn-warning " name="addToCart" value="Add To Cart" onclick="addtoCart(this)">';
                                                    }
                                                ?>
                                                <!--<i class="fas fa-shopping-cart"></i>-->
                                                <!--</input>-->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!--Card top margin-->
                <div class="py-2"></div>

                <div class="card py-3">
                    <div class="d-flex flex-row justify-content-start p-4">
                        <h1>Shopping Cart</h1>
                    </div>

                    <div class="table-responsive" >
                        <table class="shopping_cart table table-bordered">
                            <tr>
                                <th class="w-40">Name</th>
                                <th class="w-5">Quantity</th>
                                <th class="w-20">Price</th>
                                <th class="w-20">Total</th>
                                <th class="w-5">&nbsp</th>
                            </tr>

                            <?php
                            if(!empty($_SESSION['cart']))
                            {
                                $amount=0;
//                                var_dump($_SESSION['cart']);
                                foreach ($_SESSION['cart'] as $items){
                                    extract($items);
                                    // $itemID $itemName $itemDescription $stockQuantity $price
                                    ?>
                                    <tr class="itemRow<?=$itemID?>">
                                        <td>
                                            <?=$itemName?>
                                        </td>

                                        <td>
                                            <input type="hidden"  name="itemID" value="<?=$itemID?>">
                                            <input type="number" class="itemqty" name="buyqty" min="1" max="<?=$stockQuantity?>" value="<?=$qty?>"  onchange="updateQuantity(<?=$itemID?>,this)">
                                        </td>

                                        <td>$<?=$price?>
                                            <input type="hidden" class="itemprice" value="<?=$price?>">
                                        </td>

                                        <td class="itemamount">
                                           $<?=$price*$qty?>
                                        </td>

                                        <td>
                                            <form method="post" action="deleteCart.php">
                                                <input type="hidden" name="removeItemID" value="<?=$itemID?>">
                                                <input type="submit" name="removeItem" class="btn btn-sm btn-danger btn-block" value="REMOVE">
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } ?>
                        </table>

                        <!-- Display total price-->
                        <div class="order">
                            <div class="d-flex flex-row justify-content-between p-3 mx-3">
                                <span>Subtotal</span>
                                <span  id="subTotalSpan">0</span>
                            </div>

                            <div class="d-flex flex-row justify-content-between p-3 mx-3">
                                <span>Discount</span>
                                <span id="differenceSpan">-0</span>
                            </div>

                            <div class="d-flex flex-row justify-content-between p-3 mx-3">
                                <span>Total</span>
                                <span id="newTotalSpan">0</span>
                            </div>

                            <div class="d-flex flex-row justify-content-end p-5">
                            <!--    <button class="btn btn-primary mx-2">Enter Shipment Details</button>-->
                                <form action="showCheckoutPage.php" method="post">
                                    <input type="submit" name="checkoutShipment" class="btn btn-primary mx-2" value="Enter Shipment Details">
                                    <input type="submit" name="checkoutCustomer" class="btn btn-primary" value="Proceed to Payment">
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- Display total price-->
                </div>

                <!--Progress Bar-->
                <div class="position-relative mt-5 mx-4 mb-5">
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                    <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                    <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">3</button>
                </div>
                <!--Progress Bar-->

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript" src="src/placeOrder.js"></script>
<script type="text/javascript" src="src/getOrderTotal.js"></script>
</body>
</html>







