<?php 
    session_start();
    require_once("./config.php");
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./CSS/navbar.css">
        <link rel="stylesheet" href="./CSS/employeeRoles.css">
        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
        <title>Employee Management</title>
    </head>
    <body>
        <header id="Navbar">
            <?php require("./navbar.php");?>
        </header>
        <section class='bodySection'>
            <div class="container RoleList">
                <h1>Employee Roles</h1>
                <?php
                    if($_SESSION['alert'] === "F") {
                        echo "  <div class='alert alert-danger alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    Role cannot be deleted if assigned to an employee.
                                </div>";
                        $_SESSION['alert'] =  "";  
                    } else if ($_SESSION['alert'] === "S") {
                        echo "  <div class='alert alert-success alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    Role successfully deleted.
                                </div>";
                        $_SESSION['alert'] =  "";  
                    }

                    echo "  <div class='searchBoxDIV'>
                                <input type='text' id='roleSearch' onkeyup='searchRoles()' placeholder='Search roles..'>
                                <i class='fa fa-search' aria-hidden='true'></i>
                            </div>
                            <form class='radioRoles' novalidate id='roleFilterForm' action='employeeRoles.php' method='POST' enctype='multipart/form-data'>
                                <div class='custom-control custom-radio custom-control-inline'>
                                    <input type='radio' id='Asce' name='Asce' class='custom-control-input' value='A'>
                                    <label class='custom-control-label' for='Asce'>Display in ascending order.</label>
                                </div>
                                <div class='custom-control custom-radio custom-control-inline'>
                                    <input type='radio' id='Desc' name='Desc' class='custom-control-input' value='D'>
                                    <label class='custom-control-label' for='Desc'>Display in descending order.</label>
                                </div>
                            </form>

                            <div class='RoleTableContainer'>
                                <table class='table table-bordered table-sm RoleTable' id='TableOfRoles'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>Role Name</th>
                                            <th scope='col'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                    if($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $filterA ='';
                        $filterB = '';
                        if(isset($_POST['Asce'])) {
                            $filterA = $_POST['Asce'];
                        } else if(isset($_POST['Desc'])) {
                            $filterB = $_POST['Desc'];
                        }
                        
                        if($filterA === 'A') {
                            $s = "SELECT * FROM tbrole ORDER BY RoleName ASC";
                            if($result = mysqli_query($con, $s)) {
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result)){
                                        $roleID = $row['RoleID'];
                                        $roleName = $row['RoleName'];
                                    
                                        echo "  <tr>  
                                                    <td>$roleName</td>
                                                    <td> 
                                                        <a class='EditRole' data-toggle='modal' data-target='#EditRoleModal$roleID'>
                                                            <button type='button' class='btn btn-sm btn-primary editRole'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</button>
                                                        </a>
                                                        <div class='modal fade' id='EditRoleModal$roleID' tabindex='-1' role='dialog' aria-labelledby='EditRoleModal$roleID' aria-hidden='true'>
                                                            <div class='modal-dialog' role='document'>
                                                                <div class='modal-content'>
                                                                    <form action='editRole.php' method='POST'  enctype='multipart/form-data'>
                                                                        <input type='hidden' id='rID' name='rID' value='$roleID'>
                                                                        <div class='modal-body updateRole'>
                                                                            <div class='form-group'>
                                                                                <label for='EditRoleName$roleID'>Update Role:</label>
                                                                                <input type='text' class='form-control' name='EditRoleName' id='EditRoleName$roleID' value='$roleName' placeholder='Update role' required/>
                                                                                <p id='EditRoleValidation' class='validationMsg'></p>
                                                                                </div>
                                                                        </div>
                                                                        <div class='modal-footer updateRole'>
                                                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
                                                                            <button type='submit' class='btn btn-primary'>Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>   

                                                        <a class='DeleteRoleConfirm' data-toggle='modal' data-target='#DeleteRoleModal$roleID'>
                                                            <button type='button' class='btn btn-danger btn-sm deleteEMPconfirm'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button>
                                                        </a>
                                                        <div class='modal fade' id='DeleteRoleModal$roleID' tabindex='-1' role='dialog' aria-labelledby='DeleteRoleModal$roleID' aria-hidden='true'>
                                                            <div class='modal-dialog' role='document'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header deleteRole'>
                                                                        <h5> Confirm Delete </h5>
                                                                    </div>
                                                                    <div class='modal-body deleteRole'>
                                                                        <p>Are you sure you want to delete <b>$roleName</b> role?</p>
                                                                    </div>
                                                                    <div class='modal-footer deleteRole'>
                                                                        <a class='DeleteRole' href='./deleteRole.php?roleID=$roleID'>
                                                                            <button type='button' class='btn btn-primary deleteRole'>Yes</button> 
                                                                        </a>
                                                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>";
                                    }
                                    echo "          </tbody>
                                                </table>
                                            </div>";
                                }
                            }               
                        } else if($filterB === 'D') {
                            $s = "SELECT * FROM tbrole ORDER BY RoleName DESC";
                            if($result = mysqli_query($con, $s)) {
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result)){
                                        $roleID = $row['RoleID'];
                                        $roleName = $row['RoleName'];
                                    
                                        echo "  <tr>  
                                                    <td>$roleName</td>
                                                    <td> 
                                                        <a class='EditRole' data-toggle='modal' data-target='#EditRoleModal$roleID'>
                                                            <button type='button' class='btn btn-sm btn-primary editRole'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</button>
                                                        </a>
                                                        <div class='modal fade' id='EditRoleModal$roleID' tabindex='-1' role='dialog' aria-labelledby='EditRoleModal$roleID' aria-hidden='true'>
                                                            <div class='modal-dialog' role='document'>
                                                                <div class='modal-content'>
                                                                    <form action='editRole.php' method='POST'  enctype='multipart/form-data'>
                                                                        <input type='hidden' id='rID' name='rID' value='$roleID'>
                                                                        <div class='modal-body updateRole'>
                                                                            <div class='form-group'>
                                                                                <label for='EditRoleName$roleID'>Update Role:</label>
                                                                                <input type='text' class='form-control' name='EditRoleName' id='EditRoleName$roleID' value='$roleName' placeholder='Update role' required/>
                                                                                <p id='EditRoleValidation' class='validationMsg'></p>
                                                                                </div>
                                                                        </div>
                                                                        <div class='modal-footer updateRole'>
                                                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
                                                                            <button type='submit' class='btn btn-primary'>Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>   

                                                        <a class='DeleteRoleConfirm' data-toggle='modal' data-target='#DeleteRoleModal$roleID'>
                                                            <button type='button' class='btn btn-danger btn-sm deleteEMPconfirm'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button>
                                                        </a>
                                                        <div class='modal fade' id='DeleteRoleModal$roleID' tabindex='-1' role='dialog' aria-labelledby='DeleteRoleModal$roleID' aria-hidden='true'>
                                                            <div class='modal-dialog' role='document'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header deleteRole'>
                                                                        <h5> Confirm Delete </h5>
                                                                    </div>
                                                                    <div class='modal-body deleteRole'>
                                                                        <p>Are you sure you want to delete <b>$roleName</b> role?</p>
                                                                    </div>
                                                                    <div class='modal-footer deleteRole'>
                                                                        <a class='DeleteRole' href='./deleteRole.php?roleID=$roleID'>
                                                                            <button type='button' class='btn btn-primary deleteRole'>Yes</button> 
                                                                        </a>
                                                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>";
                                    }
                                    echo "          </tbody>
                                                </table>
                                            </div>";
                                }
                            } 
                        }       
                    } else {
                            $s = "SELECT * FROM tbrole ORDER BY RoleName ASC";
                            if($result = mysqli_query($con, $s)) {
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result)){
                                        $roleID = $row['RoleID'];
                                        $roleName = $row['RoleName'];
                                    
                                        echo "  <tr>  
                                                    <td>$roleName</td>
                                                    <td> 
                                                        <a class='EditRole' data-toggle='modal' data-target='#EditRoleModal$roleID'>
                                                            <button type='button' class='btn btn-sm btn-primary editRole'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</button>
                                                        </a>
                                                        <div class='modal fade' id='EditRoleModal$roleID' tabindex='-1' role='dialog' aria-labelledby='EditRoleModal$roleID' aria-hidden='true'>
                                                            <div class='modal-dialog' role='document'>
                                                                <div class='modal-content'>
                                                                    <form action='editRole.php' method='POST'  enctype='multipart/form-data'>
                                                                        <input type='hidden' id='rID' name='rID' value='$roleID'>
                                                                        <div class='modal-body updateRole'>
                                                                            <div class='form-group'>
                                                                                <label for='EditRoleName$roleID'>Update Role:</label>
                                                                                <input type='text' class='form-control' name='EditRoleName' id='EditRoleName$roleID' value='$roleName' placeholder='Update role' required/>
                                                                                <p id='EditRoleValidation' class='validationMsg'></p>
                                                                                </div>
                                                                        </div>
                                                                        <div class='modal-footer updateRole'>
                                                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
                                                                            <button type='submit' class='btn btn-primary'>Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>   

                                                        <a class='DeleteRoleConfirm' data-toggle='modal' data-target='#DeleteRoleModal$roleID'>
                                                            <button type='button' class='btn btn-danger btn-sm deleteEMPconfirm'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button>
                                                        </a>
                                                        <div class='modal fade' id='DeleteRoleModal$roleID' tabindex='-1' role='dialog' aria-labelledby='DeleteRoleModal$roleID' aria-hidden='true'>
                                                            <div class='modal-dialog' role='document'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header deleteRole'>
                                                                        <h5> Confirm Delete </h5>
                                                                    </div>
                                                                    <div class='modal-body deleteRole'>
                                                                        <p>Are you sure you want to delete <b>$roleName</b> role?</p>
                                                                    </div>
                                                                    <div class='modal-footer deleteRole'>
                                                                        <a class='DeleteRole' href='./deleteRole.php?roleID=$roleID'>
                                                                            <button type='button' class='btn btn-primary deleteRole'>Yes</button> 
                                                                        </a>
                                                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>";
                                    }
                                    echo "          </tbody>
                                                </table>
                                            </div>";
                                }
                            } 
                    }
            
                ?>
       
                <a class='CreateRole' data-toggle='modal' data-target='#CreateRoleModal'>
                    <button type='button' class='btn btn-primary createRole'><i class="fa fa-plus" aria-hidden="true"></i> Add Role</button>
                </a>
                <div class='modal fade' id='CreateRoleModal' tabindex='-1' role='dialog' aria-labelledby='CreateRoleModal' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <form action='addRole.php' method='POST' onsubmit='return validateAddRole()'  enctype='multipart/form-data'>
                                <div class='modal-body addRole'>
                                    <div class='form-group'>
                                        <label for='AddRoleName'>Add Role:</label>
                                        <input type='text' class='form-control' name='AddRoleName' id='AddRoleName' placeholder='Enter new role' required/>
                                        <p id='AddRoleValidation' class='validationMsg'></p>
                                    </div>
                                </div>
                                <div class='modal-footer addRole'>
                                    <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
                                    <button type='submit' class='btn btn-primary'>Add</button>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>           
            </div>
        </section>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="./JS/searchRoles.js"></script>
        <script src="./JS/employeeRoles.js"></script>
        <script src="./JS/addRoleValidation.js"></script>
    </body>
</html>
