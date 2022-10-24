<?php
    ini_set('allow_url_fopen',1);
    switch(@parse_url($_SERVER['REQUEST_URI'])['path']) {
        case '/':
            require 'index.php'
            break;
        case '/index':
            require 'index.php'
            break;
        case '/index.php':
            require 'index.php'
            break;
        case '/employeeList':
            require 'employeeList.php'
            break;
        case '/employeeList.php':
            require 'employeeList.php'
            break;
        case '/employeeRoles':
            require 'employeeRoles.php'
            break;
        case '/employeeRoles.php':
            require 'employeeRoles.php'
            break;
        case '/addEmployee':
            require 'addEmployee.php'
            break;
        case '/addEmployee.php':
            require 'addEmployee.php'
            break;
        default:
            http_response_code(404);
            echo @parse_url($_SERVER['REQUEST_URI'])['path'];
            exit("Not Found");
    }

?>