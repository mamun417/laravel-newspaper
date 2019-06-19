function openNav(data) {
    document.getElementById(data).style.width = "100%";
}

function closeNav(data) {
    document.getElementById(data).style.width = "0";
}

function open_mega_menu(data) {
    document.getElementById(data).style.visibility = "visible";
    document.getElementById(data).style.opacity = "1";
    document.getElementById("overlay").style.display = "block";
}
function close_mega_menu(data) {
    document.getElementById(data).style.visibility = "hidden";
    document.getElementById(data).style.opacity = "0";
    document.getElementById("overlay").style.display = "none";
}

// close mega menu if click outside of window
function overlay_click(overlay) {
    document.getElementById("all_category").style.visibility = "hidden";
    document.getElementById("all_category").style.opacity = "0";
    document.getElementById(overlay).style.display = "none";
}