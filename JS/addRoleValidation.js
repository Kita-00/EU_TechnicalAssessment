const roleRgx = /^[\w\W]{3,50}$/;

validateAddRoleName = () => {
    let role = document.getElementById("AddRoleName").value;
    let msg;
    let valid;
    if(!roleRgx.test(role)) {
        msg = "Invalid role name<br>Minimum length: 3, Maximum lenght: 50";
        valid = false;
    } else {
        msg = "Valid Role Name";
        valid = true;
    }
    document.getElementById("AddRoleValidation").innerHTML = msg;
    return valid;
}

validateAddRole = () => {
    roleVal = validateAddRoleName();

    if(roleVal === false) {
        return false;
    } else {
        return true;
    }
}

