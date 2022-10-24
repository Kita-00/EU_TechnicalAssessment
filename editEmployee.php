<?php 
    require_once("./config.php");
    $EMPnumber = $_GET['EMPnum'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./CSS/navbar.css">
        <link rel="stylesheet" href="./CSS/editEmployee.css">
        <title>Employee Management</title>
    </head>
    <body>
        <header id="Navbar">
            <?php require("./navbar.php");?>
        </header>
        <section class='bodySection'>
            <div class="container editEmpForm">
                <h2>Edit Employee</h2> 
                <?php
                    $s = "SELECT * FROM tbemployee WHERE EmployeeNumber = '$EMPnumber'";
                    if($result = mysqli_query($con, $s)) {
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                $EMPname = $row['EmployeeName'];
                                $EMPsurname = $row['EmployeeSurname'];
                                $EMProleID = $row['RoleID'];
                                $EMPmanager = $row['ReportingLineMngr'];
                                $EMPhire = $row['HireDate'];
                                $EMPsalary = $row['Salary'];
                                $EMPNbirth = $row['BirthDate'];
                                $EMPemail = $row['Email'];
                                $MNGRname;
                                $MNGRsurname;

                                echo "  <div class='EditEmployeeFormContainer'>
                                            <form id='updateEmployeeForm' action='updateEmployee.php' method='POST' onsubmit='return validateEditEmployee()' enctype='multipart/form-data'>
                                                <input type='hidden' name='employeeNum' id='employeeNum' value='$EMPnumber'></input>
                                                    <div class='form-row'>
                                                        <div class='form-group col-6'>
                                                            <label for='eName'>Employee Name:</label>
                                                            <input type='text' class='form-control' name='eName' id='eName' value='$EMPname' placeholder='E.g. John' required/>
                                                            <p id='EmployeeNameValidation' class='validationMsg'></p>
                                                        </div>
                                                        <div class='form-group col-6'>
                                                            <label for='eSurname'>Employee Surname:</label>
                                                            <input type='text' class='form-control' name='eSurname' id='eSurname' value='$EMPsurname' placeholder='E.g. Doe' required/>
                                                            <p id='EmployeeSurnameValidation' class='validationMsg'></p>
                                                        </div>
                                                    </div>
                                                    <div class='form-row'>
                                                        <div class='form-group col-12'>
                                                            <label for='eEmail'>Email:</label>
                                                            <input type='email' class='form-control' name='eEmail' id='eEmail' value='$EMPemail' placeholder='E.g. johndoe@gmail.com' required/>
                                                            <p id='EmployeeEmailValidation' class='validationMsg'></p>
                                                        </div>
                                                    </div>
                                                    <div class='form-row'>
                                                        <div class='form-group col-4'>
                                                            <label for='eBirthDate'>Employee Birth Date:</label>
                                                            <input type='date' class='form-control' name='eBirthDate' id='eBirthDate' value='$EMPNbirth' placeholder='E.g. 2021-05-24' required/>
                                                            <p id='EmployeeBDValidation' class='validationMsg'></p>
                                                        </div>
                                                        <div class='form-group col-4'>
                                                            <label for='eHireDate'>Employee Hire Date:</label>
                                                            <input type='date' class='form-control' name='eHireDate' id='eHireDate' value='$EMPhire' placeholder='E.g. 2021-05-24' required/>
                                                            <p id='EmployeeHDValidation' class='validationMsg'></p>
                                                        </div>
                                                            <div class='form-group col-4'>
                                                            <label for='eSalary'>Employee Salary:</label>
                                                            <input type='number' class='form-control' step='0.01' name='eSalary' id='eSalary' value='$EMPsalary' placeholder='E.g 3245,45' required/>
                                                            <p id='EmployeeSalaryValidation' class='validationMsg'></p>
                                                        </div>
                                                    </div>
                                                    <div class='form-row'>
                                                        <div class='form-group col-6'>
                                                            <label for='RLmngr'>Select a Reporting Line Manager:</label>
                                                            <select id='RLmngr' name='RLmngr' class='form-control'>
                                                                <option selected>None</option>";


                                $s = "SELECT * FROM tbemployee WHERE EmployeeNumber ='$EMPmanager'";
                                if($result = mysqli_query($con, $s)) {
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                            $MNGRname = $row['EmployeeName'];
                                            $MNGRsurname = $row['EmployeeSurname'];       
                                        }
                                    }
                                }
                                                    
                                $s = "SELECT * FROM tbemployee";
                                if($result = mysqli_query($con, $s)) {
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                            $EMPnum = $row['EmployeeNumber'];
                                            $EMPnm = $row['EmployeeName'];
                                            $EMPsur = $row['EmployeeSurname'];

                                            if($EMPnumber == $EMPnum && $EMPmanager != '') {
                                                echo "  <option value='$EMPmanager' selected='selected'>$EMPmanager - $MNGRname $MNGRsurname</option>";
                                            } else {
                                                if($EMPnumber == $EMPnum ) {
                                                } else if($EMPmanager == $EMPnum) {
                                                }else {
                                                    echo "  <option value='$EMPnum'>$EMPnum - $EMPnm $EMPsur</option>";
                                                }    
                                            }                        
                                        }
                                    }
                                }

                                echo "      </select>
                                        </div>
                                        <div class='form-group col-6'>
                                            <label for='eRole'>Select a Role:</label>
                                            <select id='eRole' name='eRole' class='form-control' required>
                                                <option selected>Please Select a Role</option>";

                                $s = "SELECT * FROM tbrole";
                                if($result = mysqli_query($con, $s)) {
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                            $rID = $row['RoleID'];
                                            $rName = $row['RoleName'];
                        
                                            if($EMProleID == $rID) {
                                                echo "  <option value='$rID' selected='selected'>$rName</option>";
                                            } else {
                                                echo "  <option value='$rID'>$rName</option>";
                                            }                         
                                        }
                                    }
                                }

                                echo "                  </select>
                                                    </div>
                                                </div>
                                                <div class='text-center buttonDiv'>
                                                    <button id='updateEmployee' type='submit' class='btn btn-primary update'>Update</button> 
                                                    <a class='cancel' href='./profileView.php?EMPnum=$EMPnumber'>
                                                        <button type='button' class='btn btn-danger cancel' >Cancel</button> 
                                                    </a>
                                                </div>
                                            </form>
                                        </div>";
                            }
                        }
                    }

                    mysqli_close($con); 
                ?>        
            </div>
        </section>
         
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
