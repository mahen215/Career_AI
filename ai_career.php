<?php
session_start();
include "db.php";

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

$name = $_POST['name'];
$age = $_POST['age'];
$marks_10th = $_POST['marks_10th'];
$marks_12th = $_POST['marks_12th'];
$interests = $_POST['interests'];
$fav_subject = $_POST['fav_subject'];
$course = $_POST['course'];

// Save to database
$query = "INSERT INTO students (name, age, marks_10th, marks_12th, interests, fav_subject, course) 
          VALUES ('$name', '$age', '$marks_10th', '$marks_12th', '$interests', '$fav_subject', '$course')";
mysqli_query($conn, $query);

// AI Prompt
$prompt = "You are an expert career counselor. Analyze this student profile and give detailed guidance in Hindi and English mixed (Hinglish):

Student Name: $name
Age: $age years
10th Marks: $marks_10th%
12th Marks: $marks_12th%
Interests: $interests
Favourite Subject: $fav_subject
Desired Course: $course

Please provide:
1. 🎯 Performance Analysis (marks ke basis pe)
2. 🏆 Top 3 Best Career Options (with reasons)
3. 🗺️ Career Road Map (step by step)
4. 📚 Study Tips (subject wise)
5. 💰 Salary Range (each career ke liye)
6. 💪 Motivational Message

Format it nicely with emojis and clear sections.";

// API Key - apni key yahan daalo
$api_key = "YOUR_API_KEY_HERE";

$data = [
    "model" => "claude-sonnet-4-20250514",
    "max_tokens" => 1500,
    "messages" => [
        ["role" => "user", "content" => $prompt]
    ]
];

$ch = curl_init("https://api.anthropic.com/v1/messages");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "x-api-key: $api_key",
    "anthropic-version: 2023-06-01"
]);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
$ai_response = $result['content'][0]['text'] ?? "AI response nahi aaya. Please try again.";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career AI - Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="card card-wide">

        <div class="nav">
            <h2>🤖 AI Career <span style="color:#e94560">Analysis</span></h2>
            <a href="dashboard.php" style="color:#e94560">← Dashboard</a>
        </div>

        <div style="background:rgba(255,255,255,0.05); border-radius:15px; padding:20px; margin-bottom:20px;">
            <h3 style="color:#e94560; margin-bottom:10px;">👤 Student Profile</h3>
            <p style="color:#fff; text-align:left; margin:5px 0;">Name: <strong><?php echo $name; ?></strong></p>
            <p style="color:#fff; text-align:left; margin:5px 0;">Age: <strong><?php echo $age; ?></strong></p>
            <p style="color:#fff; text-align:left; margin:5px 0;">10th Marks: <strong><?php echo $marks_10th; ?>%</strong></p>
            <p style="color:#fff; text-align:left; margin:5px 0;">12th Marks: <strong><?php echo $marks_12th; ?>%</strong></p>
            <p style="color:#fff; text-align:left; margin:5px 0;">Interests: <strong><?php echo $interests; ?></strong></p>
            <p style="color:#fff; text-align:left; margin:5px 0;">Favourite Subject: <strong><?php echo $fav_subject; ?></strong></p>
            <p style="color:#fff; text-align:left; margin:5px 0;">Course: <strong><?php echo $course; ?></strong></p>
        </div>

        <h3 style="color:#e94560; margin-bottom:15px;">🤖 AI Career Report</h3>
        <div class="result-box">
            <?php echo nl2br(htmlspecialchars($ai_response)); ?>
        </div>

        <br>
        <a href="student_form.php"><button class="btn">🔄 New Analysis</button></a>
        <a href="dashboard.php"><button class="btn btn-secondary">← Dashboard</button></a>

    </div>
</div>
</body>
</html>