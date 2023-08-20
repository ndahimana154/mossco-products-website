<?php
    session_start();
    include("php/server.php");
    include("php/admin-sessions.php");
    if (!isset($_SESSION['acting_user_id'])) {
        header("location: admin-login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MossCo IT Portfolio</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body data-spy="scroll" data-target="#navbar" data-offset="100">

    <!-- Navigation -->
    <?php
        include("php/admin-nav.php");
    ?>

    <div class="row" style="">
        <!-- Left navigation links -->
        <?php
            include("php/admin-left-links.php");
        ?>
        <!-- Dashboard Content -->
        <div class="col-md-8 mt-5">
            <!-- Right div with dashboard content -->
            <h2 class="mt-2">Dashboard || <?php echo $acting_admin_username; ?></h2>
            <div class="row p-3">
                <div class="col-md-4 m-2">
                    <div class="dashboard-box bg-primary text-light p-2 row">
                        <div class="mr-3">
                            <i class="fas fa-user-friends fa-3x mb-3 flex-1"></i>
                            <h4>Products</h4>
                        </div>
                        
                        <p class="mb-0 fa-3x">
                            <?php 
                                $get_products = mysqli_query($server,"SELECT * from products");
                                echo mysqli_num_rows($get_products);
                            ?>
                        </p>
                    </div>
                </div>
               
                
                <!-- Add more dashboard cards here -->
            </div>
            <!-- Add your dashboard components here -->
        </div>
    </div>

    <!-- Footer -->
    <?php
        // include("php/footer.php");
    ?>

    <!-- Add Bootstrap JS script link here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
