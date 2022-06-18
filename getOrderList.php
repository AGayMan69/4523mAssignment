<?php
//if (!empty($_POST)){
//    header("Location: index.php");
//}
session_start();
extract($_POST);
include 'database_connection.php';
$conn = getDBconnection();

//$sql
$sql = "SELECT orderID, customerEmail, dateTime, orderAmount FROM `orders`";
$sql .= " WHERE staffID='{$_SESSION['User']['ID']}'";
if ($target != '') {
    $sql .= " AND customerEmail LIKE '%$target%'";
}
$sort = 'ASC';
if ($order == 'dateTime' || $order == 'orderAmount')
    $sort = 'DESC';

$sql .= " ORDER BY $order $sort";

$result = $conn->query($sql);


$resultHtml = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        extract($row);
        $resultHtml .= <<<EOD
        <tr class="align-middle mt-5 "
            style="box-shadow:  0 8px 15px -6px rgba(8,72,98,0.38)
">
            <th scope="row" class="text-center">$orderID</th>
            <td>$customerEmail</td>
            <td class="d-none d-lg-table-cell">$dateTime</td>
            <td>\$$orderAmount</td>
            <td class="text-center">
                <button
                        class="btn btn-success align-middle text-uppercase fw-semibold fs-6"
                        style="max-width: 8em; letter-spacing: 0.05ch"
                        data-bs-toggle="modal"
                        data-bs-target="#orderModal"
                        data-bs-orderid="$orderID"
                >
                    <i class="bi bi-info-circle-fill d-none d-md-inline-block"></i>
                    Detail
                </button>
            </td>
            <td class="text-center">
                <form class="d-none" action="deleteOrder.php" method="post" id="removeOrder$orderID">
                    <input type="text" name="targetID" value="$orderID">
                </form>
                <button
                        type="submit"
                        form="removeOrder$orderID"
                        class="btn btn-danger align-middle text-uppercase fw-semibold"
                        style="max-width: 8em; letter-spacing: 0.05ch"
                        >
                    <i class="bi bi-trash3-fill d-none d-md-inline-block"></i>
                    Remove
                </button>
            </td>
        </tr>
EOD;
    }
    $res = [
        'status' => 200,
        'message' => $resultHtml
//        'message' => $order
    ];
//    echo $resultHtml;
} else {
    $res = [
        'status' => 404,
        'message' => "Result not found"
    ];
}
echo json_encode($res);

$conn->close();

