document.addEventListener("DOMContentLoaded", function() {
    const formTitle = document.getElementById("form-title");
    const formType = document.getElementById("form-type");
    const emailGroup = document.getElementById("email-group");
    const submitButton = document.getElementById("submit-button");
    const toggleMessage = document.getElementById("toggle-message");

    toggleMessage.addEventListener("click", function(event) {
        event.preventDefault();
        if (formType.value === "login") {
            formTitle.textContent = "Sign Up";
            formType.value = "signup";
            emailGroup.style.display = "block";
            submitButton.textContent = "Sign Up";
            toggleMessage.innerHTML = 'Already have an account? <a href="#" id="toggle-link">Login</a>';
        } else {
            formTitle.textContent = "Login";
            formType.value = "login";
            emailGroup.style.display = "none";
            submitButton.textContent = "Login";
            toggleMessage.innerHTML = 'Don\'t have an account? <a href="#" id="toggle-link">Sign up</a>';
        }
        attachToggleLinkEvent();
    });

    function attachToggleLinkEvent() {
        document.getElementById("toggle-link").addEventListener("click", function(event) {
            event.preventDefault();
            if (formType.value === "login") {
                formTitle.textContent = "Sign Up";
                formType.value = "signup";
                emailGroup.style.display = "block";
                submitButton.textContent = "Sign Up";
                toggleMessage.innerHTML = 'Already have an account? <a href="#" id="toggle-link">Login</a>';
            } else {
                formTitle.textContent = "Login";
                formType.value = "login";
                emailGroup.style.display = "none";
                submitButton.textContent = "Login";
                toggleMessage.innerHTML = 'Don\'t have an account? <a href="#" id="toggle-link">Sign up</a>';
            }
            attachToggleLinkEvent();
        });
    }

    attachToggleLinkEvent();
});
