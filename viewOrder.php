<?php
session_start();
if (!isset($_SESSION['User']) ) {
header("Location: index.php");
}
if ($_SESSION['User']['Position'] != "Staff") {
header("Location: salesReport.php");
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
include "nav.php";
?>
<div class="container-md bg-light pt-5 mt-4 px-md-5" style="min-height: 90vh">
    <h1 class="mb-5 display-3">Sales Order</h1>
    <div class="row mb-4 justify-content-lg-between gy-4">
        <div class="col-lg-7">
                <div class="input-group input-group-lg rounded-pill "
                     style="
                     padding: 0;
                     background-color: hsl(189, 15%, 90%)">
                    <span class="input-group-text" style="background-color: transparent; border: none">
                        <i class="bi-search"></i>
                    </span>
                    <input id="search" class="col-11 form-control rounded-pill" placeholder="Search by customer email..." type="text"
                                                                                                                             style="border: none;background-color: hsl(189, 15%, 90%)">
                </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="ulti-btn row justify-content-lg-end justify-content-start ms-lg-0 ms-1">
                <button class="btn btn-primary col-4 btn-create-order">Create Order</button>
                <div class="dropdown col-auto" >
                    <a href="#" class="btn btn-light dropdown-toggle fw-semibold text-black-50 fs-5"
                       id="sortDropDown" data-bs-toggle="dropdown" role="button">
                        <i class="fs-3 bi bi-sort-alpha-down align-middle"></i>
                        Sort By
                    </a>
                    <div class="dropdown-menu fs-5" style="min-width: inherit;">
                            <button onclick="changeSort('orderID')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Order ID</button>
                            <button onclick="changeSort('customerEmail')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Email</button>
                            <button onclick="changeSort('dateTime')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Creation Time</button>
                            <button onclick="changeSort('orderAmount')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Amount</button>
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
            <th scope="col" class="col-md-1">OrderID</th>
            <th scope="col" class="col-md-3">Customer Email</th>
            <th scope="col" class="d-none d-lg-table-cell col-md-4">Creation Time</th>
            <th scope="col" class="col-md-3">Amount</th>
            <th scope="col" class="col-auto"></th>
            <th scope="col" class="col-auto"></th>
        </tr>
        </thead>
        <tbody id="orderListTable" class="bg-light " style="font-size: 1.3rem">
        <tr class="align-middle mt-5 "
            style="box-shadow:  0 8px 15px -6px rgba(8,72,98,0.38)
">
            <th scope="row" class="text-center">1</th>
            <td>mary@gmail.com</td>
            <td class="d-none d-lg-table-cell">2022-03-24 21:12:13</td>
            <td>$2910</td>
            <td class="text-center">
                <button
                        class="btn btn-success align-middle text-uppercase fw-semibold fs-6"
                        style="max-width: 8em; letter-spacing: 0.05ch"
                        data-bs-toggle="modal"
                        data-bs-target="#orderModal"
                        data-bs-orderid="1"
                >
                    <i class="bi bi-info-circle-fill d-none d-md-inline-block"></i>
                    Detail
                </button>
            </td>
            <td class="text-center">
                <button
                        class="btn btn-danger align-middle text-uppercase fw-semibold"
                        style="max-width: 8em; letter-spacing: 0.05ch">
                    <i class="bi bi-trash3-fill d-none d-md-inline-block"></i>
                    Remove
                </button>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="modal fade" id="orderModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content"
                 style="background-color: hsl(189, 15%, 95%)"
            >
                <div class="modal-header px-5 text-light bg-dark"
                     style="border-bottom: 0 none;"
                >
                    <h3 class="modal-title" id="exampleModalLabel">New message</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-fluid px-5">

                    <!------------------------Order Information------------------->
                    <h3 class="my-4 fw-bolder">Order Information</h3>
                    <hr>
                    <div class="container-fluid shadow-sm bg-light mt-3 mb-5 py-4 px-5 rounded-2"
                    >
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="fs-6 fw-bold mb-2">
                                    Order Time
                                </div>
                                <div class="fs-5">
                                    2022-03-24 21:12:13
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="fs-6 fw-bold mb-2">
                                    Staff ID
                                </div>
                                <div class="fs-5">
                                    s0001
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="fs-6 fw-bold mb-2">
                                    Staff Name
                                </div>
                                <div class="fs-5">
                                    Chan Tai Man
                                </div>
                            </div>
                        </div>
                    </div>


                    <!------------------------Customer Information------------------->
                    <h3 class="my-4 fw-bolder">Customer Information</h3>
                    <hr>
                    <div class="container-fluid shadow-sm bg-light my-3 py-4 px-5 rounded-2"
                    >
                       <div class="row g-4">
                           <div class="col-5">
                               <div class="fs-6 fw-bold mb-2">
                                   Name
                               </div>
                               <div class="fs-5">
                                   Mary
                               </div>
                           </div>
                           <div class="col-5">
                               <div class="fs-6 fw-bold mb-2">
                                   Email
                               </div>
                               <div class="fs-5">
                                   mary@gmail.com
                               </div>
                           </div>
                           <div class="w-100"></div>
                           <div class="col-4">
                               <div class="fs-6 fw-bold mb-2">
                                   Phone Number
                               </div>
                               <div class="fs-5">
                                   58674321
                               </div>
                           </div>
                       </div>
                    </div>


                    <!------------------------Item Row ------------------->
                    <div class="accordion shadow rounded-4" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="headingOne">
                                <button class="accordion-button fs-3 bg-secondary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Item List
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table table-hover mt-2 mb-5"
                                           style="border-collapse: separate;
                                            border-spacing: 0 0.5em;">
                                        <thead style="font-size: 1.1em">
                                        <tr class="d-none">
                                            <th scope="col" class="col-md-1">ID</th>
                                            <th scope="col" class="col-md-8">Name</th>
                                            <th scope="col" class="col-md-1">Qty</th>
                                            <th scope="col" class="col">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-light fs-5" >
                                        <tr class="align-middle mt-5 "
                                            style="box-shadow:  0 8px 15px -6px rgba(8,72,98,0.38)
">
                                            <th scope="row" class="text-center d-none d-lg-table-cell">1</th>
                                            <td class="fw-semibold row" style="padding: 0; margin: 0">
                                                <img src="./images/products/product-image-placeholder.jpg" class="rounded col-auto d-none d-lg-block" height="70" width="70" alt="">
                                                <div class="col-lg-9 col-12 d-flex align-content-center align-items-center">NOVEL NF4091 9”All-way Strong Wind Circulation Fan</div>
                                            </td>
                                            <td>2</td>
                                            <td class="fw-semibold">$1000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr class="my-3">
                                    <div class="row fs-4 mt-5 mb-3 pe-lg-4">
                                        <div class="col-auto text-nowrap fw-semibold">
                                            Total Amount
                                        </div>
                                        <div class="ms-auto col-auto fw-bold">
                                            $2910
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!------------------------Delivery Information ------------------->
                    <form class="g-5 needs-validation bg-light p-4 shadow container rounded-3 mt-4"
                          novalidate
                          id="updateDeliveryForm"
                    >
                        <div class="col-12">
                            <label for="formAddress" class="form-label fs-3 fw-bold mb-3">
                                Delivery Address
                            </label>
                            <textarea name="delAddress" id="formAddress" class="form-control fs-4" rows="5" required></textarea>
                            <div class="invalid-feedback fs-5">
                                Please provide the Delivery Address!!!
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer px-5"
                     style="border-top: 0 none;">
                    <button type="button" class="edit-btn btn btn-warning fw-semibold"
                            onclick="toggleSave(false)"
                    >
                        <i class="bi bi-pencil-fill"></i>
                        Edit
                    </button>
                    <button type="button" class="close-btn btn btn-outline-danger fw-semibold" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" form="updateDeliveryForm" class="save-btn btn btn btn-warning fw-semibold d-none"
                            onclick="toggleSave(true)"
                    >
                        <i class="bi bi-check"></i>
                        Save
                    </button>
                    <button type="button" class="cancel-btn  btn btn btn-outline-danger fw-semibold d-none"
                            onclick="toggleSave(false)"
                    >
                        <i class="bi bi-x"></i>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<!--modal javascript-->
<script>
    const modal = $('#orderModal')
    $(modal).on("show.bs.modal", event => {
        const button = event.relatedTarget
        const orderID = $(button).attr('data-bs-orderid')

        // calling ajax

        const postData = {
            targetID: orderID,
        }
        console.log($(modal))
        console.log($(modal).find('.modal-title').text(`Sales Order#${orderID}`))
        $.ajax({
            data: postData,
            type: "POST",
            url: "getOrderDetail.php",
            success: function (response) {
                const res = jQuery.parseJSON(response)
                if (res.status == 200) {
                    $(modal).find('.modal-body').html(res.message);
                }
            }
        })
    })

    $(modal).on("hidden.bs.modal", function () {
        $(modal).find('.modal-body').html('');
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
        }
    }

    function submitDeliveryForm (event){
        const UpdateForm = $('#updateDeliveryForm')
        console.log(UpdateForm[0].checkValidity())
        if(!UpdateForm[0].checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        UpdateForm.addClass('was-validated')
    }

    var sort = "orderID";
    var searchBar = $('#search')

    function changeSort(order) {
        sort = order;
        getOrderList()
    }

    getOrderList()
    function getOrderList(){
       // console.log(searchBar.val())
        const postData = {
           target: searchBar.val(),
           order: sort
        }
        // console.log(postData);
        $.ajax({
            data: postData,
            type: "POST",
            url: "getOrderList.php",
            success: function (response) {
                const res = jQuery.parseJSON(response)
                if (res.status == 200) {
                    $('#orderListTable').html(res.message);
                }
            }
        })
    }

    $(searchBar).on('keypress', function (e) {
        if (e.which == 13) {
            getOrderList();
        }
    })
    const createBtn = $('.btn-create-order')
    $(createBtn).on('click', function () {
        window.location.href = './placeOrder.php'
    })

</script>
</body>
</html>
<?php
