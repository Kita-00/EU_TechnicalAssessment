<?php 
    require_once("./config.php");
    session_start();
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
        <link rel="stylesheet" href="./CSS/profileView.css">
        <title>Employee Management</title>
    </head>
    <body>
        <header id="Navbar">
            <?php require("./navbar.php");?>
        </header>
        <section class='bodySection'>
            <div class="container ProfileView">
                <?php
                    $s = "SELECT * FROM tbemployee WHERE EmployeeNumber = '$EMPnumber'";
                    if($result = mysqli_query($con, $s)) {
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                $eName = $row['EmployeeName'];
                                $eSur = $row['EmployeeSurname'];
                                $eBD = $row['BirthDate'];
                                $eSal = $row['Salary'];
                                $eEmail = $row['Email'];
                                $eHD = $row['HireDate'];
                                $eMngr = $row['ReportingLineMngr'];
                                $eRole = $row['RoleID'];
                                $MNGRname = '';
                                $MNGRsurname = '';
                                $RoleName;

                                $s = "SELECT * FROM tbemployee WHERE EmployeeNumber ='$eMngr'";
                                if($result = mysqli_query($con, $s)) {
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                            $MNGRname = $row['EmployeeName'];
                                            $MNGRsurname = $row['EmployeeSurname'];       
                                        }
                                    }
                                }

                                $s = "SELECT * FROM tbrole WHERE RoleID ='$eRole'";
                                if($result = mysqli_query($con, $s)) {
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                            $RoleName = $row['RoleName'];
                                        }
                                    }
                                }

                                $defaultImg = 'wavatar';
                                $size = '65';
                                $gravatar = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $eEmail ) ) ) . "?d=" . $defaultImg  . "&s=" . $size;

                                echo "  <div class='card'>
                                            <div class='card-header' id='profileDetailsHeading'>
                                                <div class='row'>";

                                if($_SESSION['page'] === "List") {
                                    echo "  <div class='col-6 backBtn'>
                                                <a class='back' href='./employeeList.php'>
                                                    <button type='button' class='btn btn-primary back'><i class='fa fa-arrow-left' aria-hidden='true'></i> Back</button> 
                                                </a>
                                            </div>";
                                } else if($_SESSION['page'] === "Hierarchy") {
                                    echo "  <div class='col-6 backBtn'>
                                                <a class='back' href='./index.php'>
                                                    <button type='button' class='btn btn-primary back'><i class='fa fa-arrow-left' aria-hidden='true'></i> Back</button> 
                                                </a>
                                            </div>";
                                }
            
                                echo "          <div class='col-6 text-right'>
                                                    <img class='GravImg' src='$gravatar' alt='ProfileGravatar' />
                                                    <h4 class='EmployeeNumHeader'>$EMPnumber</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='card-body' id='profileDetailsBody'>    
                                            <div class='row profileGrid'>
                                                <div class='col-5'>
                                                    <table class='table table-borderless table-sm PersDetailsTable'>
                                                        <thead>
                                                            <tr>
                                                                <th colspan='2'><u>Personal Details:</u></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>                
                                                                <td>
                                                                    <div data-type='text' id='nameInfo' class='information'>
                                                                        Name:
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>$eName<div>
                                                                </td>   
                                                            </tr>  
                                                            <tr>                
                                                                <td>
                                                                    <div data-type='text' id='surnameInfo' class='information'>
                                                                        Surname:
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>$eSur<div>
                                                                </td>   
                                                            </tr>  
                                                            <tr>
                                                                <td>
                                                                    <div data-type='date' id='birthdayInfo' class='information'>
                                                                        Birth Date:
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>$eBD<div>
                                                                </td> 
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div data-type='email' id='emailInfo' class='information'>
                                                                        Email:
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>$eEmail<div>
                                                                </td> 
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>        
                                                <div class='col-7'>
                                                    <table class='table table-borderless table-sm EmplDetailsTable'>
                                                        <thead>
                                                            <tr>
                                                                <th colspan='2'><u>Employment Details:</u></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>                
                                                                <td>
                                                                    <div data-type='text' id='roleInfo' class='information'>
                                                                        Role:
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>$RoleName<div>
                                                                </td>   
                                                            </tr>  
                                                            <tr>                
                                                                <td>
                                                                    <div data-type='text' id='salaryInfo' class='information'>
                                                                        Salary:
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>R  $eSal<div>
                                                                </td>   
                                                            </tr>  
                                                            <tr>
                                                                <td>
                                                                    <div data-type='date' id='hiredateInfo' class='information'>
                                                                        Hire Date:
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>$eHD<div>
                                                                </td> 
                                                            </tr>";

                                if($MNGRname == '') {
                                    echo "  <tr>
                                                <td>
                                                    <div data-type='email' id='managerInfo' class='information'>
                                                        <b>Reporting Line Manager:</b>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div></div>
                                                </td> 
                                            </tr>";
                                } else {
                                    echo "   <tr>
                                                <td>
                                                    <div data-type='email' id='managerInfo' class='information'>
                                                        Reporting Line Manager:
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>$eMngr - $MNGRname $MNGRsurname<div>
                                                </td> 
                                            </tr>";
                                }
                                   
                                echo "                      </tbody>
                                                        </table>
                                                    </div>
                                                </div>                                   
                                            </div>
                                            <div class='card-footer text-center' id='profileDetailsFooter'>
                                                <a class='EditEmployee' href='./editEmployee.php?EMPnum=$EMPnumber'>
                                                    <button type='button' class='btn btn-primary editEmployee'>Edit Employee</button> 
                                                </a>

                                                <a class='DeleteEmployeeConfirm' data-toggle='modal' data-target='#DeleteEmployeeModal'>
                                                    <button type='button' class='btn btn-danger deleteEMPconfirm'>Remove Employee</button>
                                                </a>

                                                <div class='modal fade' id='DeleteEmployeeModal' tabindex='-1' role='dialog' aria-labelledby='DeleteEmployeeModal' aria-hidden='true'>
                                                    <div class='modal-dialog' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header deleteEMPhead'>
                                                                <h5> Confirm Delete </h5>
                                                            </div>
                                                            <div class='modal-body deleteEMPbody'>
                                                                <p><b>Are you sure you want to delete employee $EMPnumber?</b></p>
                                                            </div>                                               
                                                            <div class='modal-footer deleteEMPfoot'>                
                                                                <a class='DeleteEmployee' href='./deleteEmployee.php?EMPnum=$EMPnumber'>
                                                                    <button type='button' class='btn btn-primary deleteEmployee' >Yes</button> 
                                                                </a>
                                                                <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
                                                            </div>                                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                            }              
                        }
                    }
                ?>
            </div>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
    </body>
</html>
