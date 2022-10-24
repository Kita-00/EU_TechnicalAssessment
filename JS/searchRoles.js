function searchRoles() {
    let input;
    let lowerInput;
    let table;
    let tableR;
    let tableD;
    let i;
    let textValue;
    
    input = document.getElementById("roleSearch");
    lowerInput = input.value.toLowerCase();
    table = document.getElementById("TableOfRoles");
    tableR = table.getElementsByTagName("tr");
    
    for (i = 0; i < tableR.length; i++) {
        tableD = tableR[i].getElementsByTagName("td")[0];
        if (tableD) {
            textValue = tableD.textContent || tableD.innerText;
            if (textValue.toLowerCase().indexOf(lowerInput) > -1) {
                tableR[i].style.display = "";
            } else {
                tableR[i].style.display = "none";
            }
        }       
    }
}