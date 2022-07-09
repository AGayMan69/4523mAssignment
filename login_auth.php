<?php
include 'database_connection.php';
include 'timeout.php';

if (isset($_POST['staffID']) && isset($_POST['password'])) {
    extract($_POST);

    if (empty($staffID)) {
        header("Location: index.php?error=Staff ID is required");
    } else if (empty($password)) {
        header("Location: index.php?error=Password is required");
    } else {
        $conn = getDBconnection();
        $sql = "SELECT * FROM staff WHERE staffID = '$staffID'";
        $userResult = mysqli_query($conn, $sql) or die(mysqli_connect_error());
        $rowCount = mysqli_num_rows($userResult);

        if ($rowCount == 1) {
            $user = mysqli_fetch_assoc($userResult);
            extract($user, EXTR_PREFIX_ALL, "user");
            echo $user_password;
            if (strcmp($password, $user_password) == 0) {
                echo "Login successfully";
                // Creating Session
                session_set_cookie_params(getSessionTimeout());
                session_start();
                $_SESSION['User']['ID'] = $user_staffID;
                $_SESSION['User']['Name'] = $user_staffName;
                $_SESSION['User']['Position'] = $user_position;
                $_SESSION['LAST_ACTIVITY'] = time();

                if ($_SESSION['User']['Position'] == "Staff") {
                    header("Location: placeOrder.php");
                } else {
                    header("Location: salesReport.php");
                }
            } else {
                header("Location: index.php?error=Wrong Staff ID or Password");
            }
        } else {
            header("Location: index.php?error=Wrong Staff ID or Password");
        }
    }
}