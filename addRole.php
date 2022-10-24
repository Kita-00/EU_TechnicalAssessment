<?php
    require_once("./config.php");  
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $roleName = htmlentities($_POST['AddRoleName'], ENT_QUOTES);
           
        $insert = " INSERT INTO tbrole (RoleID, RoleName)
                    VALUES ('','$roleName')";
        if(mysqli_query($con, $insert)) {
            //echo "";
        } else {
            echo "ERROR: " . $con->error;
        }
    }
   
    header("Location: ./employeeRoles.php");
    mysqli_close($con);
?>