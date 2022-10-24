<?php
    require_once("./config.php");  
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $roleID = $_POST['rID'];
        $roleName = htmlentities($_POST['EditRoleName'], ENT_QUOTES);
        
        $update = " UPDATE tbrole
                    SET
                        RoleName = '$roleName'
                    WHERE RoleID = $roleID";
        if(mysqli_query($con, $update)) {
           //echo "Role Successfully Updated.";
        } else {
            echo "ERROR: Could not update quiz details.";
        }
    }

    header("Location: ./employeeRoles.php");
    mysqli_close($con);
?>