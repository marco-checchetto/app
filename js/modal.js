function popup() {
    modal = document.getElementById('modal');
    
    if (modal.style.display == "block") {
        modal.style.display = "none";
    } else {
        modal.style.display = "block"
    }
}