<?php
session_start();
unset($_SESSION['user']); //G: unset session
header("location:index.php");
?>