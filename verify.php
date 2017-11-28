<?php
    // Flag that this user is using an alternate Sign-In
    session_start();
    $_SESSION['altLogin'] = true;
    header("Location: dashboard.php");
?>