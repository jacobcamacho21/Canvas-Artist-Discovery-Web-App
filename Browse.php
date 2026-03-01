<?php
session_start();

include 'config/config.php';
// only fetch the currently logged in user based on session email
$userEmail = $_SESSION['email'] ?? '';

if ($userEmail) {
    // prepare statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT name,email FROM users WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // no user logged in, set result to null so we can handle it later
    $result = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Canvas</title>
    <link rel="stylesheet" href="assets/css/Hats.css">
    <style>
        body{
            background-color: rgb(255, 255, 255);
        }
    </style>
</head>
<body>


    <nav class="navbar">
        <div class="navdiv">
            <div class="logo"><a href="Main.php">Canvas</a></div>
            <ul>
                <li><a href="Main.php">Home</a></li>
                <li><a href="Browse.php">Artists</a></li>
                <li><a href ="#" id="accountView"><img src="https://www.shutterstock.com/image-vector/user-login-authenticate-icon-human-600nw-1365533969.jpg" height="30px" width="30px" class="sign"></a></li>

            </ul>
        </div>
    </nav>

    <div class="profileBar" id="profileBar">
        <h2>Profile</h2>
        <span class="close" id="closeBar">&times;</span>
        <img src="https://www.shutterstock.com/image-vector/user-login-authenticate-icon-human-600nw-1365533969.jpg" alt="PFP" class="profilePic">
        <div class="profileInfo">
            <?php
            // show information only for the logged in user
            if (!empty($_SESSION['email']) && $result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='profileName'>" . htmlspecialchars($row["name"]) . "</div>\n"
                   . "<div class='profileEmail'>" . htmlspecialchars($row["email"]) . "</div>";
            } elseif (empty($_SESSION['email'])) {
                echo "<div class='profileName'>Not signed in</div>";
            } else {
                echo "<div class='profileName'>No user found</div>";
            }
            ?>
        </div>

        <?php if(!empty($_SESSION['email'])): ?>
            <form action="auth/logout.php" method="post">
                <button class="logout-btn" id="logout-btn" type="submit">Logout</button>
            </form>
        <?php else: ?>
            <button class="signin-btn" id="signin-btn" onclick="window.location='login.php'">Sign In</button>
        <?php endif; ?>
    </div>

    <div class="artists">
        <li><a href="https://www.instagram.com/samdoesarts/?hl=en" target="_blank"><img src="assets/img/Sam.png" class="sam"></a></li>
        <li><a href="https://www.instagram.com/ethanbecker70/" target="_blank"><img src="assets/img/Ethan.png" class="ethan"></a></li>
        <li><a href="https://www.instagram.com/rossdraws/" target="_blank"><img src="assets/img/Ross.png" class="ross"></a></li>
        <li><a href="https://www.instagram.com/guweiz/" target="_blank"><img src="assets/img/Guweiz.png" class="guweiz"></a></li>
        <li><a href="https://www.instagram.com/wlop/" target="_blank"><img src="assets/img/WLOP.png" class="wlop"></a></li>
        <li><a href="https://www.instagram.com/angelganev/" target="_blank"><img src="assets/img/Ganev.png" class="ganev"></a></li>
    </div>
<footer>
    <div class="footer">
    <div class="footerNav">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
    </div>
    <div class="footerBottom">
        <p>Copyright &copy;Canvas, All rights reserved. </p>
    </div>
    </div>
</footer>
    <script src="assets/js/script.js"></script>
</body>
</html>