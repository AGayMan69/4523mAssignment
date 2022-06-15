<?php
include 'database_connection.php';

if (isset($_POST['staffID']) && isset($_POST['password'])) {
    extract($_POST);

    if (empty($staffID)) {
        header("Location: login.php?error=Staff ID is required");
    } else if (empty($password)) {
        header("Location: login.php?error=Password is required");
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
                $_SESSION['ID'] = $user_staffID;
                $_SESSION['Name'] = $user_staffName;
                $_SESSION['position'] = $user_position;
            } else {
                header("Location: login.php?error=Wrong Staff ID or Password");
            }
        } else {
            header("Location: login.php?error=Wrong Staff ID or Password");
        }
    }
}
