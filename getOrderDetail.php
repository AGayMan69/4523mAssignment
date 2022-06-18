<?php

extract($_POST);
include 'database_connection.php';
$conn = getDBconnection();
$sql = "SELECT * ";
$sql .= "FROM orders o NATURAL JOIN customer c NATURAL JOIN staff s";
$sql .= " WHERE o.orderID = $targetID";
$orderInfo = $conn->query($sql);

$sql = "SELECT * FROM itemorders io NATURAL JOIN item i";
$sql .= " WHERE io.orderID = $targetID";
$orderItemList = $conn->query($sql);


$resultHTML = "";
if ($orderInfo->num_rows == 1 && $orderItemList->num_rows > 0) {
    $info = $orderInfo->fetch_assoc();
//    var_dump($info);
//    echo "<div>==</div>";
    extract($info);
    $resultHTML .= <<<EOD

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
                                    $dateTime
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="fs-6 fw-bold mb-2">
                                    Staff ID
                                </div>
                                <div class="fs-5">
                                    $staffID
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="fs-6 fw-bold mb-2">
                                    Staff Name
                                </div>
                                <div class="fs-5">
                                    $staffName
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
                                   $customerName
                               </div>
                           </div>
                           <div class="col-5">
                               <div class="fs-6 fw-bold mb-2">
                                   Email
                               </div>
                               <div class="fs-5">
                                   $customerEmail
                               </div>
                           </div>
                           <div class="w-100"></div>
                           <div class="col-4">
                               <div class="fs-6 fw-bold mb-2">
                                   Phone Number
                               </div>
                               <div class="fs-5">
                                   $phoneNumber
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
EOD;


    while ($itemRow = $orderItemList->fetch_assoc()) {
        extract($itemRow);
        $resultHTML .= <<< EOD
                                        <tr class="align-middle mt-5 "
                                            style="box-shadow:  0 8px 15px -6px rgba(8,72,98,0.38)
">
                                            <th scope="row" class="text-center d-none d-lg-table-cell">$itemID</th>
                                            <td class="fw-semibold row" style="padding: 0; margin: 0">
                                                <img src="./images/products/product-image-placeholder.jpg" class="rounded col-auto d-none d-lg-block" height="70" width="70" alt="">
                                                <div class="col-lg-9 col-12 d-flex align-content-center align-items-center">$itemName</div>
                                            </td>
                                            <td>$orderQuantity</td>
                                            <td class="fw-semibold">\$$price</td>
                                        </tr>
EOD;
    }
    $resultHTML .= <<< EOD
                                        </tbody>
                                    </table>
                                    <hr class="my-3">
                                    <div class="row fs-4 mt-5 mb-3 pe-lg-4">
                                        <div class="col-auto text-nowrap fw-semibold">
                                            Total Amount
                                        </div>
                                        <div class="ms-auto col-auto fw-bold">
                                            \$$orderAmount
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
                          method="post"
                          action="updateOrder.php"
                          onsubmit="return submitDeliveryForm(event)"
                    >
                        <input type="hidden" value="$orderID" name="delID">
                        <div class="col-12">
                            <label for="formAddress" class="form-label fs-3 fw-bold mb-3">
                                Delivery Address
                            </label>
                            <textarea name="delAddress" id="formAddress" class="form-control fs-4" rows="5" required>$deliveryAddress</textarea>
                            <div class="invalid-feedback fs-5">
                                Please provide the Delivery Address!!!
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="formDate" class="form-label fs-3 fw-bold mb-3">
                                Delivery Time
                            </label>
                            <input type="date" name="delDate" id="formDate" class="form-control fs-4" value="$deliveryDate" required>
                            <div class="invalid-feedback fs-5">
                                Please select a Delivery date
                            </div>
                        </div>
                    </form>
EOD;
    $res = [
        'status' => 200,
        'message' => $resultHTML
    ];
} else {
    $res = [
        'status' => 404,
        'message' => 'No result found!'
    ];
}

echo json_encode($res);
$conn->close();