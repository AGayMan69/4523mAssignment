<?php
$page = $_SESSION['User']['Position'];
if ($page === "Staff") {
   $urls = array(
       "View Order" => 'viewOrder.php',
       "Create Order" => 'placeOrder.php'
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
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark " >
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
                    <?php
                        foreach ($urls as $link => $url) {
                            echo <<<EOD
                                <li class="nav-item">
                                    <a href="$url" class="nav-link">$link</a> 
</li>
EOD;

                        }
                    ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarUserDropDown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-fill"></i>
                            Welcome, <?php echo "{$_SESSION['User']['Name']}"?>&nbsp;&nbsp;
                        </a>
                        <ul class="dropdown-menu" style="min-width: inherit; width: 100%">
                            <li><a class="dropdown-item fw-semibold text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

</body>
</html>
