const alert = document.querySelector('.alert');
if (alert) {
    setTimeout(() => {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = "0";
        setTimeout(() => alert.style.display = "none", 500);
    }, 3000);
}
