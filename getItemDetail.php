<?php
extract($_POST);
include 'database_connection.php';
$conn = getDBconnection();
$sql = "SELECT * FROM item";
$sql .= " WHERE itemID = $targetID";
$itemDetail = $conn->query($sql);

if ($itemDetail->num_rows == 1) {
   $detail = $itemDetail->fetch_assoc();
   extract($detail);
    $resultHTML = <<<EOD
                    <form id="updateItemForm" class="row g-5 mt-1 needs-validation" 
                        novalidate
                          method="post"
                          action="updateItem.php"
                          onsubmit="return submitItemForm(event)"
                        >
                            <img src="./images/products/product-image-placeholder.jpg" alt="" class="rounded col-12"
                                 style="max-width: 25em; object-fit: scale-down"
                            >
                            <fieldset class="col row pt-5" disabled>
                                <input type="hidden" name="itemID" value="$itemID">
                                <div class="col-md-6 mt-3 mb-3">
                                    <label for="" class="form-label fs-5 fw-semibold">Name</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           placeholder="Product name...."
                                           name="name"
                                           value="$itemName"
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
                                    >$itemDescription</textarea>
                                    <div class="invalid-feedback">
                                        Please enter product description!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label fs-5 fw-semibold">Stock Quantity</label>
                                    <input type="number" name="quantity" class="form-control" value="$stockQuantity" placeholder="Product Quantity..." required>
                                    <div class="invalid-feedback">
                                        Please enter quantity!
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label fs-5 fw-semibold">Price</label>
                                    <input type="number" name="price" class="form-control" value="$price" placeholder="Product Price..." required>
                                    <div class="invalid-feedback">
                                        Please enter price!
                                    </div>
                                </div>
                            </fieldset>

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
