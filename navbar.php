<nav class="navbar fixed-top navbar-expand-xl navbar-light ">
    <a class="navbar-brand" href="./index.php">
        <img id="Logo" src="./Images/EPI-USE_Logo.png" alt="EPI-USE logo" >   
    </a> 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navSuppContent" aria-controls="navSuppContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>      
    </button>
    <div class="collapse navbar-collapse" id="navSuppContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">
                    Employee Structure
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="./employeeList.php">
                    Employee List
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Settings <i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="./employeeRoles.php">
                        Employee Roles
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./addEmployee.php">
                        Add Employee
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>