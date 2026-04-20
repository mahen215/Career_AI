<?php
session_start();
include "db.php";

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career AI - History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="card card-wide">

        <div class="nav">
            <h2>📊 Analysis <span style="color:#e94560">History</span></h2>
            <a href="dashboard.php" style="color:#e94560">← Back</a>
        </div>

        <?php if(mysqli_num_rows($result) == 0){ ?>
            <p style="color:#a0a0b0; text-align:center;">Abhi koi record nahi hai.</p>
        <?php } else { ?>

        <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; color:#fff;">
            <tr style="background:rgba(233,69,96,0.2);">
                <th style="padding:12px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.1);">ID</th>
                <th style="padding:12px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.1);">Name</th>
                <th style="padding:12px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.1);">Age</th>
                <th style="padding:12px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.1);">10th</th>
                <th style="padding:12px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.1);">12th</th>
                <th style="padding:12px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.1);">Interests</th>
                <th style="padding:12px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.1);">Course</th>
                <th style="padding:12px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.1);">Action</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <tr style="border-bottom:1px solid rgba(255,255,255,0.05);">
                <td style="padding:12px;"><?php echo $row['id']; ?></td>
                <td style="padding:12px;"><?php echo $row['name']; ?></td>
                <td style="padding:12px;"><?php echo $row['age']; ?></td>
                <td style="padding:12px;"><?php echo $row['marks_10th']; ?>%</td>
                <td style="padding:12px;"><?php echo $row['marks_12th']; ?>%</td>
                <td style="padding:12px;"><?php echo $row['interests']; ?></td>
                <td style="padding:12px;"><?php echo $row['course']; ?></td>
                <td style="padding:12px;">
                    <a href="delete_history.php?id=<?php echo $row['id']; ?>" 
                       onclick="return confirm('Delete karo?')"
                       style="color:#e94560;">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        </div>

        <?php } ?>

        <br>
        <a href="dashboard.php"><button class="btn btn-secondary">← Dashboard</button></a>

    </div>
</div>
</body>
</html>