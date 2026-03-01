<?php

session_start();
require_once "../config/config.php";

if(isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if($password !== $confirm_password) {
        $_SESSION['register_error'] = "Passwords do not match!";
        $_SESSION['active_form'] = "register";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $checkEmail = $conn->prepare("SELECT email FROM users WHERE email=?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmailResult = $checkEmail->get_result();
        
        if($checkEmailResult->num_rows > 0) {
            $_SESSION['register_error'] = "Email is already registered!";
            $_SESSION['active_form'] = "register";
        } else {
            $insertUser = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $insertUser->bind_param("sss", $name, $email, $hashed_password);
            $insertUser->execute();
            $insertUser->close();
        }
        $checkEmail->close();
    }

    header("Location: ../login.php");
    exit();
}

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginUser = $conn->prepare("SELECT * FROM users WHERE email=?");
    $loginUser->bind_param("s", $email);
    $loginUser->execute();
    $result = $loginUser->get_result();
    
    
    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $loginUser->close();
            header("Location: ../Main.php");
            exit();
        }
    }

    $_SESSION['login_error'] = "Invalid email or password!";
    $_SESSION['active_form'] = "login";
    $loginUser->close();
    header("Location: ../login.php");
    exit();
}
?>