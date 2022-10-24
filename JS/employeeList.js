function toggleAradio() {
    if(document.getElementById("Asce").checked == true)
    {
        document.getElementById("Desc").checked = false;
    }
}

function toggleBradio() {
    if(document.getElementById("Desc").checked == true)
    {
        document.getElementById("Asce").checked = false;
    }
}