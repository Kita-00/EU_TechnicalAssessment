<?php
    require_once("./config.php");  
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $EMPnum = $_POST['employeeNum'];
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
      
        $update = " UPDATE tbemployee
                    SET
                        EmployeeName = '$EMPname',
                        EmployeeSurname = '$EMPsurname',
                        BirthDate = '$EMPbirthDate',
                        Salary = '$EMPsalary',
                        Email = '$EMPemail',
                        HireDate = '$EMPhireDate',
                        ReportingLineMngr = '$EMPmngr',
                        RoleID = '$EMPrID'
                    WHERE EmployeeNumber = '$EMPnum'";
        if(mysqli_query($con, $update)) {
           //echo "Employee Successfully Updated.";
        } else {
            echo "ERROR: Could not update quiz details.";
        }
    }
   
    header("Location: ./employeeList.php");
    mysqli_close($con);
?>
