<?php
session_start();
if (!isset($_SESSION['User']) ) {
    header("Location: index.php");
}
if ($_SESSION['User']['Position'] != "Manager") {
    header("Location: placeOrder.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <style>
        .staff-card {
            transition: transform 400ms cubic-bezier(.35,2.24,.61,.65);
            min-width: min(95%, 65em);
        }
        .staff-card:hover{
           transform: scale(1.02);
        }
    </style>
</head>
<body style="background-color: hsl(189, 15%, 90%)">
<?php
include "nav.php";
?>
    <div class="container d-flex flex-column align-items-center bg-light p-5" style="min-height: 90vh">
        <h1 class="display-3">
            Monthly Report
        </h1>
        <div class="staff-card row my-5 shadow-lg p-5 bg-dark text-light rounded-5">
            <div class="col-md-6">
                <div class="row justify-content-md-start justify-content-center" style="padding: 0; margin: 0">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg"
                         class="rounded-circle col-12 mb-4 shadow" alt=""
                         style="max-width: 12em; padding: 0"
                    >
                    <div class="col-12 display-5 text-nowrap mb-2 text-md-start text-center" style="padding: 0">Chan Tai Man</div>
                    <div class="col-12 fs-5 fw-light text-nowrap text-md-start text-center" style="padding: 0">Staff ID: s0001</div>
                </div>
            </div>
            <div class="col">
                <div class="row mt-4 mb-5">
                    <div class="col-12" style="padding: 0">
                       <div class="row">
                            <div class="col-auto fs-5 fw-light" style="padding: 0">
                                Number Of Orders:
                            </div>
                           <div class="col-auto ms-auto fs-5 text-warning fw-semibold" style="padding: 0">20</div>
                           <div class="w-100"></div>
                           <div class="progress mt-3" style="max-width: 100%; padding: 0">
                               <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                       </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12" style="padding: 0">
                        <div class="row">
                            <div class="col-auto fs-5 fw-light" style="padding: 0">
                                Total Sales Amount:
                            </div>
                            <div class="col-auto ms-auto fs-5 text-warning fw-semibold" style="padding: 0">$2342343</div>
                            <div class="w-100"></div>
                            <div class="progress mt-3" style="max-width: 100%; padding: 0">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</body>
</html>
<?php
