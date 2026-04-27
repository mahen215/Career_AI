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

// API Key - apni key yahan daalo
$api_key = "YOUR_API_KEY_HERE";

$ai_response = "";
$is_demo = false;

// API Key hai toh AI use karo
if($api_key != "YOUR_API_KEY_HERE" && !empty($api_key)){

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
    $ai_response = $result['content'][0]['text'] ?? "";
}

// Demo mode - API key nahi hai ya response nahi aaya
if(empty($ai_response)){
    $is_demo = true;
    $avg = ($marks_10th + $marks_12th) / 2;

    if($avg >= 80){
        $performance = "⭐ Excellent - Topper Category";
        $career1 = "Software Engineer / IIT / Medical";
        $career2 = "Data Scientist / AI Engineer";
        $career3 = "IAS / Government Officer";
        $salary = "₹8-50 LPA";
        $motivation = "Bahut acha! Tumhara future bright hai! 🌟";
    } elseif($avg >= 60){
        $performance = "✅ Good - Average Category";
        $career1 = "BCA / MCA / Software Developer";
        $career2 = "Banking / Finance";
        $career3 = "Teaching / Education";
        $salary = "₹4-15 LPA";
        $motivation = "Acha kar rahe ho! Aur mehnat karo! 💪";
    } else {
        $performance = "⚠️ Need Improvement";
        $career1 = "Diploma / ITI Courses";
        $career2 = "Business / Entrepreneurship";
        $career3 = "Vocational Training";
        $salary = "₹2-8 LPA";
        $motivation = "Himmat mat haro! Hard work se sab possible hai! 🔥";
    }

    $interest_career = "";
    if($interests == "Technology") $interest_career = "💻 Web Developer, App Developer, Cybersecurity";
    elseif($interests == "Medicine") $interest_career = "🏥 Doctor, Nurse, Pharmacist";
    elseif($interests == "Business") $interest_career = "💼 Entrepreneur, CA, MBA, Marketing Manager";
    elseif($interests == "Arts") $interest_career = "🎨 Graphic Designer, UI/UX Designer, Animator";
    elseif($interests == "Science") $interest_career = "🔬 Scientist, Researcher, Engineer";
    elseif($interests == "Sports") $interest_career = "⚽ Sports Coach, Physical Trainer";
    elseif($interests == "Law") $interest_career = "⚖️ Lawyer, Judge, Legal Advisor";
    elseif($interests == "Education") $interest_career = "📚 Teacher, Professor, Education Consultant";

    $ai_response = "
🎯 PERFORMANCE ANALYSIS
━━━━━━━━━━━━━━━━━━━━━
Student: $name (Age: $age)
10th Marks: $marks_10th% | 12th Marks: $marks_12th%
Average: $avg%
Performance Level: $performance

🏆 TOP 3 CAREER OPTIONS
━━━━━━━━━━━━━━━━━━━━━
1. $career1
2. $career2
3. $career3

🎯 INTEREST BASED CAREERS ($interests)
━━━━━━━━━━━━━━━━━━━━━
$interest_career

🗺️ CAREER ROAD MAP
━━━━━━━━━━━━━━━━━━━━━
Step 1: Apna favourite subject ($fav_subject) strong karo
Step 2: $course complete karo with good grades
Step 3: Internship / Projects banao
Step 4: Competitive exams ki taiyari karo
Step 5: Job / Higher Studies choose karo

📚 STUDY TIPS
━━━━━━━━━━━━━━━━━━━━━
✓ Rozana 6-8 ghante padhai karo
✓ $fav_subject pe focus karo
✓ Notes banao aur revise karo
✓ Mock tests dete raho
✓ Online resources use karo (YouTube, Coursera)

💰 SALARY RANGE
━━━━━━━━━━━━━━━━━━━━━
Expected Starting Salary: $salary
(Experience ke saath badhta hai)

💪 MOTIVATIONAL MESSAGE
━━━━━━━━━━━━━━━━━━━━━
$motivation
'Sapne wo nahi jo sote waqt aate hain,
sapne wo hain jo sone nahi dete!' - APJ Abdul Kalam
";
}
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

        <?php if($is_demo){ ?>
        <div style="background:rgba(233,69,96,0.1); border:1px solid rgba(233,69,96,0.3); border-radius:10px; padding:10px 15px; margin-bottom:15px;">
            <p style="color:#e94560; margin:0; font-size:13px;">🎭 Demo Mode — AI API key nahi hai. Real AI analysis ke liye API key add karo!</p>
        </div>
        <?php } ?>

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