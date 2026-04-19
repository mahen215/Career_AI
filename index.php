<?php
session_start();
include "db.php";

if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
    exit();
}

$error = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    
    if(mysqli_num_rows($query) > 0){
        $_SESSION['admin'] = $username;
        if(isset($_POST['remember'])){
            setcookie('remember_user', $username, time() + (86400 * 30));
        }
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}

$remembered = isset($_COOKIE['remember_user']) ? $_COOKIE['remember_user'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career AI - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0f0c29;
            overflow: hidden;
        }

        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
        }

        .bg-animation span {
            position: absolute;
            display: block;
            width: 20px; height: 20px;
            background: rgba(233, 69, 96, 0.15);
            animation: animate 25s linear infinite;
            bottom: -150px;
            border-radius: 50%;
        }

        .bg-animation span:nth-child(1)  { left: 25%; width: 80px;  height: 80px;  animation-delay: 0s; }
        .bg-animation span:nth-child(2)  { left: 10%; width: 20px;  height: 20px;  animation-delay: 2s; animation-duration: 12s; }
        .bg-animation span:nth-child(3)  { left: 70%; width: 20px;  height: 20px;  animation-delay: 4s; }
        .bg-animation span:nth-child(4)  { left: 40%; width: 60px;  height: 60px;  animation-delay: 0s; animation-duration: 18s; }
        .bg-animation span:nth-child(5)  { left: 65%; width: 20px;  height: 20px;  animation-delay: 0s; }
        .bg-animation span:nth-child(6)  { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
        .bg-animation span:nth-child(7)  { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
        .bg-animation span:nth-child(8)  { left: 50%; width: 25px;  height: 25px;  animation-delay: 15s; animation-duration: 45s; }
        .bg-animation span:nth-child(9)  { left: 20%; width: 15px;  height: 15px;  animation-delay: 2s;  animation-duration: 35s; }
        .bg-animation span:nth-child(10) { left: 85%; width: 150px; height: 150px; animation-delay: 0s;  animation-duration: 11s; }

        @keyframes animate {
            0%   { transform: translateY(0) rotate(0deg);   opacity: 1; border-radius: 50%; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; }
        }

        /* 3D Flip Container */
        .flip-container {
            perspective: 1000px;
            z-index: 1;
        }

        .flipper {
            transition: transform 0.8s cubic-bezier(0.4, 0.2, 0.2, 1);
            transform-style: preserve-3d;
            position: relative;
            width: 420px;
            height: 520px;
        }

        .flipper.flipped {
            transform: rotateY(180deg);
        }

        .front, .back {
            backface-visibility: hidden;
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 45px rgba(0,0,0,0.5);
        }

        .back {
            transform: rotateY(180deg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 8px;
            font-size: 28px;
        }

        h1 span { color: #e94560; }

        .subtitle {
            color: #a0a0b0;
            text-align: center;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #a0a0b0;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 40px 12px 16px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            outline: none;
            transition: all 0.3s;
        }

        .form-group input:focus {
            border-color: #e94560;
            background: rgba(255,255,255,0.12);
            box-shadow: 0 0 15px rgba(233,69,96,0.2);
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 38px;
            cursor: pointer;
            font-size: 18px;
            color: #a0a0b0;
            transition: color 0.3s;
        }

        .toggle-password:hover { color: #e94560; }

        .caps-warning {
            color: #ffaa00;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #e94560;
            cursor: pointer;
        }

        .remember-row label {
            color: #a0a0b0;
            font-size: 13px;
            cursor: pointer;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #e94560, #c62a47);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            letter-spacing: 1px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(233,69,96,0.5);
        }

        .btn:active { transform: translateY(0); }

        .error {
            background: rgba(233,69,96,0.15);
            border: 1px solid #e94560;
            color: #e94560;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 13px;
            text-align: center;
            margin-bottom: 15px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* Back side */
        .back h2 { color: #fff; margin-bottom: 10px; font-size: 22px; }
        .back p  { color: #a0a0b0; text-align: center; font-size: 14px; margin-bottom: 20px; }

        .info-box {
            background: rgba(233,69,96,0.1);
            border: 1px solid rgba(233,69,96,0.3);
            border-radius: 12px;
            padding: 20px;
            width: 100%;
            margin-bottom: 20px;
        }

        .info-box p {
            color: #fff;
            font-size: 14px;
            margin: 5px 0;
            text-align: left;
        }

        .info-box span { color: #e94560; font-weight: bold; }

        .btn-flip {
            background: transparent;
            border: 1px solid #e94560;
            color: #e94560;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-flip:hover {
            background: #e94560;
            color: #fff;
        }
    </style>
</head>
<body>

<!-- Animated Background -->
<div class="bg-animation">
    <span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span>
</div>

<!-- 3D Flip Card -->
<div class="flip-container">
    <div class="flipper" id="flipper">

        <!-- FRONT: Login Form -->
        <div class="front">
            <h1>🎓 Career <span>AI</span></h1>
            <p class="subtitle">AI Powered Career Counseling System</p>

            <?php if($error != ""){ ?>
                <div class="error">⚠️ <?php echo $error; ?></div>
            <?php } ?>

            <form method="POST">
                <div class="form-group">
                    <label>👤 Username</label>
                    <input type="text" name="username" placeholder="Enter username" 
                           value="<?php echo $remembered; ?>" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label>🔒 Password</label>
                    <input type="password" name="password" id="passwordInput" 
                           placeholder="Enter password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                    <div class="caps-warning" id="capsWarning">⚠️ Caps Lock is ON!</div>
                </div>

                <div class="remember-row">
                    <input type="checkbox" name="remember" id="remember"
                           <?php echo $remembered ? 'checked' : ''; ?>>
                    <label for="remember">Remember Me</label>
                </div>

                <button type="submit" name="login" class="btn">🚀 Login</button>
            </form>

            <br>
            <center>
                <button class="btn-flip" onclick="flipCard()">ℹ️ About Project</button>
            </center>
        </div>

        <!-- BACK: About -->
        <div class="back">
            <h2>🤖 About Career AI</h2>
            <p>AI Powered Career Counseling System built with PHP & Claude AI</p>

            <div class="info-box">
                <p>👨‍💻 <span>Developer:</span> Mahen</p>
                <p>🛠️ <span>Tech:</span> PHP + MySQL + Claude AI</p>
                <p>🎯 <span>Features:</span> 5 AI Tools</p>
                <p>📊 <span>Database:</span> MySQL</p>
                <p>🚀 <span>Version:</span> 1.0.0</p>
            </div>

            <button class="btn-flip" onclick="flipCard()">← Back to Login</button>
        </div>

    </div>
</div>

<script>
    // 3D Flip
    function flipCard() {
        document.getElementById('flipper').classList.toggle('flipped');
    }

    // Show/Hide Password
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon = document.querySelector('.toggle-password');
        if(input.type === 'password'){
            input.type = 'text';
            icon.textContent = '🙈';
        } else {
            input.type = 'password';
            icon.textContent = '👁️';
        }
    }

    // Caps Lock Warning
    document.getElementById('passwordInput').addEventListener('keyup', function(e){
        const capsWarning = document.getElementById('capsWarning');
        if(e.getModifierState('CapsLock')){
            capsWarning.style.display = 'block';
        } else {
            capsWarning.style.display = 'none';
        }
    });
</script>

</body>
</html> 