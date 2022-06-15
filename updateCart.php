<?php
session_start();
//header('Access-Control-Allow-Methods: GET, POST');
//header('Access-Control-Allow-Headers: *');
//header('Content-Type: application/json; charset=UTF-8');
$received = json_decode(file_get_contents("php://input"), true);
//$name = $received["testname"];
//echo json_encode(["message" => "$received"]);

//echo json_encode($received);
extract($received);
$_SESSION['cart'][$product]["qty"] = $qty;
echo json_encode($_SESSION['cart']);