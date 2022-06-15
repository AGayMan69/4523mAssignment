<?php

$page = "Staff";
if ($page === "Staff") {
   $urls = array(
       "View Order" => 'viewOrder.php',
       "Create Order" => 'createOrder.php'
   );
} else {
    $urls = array(
        "Items" => 'items.php',
        "Reports" => 'salesReport.php',
        "Customers" => 'customers.php'
    );
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Better Limited Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="#"
                style="letter-spacing: 0.05ch">
                <img src="./images/logo_notext.png" alt="" width="35" height="30" class="d-inline-block align-bottom"
                    style="object-fit: scale-down">
                BetterLimited
            </a>
            <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#toggleHamburger"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="toggleHamburger">
                <ul class="navbar-nav ms-auto py-3 py-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Fuck You asshole</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"></script>
</body>
</html>
