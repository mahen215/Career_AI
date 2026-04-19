<?php
session_start();
include "db.php";

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career AI - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="card card-wide">
        
        <div class="nav">
            <h2>🎓 Career <span style="color:#e94560">AI</span> Dashboard</h2>
            <a href="logout.php">Logout →</a>
        </div>
        
        <p>Welcome, <?php echo $_SESSION['admin']; ?>! Choose an option below.</p>
        
        <div class="dashboard-grid">
            
            <a href="student_form.php" class="dash-card">
                <div class="icon">📝</div>
                <h3>New Analysis</h3>
                <p>Student career analysis karo</p>
            </a>
            
            <a href="history.php" class="dash-card">
                <div class="icon">📊</div>
                <h3>History</h3>
                <p>Purane results dekho</p>
            </a>
            
            <a href="student_form.php" class="dash-card">
                <div class="icon">🤖</div>
                <h3>AI Career Guide</h3>
                <p>AI se career suggestions lo</p>
            </a>
            
            <a href="student_form.php" class="dash-card">
                <div class="icon">📚</div>
                <h3>Study Tips</h3>
                <p>Subject wise tips lo</p>
            </a>
            
            <a href="student_form.php" class="dash-card">
                <div class="icon">💰</div>
                <h3>Salary Info</h3>
                <p>Career salary range dekho</p>
            </a>
            
            <a href="student_form.php" class="dash-card">
                <div class="icon">🗺️</div>
                <h3>Road Map</h3>
                <p>Career road map dekho</p>
            </a>
            
        </div>
    </div>
</div>
</body>
</html>