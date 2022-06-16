<?php
session_start();
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

</head>
<body>
<?php include "nav.php";?>

<div class="container">


    <!--Breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item lead" ><a href="#">Cart</a></li>
            <li class="breadcrumb-item active lead" aria-current="page">Customer Info</li>
        </ol>
    </nav>
    <!--Breadcrumb-->

    <div class="row">

        <div class="col-md-8 offset-md-2">

            <div class="card p-4">

                <div class="card-body mb-3">

                    <h5 class="card-title text-left">Order ID #1</h5>
                    <p class="card-text text-center" ><i class="bi bi-check-circle-fill" style="font-size:5em;"></i>.</p>
                    <h2 class="card-text text-center">Transaction successful</h2>

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

                    <!--column insert here-->

<!--                    <tr>-->
<!--                        <th scope="row">1</th>-->
<!--                        <td>NOVEL NF4091 9”All-way Strong Wind Circulation Fan</td>-->
<!--                        <td>Otto</td>-->
<!--                        <td>@mdo</td>-->
<!--                    </tr>-->
<!---->
<!--                    <tr>-->
<!--                        <th scope="row">1</th>-->
<!--                        <td>NOVEL NF4091 9”All-way Strong Wind Circulation Fan</td>-->
<!--                        <td>Otto</td>-->
<!--                        <td>@mdo</td>-->
<!--                    </tr>-->
                    </tbody>
                </table>

                <hr class="my-2">

                <div class="row">

                    <div class="col-12 my-1">

                            <div class="fw-semibold">Delivery Date</div>
                            <span >0</span>

                    </div>

                    <div class="col-12">
                        <div class="fw-semibold">Delivery Date</div>
                        <span>0</span>
                    </div>

                </div>


                <!-- Display total price-->
                <div class="order my-5">
                    <div class="d-flex flex-row justify-content-between  mx-3">
                        <h6>Subtotal</h6>
                        <span id="subTotal">XXX</span>
                    </div>

                    <div class="d-flex flex-row justify-content-between  mx-3">
                        <h6>Discount</h6>
                        <span id="discount">-0</span>
                    </div>

                    <div class="d-flex flex-row justify-content-between  mx-3">
                        <h6>Total</h6>
                        <span id="total">0</span>
                    </div>

                </div>
                <!-- Display total price-->

                <form action="" method="post">
                    <div class="d-grid gap-2 col-4 mx-auto">
                            <button type="submit" name="back" class="btn btn-outline-dark" >BACK</button>
                    </div>
                </form>


<!--                <div class="progress position-absolute bottom-0 start-0 w-100 " style="height:10px">-->
<!---->
<!--                    <div class="progress-bar w-100" role="progressbar"  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" ></div>-->
<!--                </div>-->


            </div>
    </div>
</div>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
