<?php
session_start();
if (isset($_SESSION['useremail'])) {
    if ($_SESSION['useremail'] != 'bilalmuhammadyousuf543@gmail.com') {
        header("Location: ../index.php");
    }
}
?>