document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");
    const loginLink = document.getElementById("loginLink");
    const signupLink = document.getElementById("signupLink");

    loginLink.addEventListener("click", function(e) {
        e.preventDefault();
        loginForm.classList.remove("hidden");
        signupForm.classList.add("hidden");
    });

    signupLink.addEventListener("click", function(e) {
        e.preventDefault();
        loginForm.classList.add("hidden");
        signupForm.classList.remove("hidden");
    });

    loginForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const username = document.getElementById("loginUsername").value;
        const password = document.getElementById("loginPassword").value;
        // Validate username and password, and perform login logic
    });

    signupForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const username = document.getElementById("signupUsername").value;
        const email = document.getElementById("signupEmail").value;
        const password = document.getElementById("signupPassword").value;
        // Validate username, email, and password, and perform signup logic
    });
});
