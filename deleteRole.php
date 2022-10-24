<?php
    session_start();
    require_once("./config.php");

    $roleID = $_GET['roleID'];

    $s = "SELECT RoleID FROM tbemployee WHERE tbemployee.RoleID = '$roleID'";
    if($result = mysqli_query($con, $s)) {
        if(mysqli_num_rows($result) > 0) {
            $_SESSION['alert'] = 'F';
        } else {
            $del = "DELETE FROM tbrole WHERE RoleID='$roleID'";
            if(mysqli_query($con, $del)) {
                echo "Records were deleted successfully.";
            } else {
                echo "ERROR: Could not able to execute $del. " . mysqli_error($link);
            }

            $_SESSION['alert'] = 'S';
        }
    }

    header("Location: ./employeeRoles.php");
    mysqli_close($con);
?>

  