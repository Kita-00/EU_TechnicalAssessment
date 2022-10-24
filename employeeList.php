<?php 
    require_once("./Config.php");
    session_start();
    $_SESSION['page'] = 'List';
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./CSS/navbar.css">
        <link rel="stylesheet" href="./CSS/employeeList.css">
        <title>Employee Management</title>
    </head>
    <body>
        <header id="Navbar">
            <?php require("./navbar.php");?>
        </header>
        <section class='bodySection'>
            <div class="container EmployeeList">
                <h1>Employee List</h1>
                <div class='filterEmployees'>
                    <form class='radioRoles' novalidate id='roleFilterForm' action='employeeList.php' method='POST' enctype='multipart/form-data'>
                        <div class="form-row filterRow">
                            <div class="form-group col-2">
                                <div class='filterDropdown'>
                                    <select id='filterOpt' name='filterOpt' class='form-control filterDrop'>
                                        <option value='None'selected>No Filter selected</option>
                                        <option value='EmployeeNumber'>#EMP</option>
                                        <option value='EmployeeName'>Name</option>
                                        <option value='EmployeeSurname'>Surname</option>
                                        <option value='RoleName'>Role</option>
                                        <option value='ReportingLineMngr'>Manager</option>
                                        <option value='HireDate'>Hire Date</option>
                                        <option value='Salary'>Salary</option>
                                        <option value='BirthDate'>Birth Date</option>
                                        <option value='Email'>Email</option>
                                    </select>  
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <div class="filterOptions" >
                                    <div class='custom-control custom-radio custom-control-inline'>
                                        <input type='radio' id='Asce' name='Asce' class='custom-control-input' value='A' onchange="toggleAradio()">
                                        <label class='custom-control-label' for='Asce'>Ascending</label>
                                    </div>
                                    <div class='custom-control custom-radio custom-control-inline'>
                                        <input type='radio' id='Desc' name='Desc' class='custom-control-input' value='D' onchange="toggleBradio()">
                                        <label class='custom-control-label' for='Desc'>Descending</label>
                                    </div>                              
                                </div>
                            </div>
                            <button type="submit"  class="btn btn-primary ConfirmFilter">Filter</button>
                        </div>
                    </form>
                </div>
                
                <table class='table table-hover table-sm listTable'>
                    <thead>
                        <tr>
                            <th scope='col'>
                                <input text='text' class='searchInput eNum' placeholder='#EMP'>
                            </th>
                            <th scope='col'>
                                <input text='text' class='searchInput eName' placeholder='Name'>
                            </th>
                            <th scope='col'>
                                <input text='text' class='searchInput eSur' placeholder='Surname'>
                            </th>
                            <th scope='col'>
                                <input text='text' class='searchInput eRole' placeholder='Role'>
                            </th>
                            <th scope='col'>
                                <input text='text' class='searchInput eMngr' placeholder='Manager'>
                            </th>
                            <th scope='col'>
                                <input text='text' class='searchInput eHD' placeholder='Hire Date'>
                            </th>
                            <th scope='col'>
                                <input text='text' class='searchInput eSal' placeholder='Salary'>
                            </th>
                            <th scope='col'>
                                <input text='text' class='searchInput eBD' placeholder='Birth Date'>
                            </th>
                            <th scope='col'>
                                <input text='text' class='searchInput eEmail' placeholder='Email'>
                            </th>
                            <th scope='col'>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $FilterCol = $_POST['filterOpt'];
                                $filterA ='';
                                $filterD = '';
                                if(isset($_POST['Asce'])) {
                                    $filterA = $_POST['Asce'];
                                } else if(isset($_POST['Desc'])) {
                                    $filterD = $_POST['Desc'];
                                }

                                if($FilterCol === 'None') {
                                    $s = "SELECT * FROM tbemployee INNER JOIN tbrole ON tbemployee.RoleID=tbrole.RoleID ORDER BY EmployeeNumber ASC";
                                    if($result = mysqli_query($con, $s)) {
                                        if(mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_array($result)) {
                                                $EMPnum = $row['EmployeeNumber'];
                                                $EMPname = $row['EmployeeName'];
                                                $EMPsurname = $row['EmployeeSurname'];
                                                $EMProleID = $row['RoleID'];
                                                $EMPmanager = $row['ReportingLineMngr'];
                                                $EMPhire = $row['HireDate'];
                                                $EMPsalary = $row['Salary'];
                                                $EMPNbirth = $row['BirthDate'];
                                                $EMPemail = $row['Email'];
                                                $roleName = $row['RoleName'];
                                           
                                                echo "  <tr>  
                                                            <td>$EMPnum</td>
                                                            <td>$EMPname</td>
                                                            <td>$EMPsurname</td>
                                                            <td>$roleName</td>
                                                            <td>$EMPmanager</td>
                                                            <td>$EMPhire</td>
                                                            <td>R $EMPsalary</td>
                                                            <td>$EMPNbirth</td>
                                                            <td>$EMPemail</td>
                                                            <td>
                                                                <a class='ViewEmployee' href='./profileView.php?EMPnum=$EMPnum'>
                                                                    <button type='button' class='btn btn-sm btn-primary viewEmployee'><i class='fa fa-eye' aria-hidden='true'></i> View</button> 
                                                                </a>
                                                            </td>
                                                        </tr>";
                                            }
                                        }
                                    } 
                                } else {
                                    if($filterA === 'A') {
                                        $s = "SELECT * FROM tbemployee INNER JOIN tbrole ON tbemployee.RoleID=tbrole.RoleID ORDER BY `{$FilterCol}` ASC";
                                        if($result = mysqli_query($con, $s)){
                                            if(mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result)){
                                                    $EMPnum = $row['EmployeeNumber'];
                                                    $EMPname = $row['EmployeeName'];
                                                    $EMPsurname = $row['EmployeeSurname'];
                                                    $EMProleID = $row['RoleID'];
                                                    $EMPmanager = $row['ReportingLineMngr'];
                                                    $EMPhire = $row['HireDate'];
                                                    $EMPsalary = $row['Salary'];
                                                    $EMPNbirth = $row['BirthDate'];
                                                    $EMPemail = $row['Email'];
                                                    $roleName = $row['RoleName'];
                                            
                                                    echo "  <tr>  
                                                                <td>$EMPnum</td>
                                                                <td>$EMPname</td>
                                                                <td>$EMPsurname</td>
                                                                <td>$roleName</td>
                                                                <td>$EMPmanager</td>
                                                                <td>$EMPhire</td>
                                                                <td>R $EMPsalary</td>
                                                                <td>$EMPNbirth</td>
                                                                <td>$EMPemail</td>
                                                                <td>
                                                                    <a class='ViewEmployee' href='./profileView.php?EMPnum=$EMPnum'>
                                                                        <button type='button' class='btn btn-sm btn-primary viewEmployee'><i class='fa fa-eye' aria-hidden='true'></i> View</button> 
                                                                    </a>
                                                                </td>
                                                            </tr>";
                                                }
                                            }
                                        } 
                                    } else if($filterD === 'D') {
                                        $s = "SELECT * FROM tbemployee INNER JOIN tbrole ON tbemployee.RoleID=tbrole.RoleID ORDER BY `{$FilterCol}` DESC";
                                        if($result = mysqli_query($con, $s)){
                                            if(mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result)){
                                                    $EMPnum = $row['EmployeeNumber'];
                                                    $EMPname = $row['EmployeeName'];
                                                    $EMPsurname = $row['EmployeeSurname'];
                                                    $EMProleID = $row['RoleID'];
                                                    $EMPmanager = $row['ReportingLineMngr'];
                                                    $EMPhire = $row['HireDate'];
                                                    $EMPsalary = $row['Salary'];
                                                    $EMPNbirth = $row['BirthDate'];
                                                    $EMPemail = $row['Email'];
                                                    $roleName = $row['RoleName'];
                                            
                                                    echo "  <tr>  
                                                                <td>$EMPnum</td>
                                                                <td>$EMPname</td>
                                                                <td>$EMPsurname</td>
                                                                <td>$roleName</td>
                                                                <td>$EMPmanager</td>
                                                                <td>$EMPhire</td>
                                                                <td>R $EMPsalary</td>
                                                                <td>$EMPNbirth</td>
                                                                <td>$EMPemail</td>
                                                                <td>
                                                                    <a class='ViewEmployee' href='./profileView.php?EMPnum=$EMPnum'>
                                                                        <button type='button' class='btn btn-sm btn-primary viewEmployee'><i class='fa fa-eye' aria-hidden='true'></i> View</button> 
                                                                    </a>
                                                                </td>
                                                            </tr>";
                                                }
                                            }
                                        } 
                                    }
                                }
                            } else {
                                $s = "SELECT * FROM tbemployee INNER JOIN tbrole ON tbemployee.RoleID=tbrole.RoleID ORDER BY EmployeeNumber ASC";
                                if($result = mysqli_query($con, $s)){
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)){
                                            $EMPnum = $row['EmployeeNumber'];
                                            $EMPname = $row['EmployeeName'];
                                            $EMPsurname = $row['EmployeeSurname'];
                                            $EMProleID = $row['RoleID'];
                                            $EMPmanager = $row['ReportingLineMngr'];
                                            $EMPhire = $row['HireDate'];
                                            $EMPsalary = $row['Salary'];
                                            $EMPNbirth = $row['BirthDate'];
                                            $EMPemail = $row['Email'];
                                            $roleName = $row['RoleName'];
                                    
                                            echo "  <tr>  
                                                        <td>$EMPnum</td>
                                                        <td>$EMPname</td>
                                                        <td>$EMPsurname</td>
                                                        <td>$roleName</td>
                                                        <td>$EMPmanager</td>
                                                        <td>$EMPhire</td>
                                                        <td>R $EMPsalary</td>
                                                        <td>$EMPNbirth</td>
                                                        <td>$EMPemail</td>
                                                        <td>
                                                            <a class='ViewEmployee' href='./profileView.php?EMPnum=$EMPnum'>
                                                                <button type='button' class='btn btn-sm btn-primary viewEmployee'><i class='fa fa-eye' aria-hidden='true'></i> View</button> 
                                                            </a>
                                                        </td>
                                                    </tr>";
                                        }
                                    }
                                } 
                            }
                        ?> 

                    </tbody>
                </table>
            </div>
        </section>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="./JS/employeeList.js"></script>  
        <script src="./JS/searchEmployees.js"></script>
    </body>
</html>
