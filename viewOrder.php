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
</head>
<body>
<?php
$page = "Sales";
include "nav.php";
echo "view Order"
?>
</body>
</html>
<?php