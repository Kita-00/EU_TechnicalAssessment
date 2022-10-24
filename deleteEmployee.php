<?php
    session_start();
    require_once("./config.php");

    $EMPnum = $_GET['EMPnum'];

    $update = " UPDATE tbemployee
                SET
                    ReportingLineMngr = ''
                WHERE ReportingLineMngr = '$EMPnum'";
    if(mysqli_query($con, $update)) {
       //echo "Records were updated successfully.";
    } else {
        echo "ERROR: " . $con->error;
    }

    $del = "DELETE FROM tbemployee WHERE EmployeeNumber='$EMPnum'";
    if(mysqli_query($con, $del)) {
        echo "Employee Successfully Deleted.";
    } else {
        echo "ERROR: Could not able to execute $del. " . mysqli_error($link);
    }

    header("Location: ./employeeList.php");
    mysqli_close($con);
?>