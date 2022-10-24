<?php
    require_once("./config.php");  
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $EMPname = htmlentities($_POST['eName'], ENT_QUOTES);
        $EMPsurname = htmlentities($_POST['eSurname'], ENT_QUOTES);
        $EMPbirthDate = htmlentities($_POST['eBirthDate'], ENT_QUOTES);
        $EMPsalary = htmlentities($_POST['eSalary'], ENT_QUOTES);
        $EMPemail = htmlentities($_POST['eEmail'], ENT_QUOTES);
        $EMPhireDate = htmlentities($_POST['eHireDate'], ENT_QUOTES);
        $EMPmngr = htmlentities($_POST['RLmngr'], ENT_QUOTES);
        $EMPrID = htmlentities($_POST['eRole'], ENT_QUOTES);

        if($EMPmngr == "None") {
            $EMPmngr = '';
        }

        $EMPnum = 'EU';
        $randStr = rand(100000,999999);
        $EMPnum = $EMPnum .= $randStr;

        $insert = " INSERT INTO tbemployee (EmployeeNumber, EmployeeName, EmployeeSurname, BirthDate, Salary, Email, HireDate, ReportingLineMngr, RoleID)
                    VALUES ('$EMPnum','$EMPname','$EMPsurname','$EMPbirthDate','$EMPsalary','$EMPemail','$EMPhireDate','$EMPmngr','$EMPrID')";
        if(mysqli_query($con, $insert)) {
            //echo "Employee Successfully Added";
        } else {
            echo "ERROR: " . $con->error;
        }
    }
   
    header("Location: ./employeeList.php");
    mysqli_close($con);
?>
