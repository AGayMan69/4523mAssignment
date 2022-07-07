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
    <div class="container d-flex flex-column align-items-center bg-light p-5" style="min-height: 90vh" id="mainContainer">
        <h1 class="display-3"></h1>

            <div class="row mt-4">
                <div class="input-group date">
                    <input type="text" class="form-control" id="datepicker" readonly/>
                    <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-calendar"></i>
                            </span>
                        </span>
                </div>
            </div>

    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>


<!--DateTimePicker CDN-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


<script type="text/javascript" src="src/addMonthlyReport.js"></script>
</body>
</html>
<?php
