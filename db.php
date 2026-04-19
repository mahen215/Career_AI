<?php
$conn = mysqli_connect("localhost", "root", "", "career_ai");

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
