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
</head>
<body>
<?php include "nav.php";?>

<div class="container position-relative" style="min-height: 80vh ">

    <!--Breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item lead" ><a href="#" style="text-decoration: none">Cart</a></li>
            <li class="breadcrumb-item active lead" aria-current="page">Customer Info</li>
        </ol>
    </nav>
    <!--Breadcrumb-->

    <div class="row d-flex align-content-center align-item-center" style="min-height: 30vh">

        <div class="col-md-6 offset-md-3">

            <div class="signup-form">

                <form action="checkoutResult.php" class="mt-5 border p-4 bg-light shadow">

                    <h4 class="mb-3 text-secondary">Customer Information</h4>

                    <div class="row">

                        <!--Customer Name-->
                        <div class="mb-3 col-md-6">
                            <label><span>Customer Name</span></label>
                            <input type="text" name="customername" class="form-control" >
                        </div>

                        <!--Phone Number-->
                        <div class="mb-3 col-md-6">
                            <label><span>Phone Number</span></label>
                            <input type="tel" name="phonenumber" class="form-control">
                        </div>

                        <!--Email address-->
                        <div class="mb-3 col-md-6">
                            <label><span>Email</span></label>
                            <input type="email" name="emailaddress" class="form-control" placeholder="someone@gmail.com">
                        </div>

                        <div class="row">
                            <!--Submit & Reset button-->
                            <div class="d-flex flex-row justify-content-end p-2">
                                <input type="reset" class="btn btn-outline-danger mx-3">
                                <input type="submit" name="checkoutCustomer" class="btn btn-info" value="Proceed to Payment">
                            </div>

                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

    <div class="position-relative col-3 mt-5 mx-auto mb-5 " >
        <div class="progress" style="height: 5px;">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
        <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
        <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">3</button>
    </div>

</div>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>

