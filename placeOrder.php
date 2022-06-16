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
    <title>Document</title>
</head>
<body>
<?php
include "nav.php"?>
<div class="container" xmlns="http://www.w3.org/1999/html">



    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Cart</a></li>
        </ol>
    </nav>

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
                                                <input type="button" class="btn btn-warning " name="addToCart" value="Add To Cart" onclick="addtoCart(this)">
<!--                                                <i class="fas fa-shopping-cart"></i>-->
<!--                                                </input>-->
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
                        <span><h1>Shopping Cart</h1></span>
                    </div>

                    <div class="table-responsive">
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
                                            <input type="number" class="itemqty" name="buyqty" min="1" max="<?=$stockQuantity?>" value="<?=$qty?>"   onchange="updateQuantity(<?=$itemID?>,this)">
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
                                <span  id="subTotalSpan">XXX</span>
                            </div>

                            <div class="d-flex flex-row justify-content-between p-3 mx-3">
                                <span>Discount</span>
                                <span>-0</span>
                            </div>

                            <div class="d-flex flex-row justify-content-between p-3 mx-3">
                                <span>Total</span>
                                <span>0</span>
                            </div>
                            <div class="d-flex flex-row justify-content-end p-5">
                                <button class="btn btn-primary mx-2">Enter Shipment Details</button>
                                <input type="submit" name="checkout" class="btn btn-primary" value="Proceed to Payment">
                            </div>
                        </div>
                    </div>
                    <!-- Display total price-->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="src/placeOrder.js"></script>
</body>
</html>







