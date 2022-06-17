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
                <input class="col-11 form-control rounded-pill" placeholder="Search by Customer Email..." type="text"
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
                    <ul class="dropdown-menu fs-5" style="min-width: inherit;">
                        <li>
                            <a class="dropdown-item fw-semibold text-black-50" href="#">Email</a>
                        </li>
                        <li>
                            <a class="dropdown-item fw-semibold text-black-50" href="#">Name</a>
                        </li>
                        <li>
                            <a class="dropdown-item fw-semibold text-black-50" href="#">Phone Number</a>
                        </li>
                    </ul>
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
        <tbody class="bg-light " style="font-size: 1.3rem">
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
    const modal = $('#orderModal')
    $(modal).on("show.bs.modal", event => {
        const button = event.relatedTarget
        const orderID = $(button).attr('data-bs-itemid')

        // calling ajax
        console.log($(modal))
        console.log($(modal).find('.modal-title').text(`Item#${orderID}`))
        $(modal).find('fieldset').attr('disabled', 'disabled')
    })

    function toggleSave(reset) {
        if (reset === true) {
            $('.edit-btn').removeClass('d-none')
            $('.close-btn').removeClass('d-none')
            $('.save-btn').addClass('d-none')
            $('.cancel-btn').addClass('d-none')
        } else {
            $('.edit-btn').toggleClass('d-none')
            $('.close-btn').toggleClass('d-none')
            $('.save-btn').toggleClass('d-none')
            $('.cancel-btn').toggleClass('d-none')
            $(modal).find('fieldset').attr('disabled', function (i, v){return !v;})
        }
    }

    const UpdateForm = $('#updateItemForm')
    $(UpdateForm).submit(function (e) {
        console.log(UpdateForm[0].checkValidity())
        if(!UpdateForm[0].checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        UpdateForm.addClass('was-validated')
    })

</script>

</body>
</html>
<?php
