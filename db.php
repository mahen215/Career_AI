<?php
$conn = mysqli_connect("db", "root", "root", "career_ai");

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>