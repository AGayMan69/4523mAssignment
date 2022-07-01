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
    <h1 class="mb-5 display-3">Items</h1>
    <div class="row mb-4 justify-content-lg-between gy-4">
        <div class="col-lg-7">
            <div class="input-group input-group-lg rounded-pill "
                 style="
                     padding: 0;
                     background-color: hsl(189, 15%, 90%)">
                    <span class="input-group-text" style="background-color: transparent; border: none">
                        <i class="bi-search"></i>
                    </span>
                <input id="search" class="col-11 form-control rounded-pill" placeholder="Search by item name..." type="text"
                       style="border: none;background-color: hsl(189, 15%, 90%)">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="ulti-btn row justify-content-lg-end justify-content-start ms-lg-0 ms-1">
                <button class="btn btn-primary col-4"
                        data-bs-toggle="modal"
                        data-bs-target="#itemAddModal"
                >Add Item</button>
                <div class="dropdown col-auto" >
                    <a href="#" class="btn btn-light dropdown-toggle fw-semibold text-black-50 fs-5"
                       id="sortDropDown" data-bs-toggle="dropdown" role="button">
                        <i class="fs-3 bi bi-sort-alpha-down align-middle"></i>
                        Sort By
                    </a>
                    <div class="dropdown-menu fs-5" style="min-width: inherit;">
                            <button onclick="changeSort('itemID')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">ID</button>
                            <button onclick="changeSort('itemName')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Name</button>
                            <button onclick="changeSort('stockQuantity')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Quantity</button>
                            <button onclick="changeSort('Price')" type="button" class="dropdown-item fw-semibold text-black-50" href="#">Price</button>
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
            <th scope="col" class="col-md-1">Item ID</th>
            <th scope="col" class="col-md-3">Name</th>
            <th scope="col" class="d-none d-lg-table-cell col-md-5">Item Description</th>
            <th scope="col" class="col-md-1">Quantity</th>
            <th scope="col" class="col-md-1">Price</th>
            <th scope="col" class="col-auto"></th>
        </tr>
        </thead>
        <tbody id="itemListTable" class="bg-light " style="font-size: 1.3rem">
        </tbody>
    </table>

    <div class="modal fade" id="orderModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
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
                    <form id="updateItemForm" action="" class="row g-5 mt-1 needs-validation" novalidate>
                            <img src="./images/products/product-image-placeholder.jpg" alt="" class="rounded col-12"
                                 style="max-width: 25em; object-fit: scale-down"
                            >
                            <fieldset class="col row pt-5">
                                <div class="col-md-6 mt-3 mb-3">
                                    <label for="" class="form-label fs-5 fw-semibold">Name</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           placeholder="Product name...."
                                           value=""
                                    >
                                    <div class="invalid-feedback">
                                        Please provide a product name!
                                    </div>
                                </div>
                                <div class="w-100"></div>

                                <div class="col-md-12 mb-3">
                                    <label for=""
                                    class="form-label fs-5 fw-semibold"
                                    >Description</label>
                                    <textarea name="description" placeholder="Product Description..." id="formDescription" rows="4"
                                    class="form-control"
                                              required
                                    ></textarea>
                                    <div class="invalid-feedback">
                                        Please enter product description!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label fs-5 fw-semibold">Stock Quantity</label>
                                    <input type="number" class="form-control" value="" placeholder="Product Quantity..." required>
                                    <div class="invalid-feedback">
                                        Please enter quantity!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label fs-5 fw-semibold">Price</label>
                                    <input type="number" class="form-control" value="" placeholder="Product Price..." required>
                                    <div class="invalid-feedback">
                                        Please enter price!
                                    </div>
                                </div>
                            </fieldset>

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
                    <button type="submit" form="updateItemForm" class="save-btn btn btn btn-warning fw-semibold d-none"
                            onclick=""
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

    <div class="modal fade" id="itemAddModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content"
                 style="background-color: hsl(189, 15%, 95%)"
            >
                <div class="modal-header px-5 text-light bg-dark"
                     style="border-bottom: 0 none;"
                >
                    <h3 class="modal-title" id="exampleModalLabel">Add Item</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-fluid px-5">
                    <form id="addItemForm" class="row g-5 mt-1 needs-validation"
                          novalidate
                          method="post"
                          action="addItem.php"
                          onsubmit="return submitItemForm(event)"
                    >

                        <img src="./images/products/product-image-placeholder.jpg" alt="" class="rounded col-12"
                             style="max-width: 25em; object-fit: scale-down"
                        >
                        <fieldset class="col row pt-5">
                            <div class="col-md-6 mt-3 mb-3">
                                <label for="" class="form-label fs-5 fw-semibold">Name</label>
                                <input type="text"
                                       class="form-control"
                                       required
                                       placeholder="Product name...."
                                       name="name"
                                       value=""
                                >
                                <div class="invalid-feedback">
                                    Please provide a product name!
                                </div>
                            </div>
                            <div class="w-100"></div>

                            <div class="col-md-12 mb-3">
                                <label for=""
                                       class="form-label fs-5 fw-semibold"
                                >Description</label>
                                <textarea name="description" placeholder="Product Description..." id="formDescription" rows="4"
                                          class="form-control"
                                          required
                                ></textarea>
                                <div class="invalid-feedback">
                                    Please enter product description!
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label fs-5 fw-semibold">Stock Quantity</label>
                                <input type="number" name="quantity" class="form-control" value="" placeholder="Product Quantity..." required>
                                <div class="invalid-feedback">
                                    Please enter quantity!
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label fs-5 fw-semibold">Price</label>
                                <input type="number" name="price" class="form-control" value="" placeholder="Product Price..." required>
                                <div class="invalid-feedback">
                                    Please enter price!
                                </div>
                            </div>
                        </fieldset>

                    </form>
                </div>
                <div class="modal-footer px-5"
                     style="border-top: 0 none;">
                    <button type="submit" form="addItemForm" class="save-btn btn btn btn-primary fw-semibold"
                            onclick=""
                    >
                        <i class="bi bi-check"></i>
                        Submit
                    </button>
                    <button type="button" class="cancel-btn  btn btn btn-outline-danger fw-semibold" data-bs-dismiss="modal"
                    >
                        <i class="bi bi-x"></i>
                        Close
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

