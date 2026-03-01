<?php

session_start();

$errors=[
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error)  {
    return!empty($error) ? "<p style='color:red;'>$error</p>" : "";
}

function activeForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/Hats.css">
    <style>
        body {
            background: linear-gradient(to right, #f5f5f5 0%, #aaaaaa 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    

    <div class="container">
        <div class="form-box <?= activeForm('login', $activeForm) ?>" id="login-form">
            <form action="auth/login_register.php" method="post">
                <h2>Login</h2>
                <?=  showError($errors['login']) ?>
                <input type="email" name="email" placeholder="Email"required>
                <input type="password" name="password" id="myInput" placeholder="Password"required>
                <div class="checkbox-group">
                    <input type="checkbox" id="showPassword" onclick="myFunction()">
                    <label for="showPassword">Show Password</label>
                </div>
                <button type="submit" name="login">Login</button>
                <p class="message">Not registered? <a href="#" onclick="showForm('register-form')">Create an account</a></p>
            </form>
        </div>



        <div class="form-box <?= activeForm('register', $activeForm) ?>" id="register-form">
            <form action="auth/login_register.php" method="post" onsubmit="return validatePassword()">
                <h2>Register</h2>
                <?=  showError($errors['register']) ?>
                <input type="text" name="name" placeholder="Name"required>
                <input type="email" name="email" placeholder="Email"required>
                <input type="password" name="password" id="password" placeholder="Password"required>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"required>
                <p id="error" style="color:red;"></p>
                <button type="submit" name="register">Register</button>
                <p class="message">Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
            </form>
        </div>
    </div>

    





    <script src="assets/js/script.js"></script>
</body>
</html>