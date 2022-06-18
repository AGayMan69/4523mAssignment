<?php
//$target = "";
//$order = "customerEmail";
extract($_POST);
include 'database_connection.php';
$conn = getDBconnection();

//$sql
$sql = "SELECT * FROM `customer`";
if ($target != '') {
    $sql .= "WHERE customerEmail LIKE '%$target%'";
}
$sort = 'ASC';
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
            <th scope="row">$customerEmail</th>
            <td>$customerName</td>
            <td>$phoneNumber</td>
            <td class="text-center">
                <form class="d-none" action="deleteCustomer.php" method="post" id="removeOrder$customerEmail">
                    <input type="text" name="targetID" value="$customerEmail">
                </form>
                <button
                        type="submit"
                        form="removeOrder$customerEmail"
                        class="btn btn-danger align-middle text-uppercase fw-semibold fs-6"
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

