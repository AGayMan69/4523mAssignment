<?php
session_start();
if (isset($_SESSION['cart'])) {

    $orderAmount = 0;
    foreach ($_SESSION['cart'] as $items) {
        extract($items);
        $orderAmount += $qty * $price;
    }

    $url = "http://127.0.0.1:8080/api/discountCalculator/$orderAmount";
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response,true);
    $data['originalTotal'] = round($orderAmount,1);
    $data['newTotal'] = round($orderAmount-($orderAmount*$data['discountRate']),1);
    $data['difference'] = round(($orderAmount- $data['newTotal']),1) ;

    $_SESSION['discountRate'] = $data['discountRate'];

    echo json_encode($data,true);
}




