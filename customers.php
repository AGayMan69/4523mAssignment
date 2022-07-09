<?php
session_start();
if (!isset($_SESSION['User']) ) {
    header("Location: index.php");
}
if ($_SESSION['User']['Position'] != "Manager") {
    header("Location: placeOrder.php");
}
include "checkSessionTimeout.php";
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
    <style >
        tbody td {
            padding-block: 1em!important;
        }
        thead th {
            padding-block: 0.7em!important;
        }
    </style>
</head>
<body style="background-color: hsl(189, 15%, 90%)">
<?php
$page = "Manager";
include "nav.php";
?>
<div class="container-md bg-light pt-5 mt-4 px-md-5" style="min-height: 90vh">
    <h1 class="mb-5 display-3">Customer</h1>
    <div class="row mb-4 justify-content-lg-between gy-4">
        <div class="col-lg-7">
            <div class="input-group input-group-lg rounded-pill "
                 style="
                     padding: 0;
                     background-color: hsl(189, 15%, 90%)">
                    <span class="input-group-text" style="background-color: transparent; border: none">
                        <i class="bi-search"></i>
                    </span>
                <input id="search" class="col-11 form-control rounded-pill" placeholder="Search by Customer Email..." type="text"
                       style="border: none;background-color: hsl(189, 15%, 90%)">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="ulti-btn row justify-content-lg-end justify-content-start ms-lg-0 ms-1">
                <div class="dropdown col-auto" >
                    <a href="#" class="btn btn-light dropdown-toggle fw-semibold text-black-50 fs-5"
                       id="sortDropDown" data-bs-toggle="dropdown" role="button">
                        <i class="fs-3 bi bi-sort-alpha-down align-middle"></i>
                        Sort By
                    </a>
                    <div class="dropdown-menu fs-5" style="min-width: inherit;">
                        <button onclick="changeSort('customerEmail')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Email</button>
                        <button onclick="changeSort('customerName')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Name</button>
                        <button onclick="changeSort('phoneNumber')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Phone Number</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover mt-2"
           style="border-collapse: separate;
                    border-spacing: 0 0.5em;">
        <thead style="font-size: 1.1em">
        <tr class="">
            <th scope="col" class="col-md-4">Email</th>
            <th scope="col" class="col-md-3">Name</th>
            <th scope="col" class="col-md-2">Phone Number</th>
            <th scope="col" class="col-auto"></th>
        </tr>
        </thead>
        <tbody id="customerListTable" class="bg-light " style="font-size: 1.3rem">
        <tr class="align-middle mt-5 "
            style="box-shadow:  0 8px 15px -6px rgba(8,72,98,0.38)
">
            <th scope="row">mary@gmail</th>
            <td>Mary</td>
            <td>58674321</td>
            <td class="text-center">
                <button
                        class="btn btn-danger align-middle text-uppercase fw-semibold fs-6"
                        style="max-width: 8em; letter-spacing: 0.05ch"
                >
                    <i class="bi bi-trash3-fill d-none d-md-inline-block"></i>
                    Remove
                </button>
            </td>
        </tr>
        </tbody>
    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<script>
    var sort = "customerEmail";
    var searchBar = $('#search')

    function changeSort(order) {
        sort = order;
        getCustomerList()
    }

    getCustomerList()
    function getCustomerList(){
        // console.log(searchBar.val())
        const postData = {
            target: searchBar.val(),
            order: sort
        }
        console.log(postData);
        $.ajax({
            data: postData,
            type: "POST",
            url: "getCustomerList.php",
            success: function (response) {
                const res = jQuery.parseJSON(response)
                if (res.status == 200) {
                    $('#customerListTable').html(res.message);
                }
            }
        })
    }

    $(searchBar).on('keypress', function (e) {
        if (e.which == 13) {
            getCustomerList();
        }
    })

</script>

</body>
</html>
<?php
