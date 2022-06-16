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
    <title>Document</title>

<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
</head>
<body>
<?php include "nav.php";?>


<div class="container d-flex align-content-center align-items-center" style="min-height:80vh">

    <div class="card col-8 offset-2">

        <h2 class="my-5 h2">XXXXXXXXXXXXXXXXXXX</h2>
        <p>XXXXXXXXXXXXXX</p>

        <!-- Extended material form grid -->
        <form>
            <!-- Grid row -->
            <div class="form-row">
                <!-- Grid column -->
                <div class="col-md-6">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="email" class="form-control" id="inputEmail4MD" placeholder="Email">
                        <label for="inputEmail4MD">Email</label>
                    </div>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="password" class="form-control" id="inputPassword4MD" placeholder="Password">
                        <label for="inputPassword4MD">Password</label>
                    </div>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->

            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-12">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="text" class="form-control" id="inputAddressMD" placeholder="1234 Main St">
                        <label for="inputAddressMD">Address</label>
                    </div>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-12">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="text" class="form-control" id="inputAddress2MD" placeholder="Apartment, studio, or floor">
                        <label for="inputAddress2MD">Address 2</label>
                    </div>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->

            <!-- Grid row -->
            <div class="form-row">
                <!-- Grid column -->
                <div class="col-md-6">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="text" class="form-control" id="inputCityMD" placeholder="New York City">
                        <label for="inputCityMD">City</label>
                    </div>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6">
                    <!-- Material input -->
                    <div class="md-form form-group">
                        <input type="text" class="form-control" id="inputZipMD" placeholder="11206-1117">
                        <label for="inputZipMD">Zip</label>
                    </div>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
            <button type="submit" class="btn btn-primary btn-md">Sign in</button>
        </form>
        <!-- Extended material form grid -->
    </div>
</div>
</body>
</html>
