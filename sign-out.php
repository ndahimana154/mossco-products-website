<?php
    session_start();
    if (isset($_GET['admin'])) {
        session_destroy();
        header("location: admin-login.php");
    }
?>