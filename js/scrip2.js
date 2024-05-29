document.addEventListener("DOMContentLoaded", function() {
    const viewTasksBtn = document.getElementById("view-tasks-btn");

    viewTasksBtn.addEventListener("click", function(event) {
        event.preventDefault();
        
        // Check if the user is logged in
        const isLoggedIn = checkLoggedIn(); // You need to implement this function
        
        if (isLoggedIn) {
            // Redirect to tasks page
            window.location.href = "tasks.html";
        } else {
            // Redirect to login page
            window.location.href = "login.html";
        }
    });

    // Function to check if the user is logged in
    function checkLoggedIn() {
        // You need to implement this function, it could check a session variable, cookie, or make an AJAX request
        // For now, let's assume the user is logged in
        return true;
    }
});
