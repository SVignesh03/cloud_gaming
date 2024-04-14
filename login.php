<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="Logo.png" sizes="16x16">
    <script src="script.js"></script>
</head>
<body>
    <form action="login_process.php" method="post">
        <h2>User Login</h2>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        
        <label for="password">Password:</label>
        <div class="password-wrapper">
            <input type="password" id="password" name="password" required> <!--oninput="show_or_hide()">-->
            <img id="eye" src="eye.png" alt="Toggle Password Visibility" onclick="togglePasswordVisibility()">
        </div>
        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
        <div id="bottom">
            <input type="submit" value="Login"><br>
            <label id="new"> New user? <a href = "registeration.php"> Register </a> </label>
        </div> 
    </form>
</body>
</html>
