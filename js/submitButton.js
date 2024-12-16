document.addEventListener("DOMContentLoaded", function() {
    const primaryButtons = document.querySelectorAll("input[type=submit].action");
    primaryButtons.forEach(button => {
        const form = button.closest("form");
        form.addEventListener("submit", function() {
            document.querySelector('.loader').style.display = "block";
            if(button.value.includes("Update")) {
                button.value = "Updating";
            } else if (button.value.includes("Create")) {
                button.value = "Creating";
                
            } else {
                button.value = "Loading";
            }
            
            button.disabled = true;
            
        });
    });
});


