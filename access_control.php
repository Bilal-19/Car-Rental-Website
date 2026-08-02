<?php
session_start();
if (
    !isset($_SESSION['useremail']) ||
    $_SESSION['useremail'] != 'bilalmuhammadyousuf543@gmail.com'
) {
    header("Location: ../Admin/login.php");
    exit;
}
?>