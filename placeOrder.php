<?php

//Remove item function
//Purchase function
//Delivery checkbox

session_start();

include "database_connection.php";



//Add item to cart
if(isset($_POST['addToCart'])){

    if(isset($_SESSION['cart'])){

        //Returns all itemID from current session
        $itemID_array = array_column($_SESSION['cart'],"itemID");

        //Check new itemid existing or not
        if(!in_array($_POST['itemID'],$itemID_array)){

            $session_array= array(

                "itemID" => $_POST['itemID'],
                "itemName" => $_POST['itemName'],
                "stockQuantity" => $_POST['stockQuantity'],
                "price" => $_POST['price'],
            );
            $_SESSION['cart'][] =  $session_array;
        }
    }else{

        $session_array= array(
                "itemID" => $_POST['itemID'],
                "itemName" => $_POST['itemName'],
                "stockQuantity" => $_POST['stockQuantity'],
                "price" => $_POST['price'],
        );
        $_SESSION['cart'][] =  $session_array;
    }
}

////Remove item from cart
//if(isset($_POST['removeItem'])){
//
//    foreach ($_SESSION['cart'] as $key => $value){
//        if($value['itemID'] == $_POST['itemID']){
//            unset($_SESSION['cart'][$key]);
//        }
//    }
//}

if(isset($_POST['removeItem'])){
    foreach ($_SESSION['cart'] as $key => $value){

        if($value['itemID'] == $_POST['removeitemID']){
            unset($_SESSION['cart'][$key]);
        }
    }
}


////Update item qty when input change
//if(isset($_POST['qtyChange'])){
//
//    foreach ($_SESSION['cart'] as $key => $value){
//        if($value['itemID'] == $_POST['itemID']){
//            $_SESSION['cart'][$key]['buyqty'] =$_POST['qtyChange'];
//            var_dump($_SESSION['cart'][$_POST['itemID']]);
//        }
//    }
//}

if(isset($_POST['qtyChange'])){
    var_dump($_POST);
}
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
<?php include "nav.php";?>
<div class="container" xmlns="http://www.w3.org/1999/html">
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
                                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >

                                                <!--Hidden element-->
                                                <input type="hidden" name="itemID" value="<?=$itemID?>">
                                                <input type="hidden" name="itemName" value="<?=$itemName?>">
                                                <input type="hidden" name="price" value="<?=$price?>">
                                                <input type="hidden" name="stockQuantity" value="<?=$stockQuantity?>">
                                                <!--Hidden element-->

                                                <!--Submit button-->
                                                <input type="submit" class="btn btn-warning " name="addToCart" value="Add To Cart">
                                                <i class="fas fa-shopping-cart"></i>
                                                </input>
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
                        <table class="table table-bordered">
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
                                foreach ($_SESSION['cart'] as $key => $values){
                                    extract($values);
                                    // $itemID $itemName $itemDescription $stockQuantity $price
                                    ?>
                                    <tr>
                                        <!--Item Name & hidden itemID -->
                                        <td>
                                            <?=$itemName?>
                                        </td>

                                        <!--customer buy qty-->
                                        <td>

                                            <input type="hidden"  name="itemID" value="<?=$itemID?>">
                                            <input type="number" class="itemqty" name="buyqty" min="1" max="<?=$stockQuantity?>" value="1" onclick="calAmount()" onchange="getValue(<?=$itemID?>,this)">

                                        </td>

                                        <!--unit price-->
                                        <td>HK$<?=$price?>
                                            <input type="hidden" class="itemprice" value="<?=$price?>">
                                        </td>

                                        <!--total price =  buyqty * unit price-->
                                        <td class="itemamount">
                                            0
                                        </td>

                                        <!--REMOVE button-->
                                        <td>
                                            <input type="hidden" name="removeitemID" value="<?=$itemID?>">
                                            <input type="submit" name="removeItem" class="btn btn-sm btn-danger btn-block" value="REMOVE">
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
</body>
</html>







