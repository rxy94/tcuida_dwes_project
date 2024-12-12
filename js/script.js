/*************** index.php - eye-icon  ***************/
const togglePassword = document.getElementById("togglePassword");
const passwordField = document.getElementById("password");

togglePassword.addEventListener("click", function() {
    const type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;

    if (type === "password") {
        togglePassword.innerHTML = "<i class=\"fa-regular fa-eye-slash\"></i>";
    } else {
        togglePassword.innerHTML = "<i class=\"fa-regular fa-eye\"></i>";
    }
});