<script>
    const modal = $('#orderModal')
    let UpdateForm;
    $(modal).on("show.bs.modal", event => {
        UpdateForm = $('#updateItemForm')
        const button = event.relatedTarget
        const itemID = $(button).attr('data-bs-itemid')

        // calling ajax
        const postData = {
            targetID: itemID,
        }
        $.ajax({
            data: postData,
            type: "POST",
            url: "getItemDetail.php",
            success: function (response) {
                const res = jQuery.parseJSON(response)
                if (res.status == 200) {
                    $(modal).find('.modal-body').html(res.message);
                }
            }
        })
        console.log($(modal))
        console.log($(modal).find('.modal-title').text(`Item#${itemID}`))
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

    const AddForm = $('#addItemForm')
    function submitItemForm(e) {
        if(!e.target.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            e.target.classList.add('was-validated')
        }
    }

    var sort = "itemID";
    var searchBar = $('#search')

    function changeSort(order) {
        sort = order;
        getItemList();
    }

    getItemList()
    function getItemList(){
        // console.log(searchBar.val())
        const postData = {
            target: searchBar.val(),
            order: sort
        }
        console.log(postData);
        $.ajax({
            data: postData,
            type: "POST",
            url: "getItemList.php",
            success: function (response) {
                const res = jQuery.parseJSON(response)
                if (res.status == 200) {
                    $('#itemListTable').html(res.message);
                }
            }
        })
    }

    $(searchBar).on('keypress', function (e) {
        if (e.which == 13) {
            getItemList();
        }
    })

</script>
</body>
</html>
<?php
