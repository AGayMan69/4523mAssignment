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
<div class="d-flex align-content-center align-items-center"
     style="
background-image: url('./images/backgroundimage.png');
background-size: cover;
background-position: center;
backdrop-filter: blur(3000px);
min-height: 100vh;
">
    <div class="login container " style="max-width: min(80%, 80em)">
        <div class="login form row mh-30"
        style="
        background-color: white;
        border-radius: 2em;
        box-shadow: 0 1rem 3rem rgba(0,0,0,.775)!important;

        ">
            <div class="col-md-5 p-0">
                <img src="./images/loginimage.jpg" alt=""
                     class="img-fluid h-100 d-md-inline d-none"
                     style="
                     object-fit: cover;
                     border-top-left-radius: 2em;
                     border-bottom-left-radius: 2em;"
                >
            </div>
            <div class="col-md-7 py-5 px-5 pe-md-0 ">
                <div class="row justify-content-md-start justify-content-center mb-3">
                    <img src="./images/comlogo.png" class="col-6" alt="">
                </div>
                <h4 class="mb-4 text-capitalize text-primary font-weight-bold ">Sign into account</h4>
                <?php
                if(isset($_GET['error'])) {
                    ?>
                    <div class="col-md-8 p-3 alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        <?php echo $_GET["error"]; ?>
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php
                }
                ?>
                <form class="flex-grow-1"
                      action="login_auth.php"
                      method="post"
                        >
                    <div class="form-group mt-1 col-md-8">
                        <label class="lead mb-1 fs-6 fw-semibold" for="formID">Staff ID</label>
                        <input type="text" placeholder="Staff ID" name="staffID" id="formID"  class="form-control">

                    </div>
                    <div class="form-group mt-3 col-md-8">
                        <label class="lead mb-1 fs-6 fw-semibold" for="formPassword">Password</label>
                        <input type="password" placeholder="********" name="password"  id="formPassword" class="form-control">

                    </div>
                    <div class="form-row col-md-8 d-grid mt-3">
                        <button class="btn btn-primary">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
