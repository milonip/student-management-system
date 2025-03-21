<?php
session_start();
include 'config.php';

if(!isset($_SESSION['username'])) {
    header('location: login.php');
}

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "DELETE FROM students WHERE id='$id'";
    mysqli_query($conn, $query);
}

header('location: dashboard.php');
?>