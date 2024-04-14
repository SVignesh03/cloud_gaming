function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;

    if (password != confirm_password) {
        document.getElementById("message").innerHTML = "Passwords do not match.";
        return false; // Prevent form submission
    } else {
        document.getElementById("message").innerHTML = "";
        return true; // Allow form submission
    }
}

function show_or_hide() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eye");
    const type = passwordInput.getAttribute("type");

    if (type === "password") {
        passwordInput.setAttribute("type", "text");
        eyeIcon.src = "eye-off.png"; // Replace with the eye icon with a line through it to indicate password is visible
    } else {
        passwordInput.setAttribute("type", "password");
        eyeIcon.src = "eye.png"; // Replace with the normal eye icon to indicate password is hidden
    }
}

function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eye");
    const type = passwordInput.getAttribute("type");

    if (type === "password") {
        passwordInput.setAttribute("type", "text");
        eyeIcon.src = "eye-off.png"; // Replace with the eye icon with a line through it to indicate password is visible
    } else {
        passwordInput.setAttribute("type", "password");
        eyeIcon.src = "eye.png"; // Replace with the normal eye icon to indicate password is hidden
    }
}

 // togglePasswordButton.addEventListener("click", function () {
//     print("Password toggle");
//     const type = passwordInput.getAttribute("type");
//     if (type === "password") {
//         passwordInput.setAttribute("type", "text");
//     } else {
//         passwordInput.setAttribute("type", "password");
//     }
// });