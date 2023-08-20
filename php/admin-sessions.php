<?php
    $acting_admin_id = $_SESSION['acting_user_id'];
    if (!isset($_SESSION['acting_user_id'])) {
        header("location: admin-login.php");
    }
    // Get admin info
    $getadinfo = mysqli_fetch_array(mysqli_query($server,"SELECT * from admin WHERE user_id='$acting_admin_id'"));
    $acting_admin_username = $getadinfo['user_name'];
    // Get company names
    $get_co_names = mysqli_fetch_array(mysqli_query($server,"SELECT * from company_name
    "));
    $company_name = $get_co_names['name'];
    if ($company_name =='no company') {
        $company_name = 'MossCo';
    }
?>