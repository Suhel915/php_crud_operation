<?php
session_start();
include "includes/header.php";
include "includes/nav.php"; 
?>

<?php 
include "includes/db.php"; 

if (isset($_SESSION['id'])) {
   
    session_destroy();
}
    header("Location: login.php");
    exit();
?>
