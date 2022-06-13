<?php

//Remove item function
//Purchase function
//Delivery checkbox

session_start();

include "connection.php";
include "nav.php";

if(isset($_POST['addToCart'])){

    if(isset($_SESSION['cart'])){

        //Returns all itemID from current session
        $itemID_array = array_column($_SESSION['cart'],"itemID");

        //Check new itemid or not
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

?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row text-center">
                <div class="col-md-6">
                    <h2 class="text-center py-3">Item List</h2>
                    <div class="col-md-12">
                        <div class="row">
                    <?php
                    $query ="SELECT * FROM item";
                    $rs = mysqli_query($con,$query);

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
                                        <p class="text-uppercase mb-0 py-1">$<?=$price?></p>

                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

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
                    <h2 class="text-center py-3">Order Details</h2>
                    <div class="table-responsive">

                        <form action="">
                        <table class="table table-bordered">
                            <tr>
                                <th class="w-40">Product Name</th>
                                <th class="w-10">Qty</th>
                                <th class="w-20">Price</th>
                                <th class="w-15">Total</th>
                                <th class="w-5">Action</th>
                            </tr>
                            <?php
                            if(!empty($_SESSION['cart'])){
                                $amount=0;
                                foreach ($_SESSION['cart'] as $key => $values){
                                    extract($values);
                                    // $itemID $itemName $itemDescription $stockQuantity $price
                            ?>
                                    <tr>
                                        <!--Item Name-->
                                        <td><?=$itemName?></td>
                                        <!--customer buy qty-->
                                        <td><input type="number" class="itemqty" min="0" max="<?=$stockQuantity?>" onclick="calAmount()" onchange="calAmount()"></td>

                                        <!--unit price-->
                                        <td>$<?=$price?><input type="hidden" class="itemprice" value="<?=$price?>"></td>

                                        <!--total price =  buyqty * unit price-->
                                        <td class="itemamount">0</td>
                                        <!--Action-->
                                        <td>
                                            <form action="removeCart" method="post">
                                                <button name="Remove" class="btn btn-sm btn-danger">REMOVE</button>
                                                <input type="hidden" name="remove_item" value="<?=$itemID?>">
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                            <!-- Display total price-->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total</h5>
                                    <p class="card-text" id="cartTotal">0</p>
                                    <a href="#" class="btn btn-primary">PURCHASE</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



