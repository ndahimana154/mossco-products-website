<?php
    session_start();
    include("php/server.php");
    if (!isset($_SESION['acting_user_id'])) {
        header("admin-login.php");
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
        <div class="col-md-8 mt-5 p-3">
            <!-- Right div with dashboard content -->
            <h2>New product</h2>
            <div class="">
                <div class="p-2">
                    <a href="admin-products.php" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> back
                    </a>
                </div>
                <form action="" method="post">
                    <?php
                        if (isset($_POST['save_productBTN'])) {
                            $name = $_POST['name'];
                            $description = $_POST['descr'];
                            $price = $_POST['price'];
                            // Check the product doesn't exists
                            $check_product = mysqli_query($server,"SELECT * from products 
                                WHERE product_name = '$name'
                            ");
                            if (mysqli_num_rows($check_product) > 0) {
                                ?>
                                <p class="alert alert-danger">
                                    Product already exists
                                </p>
                                <?php
                            }
                            else {
                                $save = mysqli_query($server,"INSERT into products VALUES(null,'$name','$description','$price','0')");
                                if (!$save) {
                                    ?>
                                    <p class="alert alert-danger">
                                        Product not saved!
                                    </p>
                                    <?php
                                }
                                else {
                                    ?>
                                    <p class="alert alert-success">
                                        Product is saved successfully.
                                    </p>
                                    <?php
                                }
                            }
                        }
                    ?>
                    <div class="form-group">
                        <label for="">
                            Product name
                        </label>
                        <input type="text" name="name" placeholder="Type..." class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">
                            Product description
                        </label>
                        <textarea name="descr" placeholder="Type..." class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">
                            Product price
                        </label>
                        <input type="number" name="price" placeholder="Type..." class="form-control" required>
                    </div>
                    <button type="submit" name="save_productBTN" class="btn btn-success">
                        <i class="fa fa-save"></i> Save
                    </button>
                </form>
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
