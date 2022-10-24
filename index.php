<?php
    require_once("./config.php");
    session_start();
    $_SESSION['page'] = 'Hierarchy';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./CSS/navbar.css">
        <link rel="stylesheet" href="./CSS/index.css">
        <title>Employee Management</title>
    </head>
    <body>
        <header id="Navbar">
            <?php require("./navbar.php");?>
        </header>
        <section class='bodySection'>
            <div class="container index">
                <h2>Employee Hierarchy</h2> 
                <div class='searchBoxDIV'>
                    <input type='text' id='HierarchySearch' class='searchInput' onkeyup='searcHierarchy()' placeholder='Search Employee Number..'>
                    <i class='fa fa-search' aria-hidden='true'></i>
                </div>
                <?php
                    employeeHierarchy('');

                    function employeeHierarchy($MngrID){
                        global $con, $n;
                        $sql = "SELECT * FROM tbemployee WHERE ReportingLineMngr = '$MngrID';";
                        $r = mysqli_query($con, $sql);       
                        if (mysqli_num_rows($r) > 0) {
                            $n+=8;
                            while ($row = mysqli_fetch_array($r)) {
                                $EMPnum = $row['EmployeeNumber'];
                                $EMPname = $row['EmployeeName'];
                                $EMPsurname = $row['EmployeeSurname'];
                                $EMPemail = $row['Email'];   
                                $defaultImg = 'wavatar';
                                $size = '80';
                                $gravatar = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $EMPemail ) ) ) . "?d=" . $defaultImg  . "&s=" . $size;

                                echo "  <div class='col-4 hierarchyDiv' name='cContainer' style='margin-left:".$n."mm'>             
                                            <div class='card employeeCard'>
                                                <div class='row no-gutters'>
                                                    <div class='col-3'>
                                                        <a class='hierarchPic'  href='./profileView.php?EMPnum=$EMPnum'>
                                                            <img class='GravImg' src='$gravatar' alt='ProfileGravatar' />                               
                                                        </a>
                                                    </div>  
                                                    <div class='col-9'>
                                                        <div class='card-block'>  
                                                            <div class='card-title'>
                                                                <h4> 
                                                                    $EMPnum
                                                                </h4>
                                                            </div>
                                                            <div class='card-text'>
                                                                <p>$EMPname $EMPsurname</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                             
                                    employeeHierarchy($EMPnum);                  
                            }
                            $n-=8;
                        }
                    }
            
                ?>
            </div>
        </section>
             
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>      
        <script src="./JS/index.js"></script>
    </body>                                        
</html>

