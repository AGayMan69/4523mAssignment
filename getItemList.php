<?php

//if (!empty($_POST)){
//    header("Location: index.php");
//}
extract($_POST);
//$target = '';
//$order = 'itemID';
include 'database_connection.php';
$conn = getDBconnection();

//$sql
$sql = "SELECT * FROM `item`";
if ($target != '') {
    $sql .= " WHERE UPPER(itemName) LIKE UPPER('%$target%')";
}
$sort = 'ASC';
if ($order == 'stockQuantity' || $order == 'Price')
    $sort = 'DESC';

$sql .= " ORDER BY $order $sort";

$result = $conn->query($sql);


$resultHtml = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        extract($row);
//        var_dump($row);
        $resultHtml .= <<<EOD
        <tr class="align-middle mt-5 "
            style="box-shadow:  0 8px 15px -6px rgba(8,72,98,0.38)
">
            <th scope="row" class="text-center">$itemID</th>
            <td class="fs-6">$itemName</td>
            <td class="d-none d-lg-table-cell fs-6">$itemDescription</td>
            <td>$stockQuantity</td>
            <td>\$$price</td>
            <td class="text-center">
                <button
                        class="btn btn-success align-middle text-uppercase fw-semibold fs-6"
                        style="max-width: 8em; letter-spacing: 0.05ch"
                        data-bs-toggle="modal"
                        data-bs-target="#orderModal"
                        data-bs-itemid="$itemID"
                >
                    <i class="bi bi-info-circle-fill d-none d-md-inline-block"></i>
                    Detail
                </button>
            </td>
        </tr>
EOD;
    }
    $res = [
        'status' => 200,
        'message' => $resultHtml
    ];
} else {
    $res = [
        'status' => 404,
        'message' => "Result not found"
    ];
}
echo json_encode($res);
$conn->close();
