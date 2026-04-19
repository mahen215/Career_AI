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
    <title>Career AI - Student Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="nav">
            <h2>📝 Student <span style="color:#e94560">Details</span></h2>
            <a href="dashboard.php" style="color:#e94560">← Back</a>
        </div>
        <form method="POST" action="ai_career.php">
            <div class="form-group">
                <label>Student Name</label>
                <input type="text" name="name" placeholder="Enter full name" required>
            </div>
            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" placeholder="Enter age" min="10" max="30" required>
            </div>
            <div class="form-group">
                <label>10th Marks (%)</label>
                <input type="number" name="marks_10th" placeholder="Enter 10th marks" min="0" max="100" required>
            </div>
            <div class="form-group">
                <label>12th Marks (%)</label>
                <input type="number" name="marks_12th" placeholder="Enter 12th marks" min="0" max="100" required>
            </div>
            <div class="form-group">
                <label>Interests</label>
                <select name="interests" required>
                    <option value="">-- Select Interest --</option>
                    <option value="Technology">💻 Technology</option>
                    <option value="Medicine">🏥 Medicine</option>
                    <option value="Business">💼 Business</option>
                    <option value="Arts">🎨 Arts & Design</option>
                    <option value="Science">🔬 Science</option>
                    <option value="Sports">⚽ Sports</option>
                    <option value="Law">⚖️ Law</option>
                    <option value="Education">📚 Education</option>
                </select>
            </div>
            <div class="form-group">
                <label>Favourite Subject</label>
                <select name="fav_subject" required>
                    <option value="">-- Select Subject --</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Science">Science</option>
                    <option value="Computer">Computer</option>
                    <option value="English">English</option>
                    <option value="Biology">Biology</option>
                    <option value="Commerce">Commerce</option>
                    <option value="History">History</option>
                    <option value="Geography">Geography</option>
                </select>
            </div>
            <div class="form-group">
                <label>Current/Desired Course</label>
                <select name="course" required>
                    <option value="">-- Select Course --</option>
                    <option value="Engineering">Engineering (B.Tech)</option>
                    <option value="Medical">Medical (MBBS)</option>
                    <option value="BCA">BCA / MCA</option>
                    <option value="MBA">MBA / BBA</option>
                    <option value="Arts">BA / MA</option>
                    <option value="Science">B.Sc / M.Sc</option>
                    <option value="Law">LLB</option>
                    <option value="Design">B.Design</option>
                </select>
            </div>
            <button type="submit" class="btn">🤖 Get AI Career Analysis →</button>
        </form>
    </div>
</div>
</body>
</html>