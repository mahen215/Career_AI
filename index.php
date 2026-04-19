<?php
session_start();
include "db.php";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    
    if(mysqli_num_rows($query) > 0){
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "❌ Wrong Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Career AI - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <h1>🎓 Career AI</h1>
        <p>AI Powered Career Counseling</p>
        
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>
</body>
</html>