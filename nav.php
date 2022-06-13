<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Order</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">

    <script>
        //Return an array which hold all the element from orderdetail
        var itemprice = document.getElementsByClassName('itemprice');
        var itemqty = document.getElementsByClassName('itemqty');
        var itemamount = document.getElementsByClassName('itemamount');
        var totalPrice = 0;

        function calAmount(){
            totalPrice=0;
            for (i=0;i<itemprice.length;i++){
                itemamount[i].innerText = (itemprice[i].value)*(itemqty[i].value);
                totalPrice+=(itemprice[i].value)*(itemqty[i].value);
            }
            document.getElementById('cartTotal').innerText = totalPrice;
        }
    </script>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-warning">

    <div class="container-fluid">

        <!--LOGO IMAGE-->
        <a class="navbar-brand" href="#"><img src="images/bltdLogo.png" class="w-100" alt=""></a>

        <ul class="navbar-nav ms-auto mb-0 mb-lg-o">

            <!--Make Order-->
            <li class="nav-item ">
                <a class="nav-link h5 text-white" href="#">Make Order</a>
            </li>
            <!--View Order-->
            <li class="nav-item">
                <a class="nav-link h5 text-white" href="#">View Order</a>
            </li>
            <!--Items-->
            <li class="nav-item">
                <a class="nav-link h5 text-white" href="#">Items</a>
            </li>
            <!--Report-->
            <li class="nav-item">
                <a class="nav-link h5 text-white" href="#">Report</a>
            </li>
        </ul>
    </div>
</nav>
<!-- Navbar -->
