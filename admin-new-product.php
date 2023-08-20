<?php
    session_start();
    include("php/server.php");
    if (!isset($_SESSION['acting_user_id'])) {
        header("Location: admin-login.php");
        exit(); // Don't forget to exit after redirect
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

    <div class="row">
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
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <?php
                        // Existing code for form submission and error handling

                        if (isset($_POST['save_productBTN'])) {
                            $name = $_POST['name'];
                            $name = mysqli_real_escape_string($server, $name);
                            $description = $_POST['descr'];
                            $description = mysqli_real_escape_string($server, $description);
                            $price = $_POST['price'];

                            // Image Upload
                            $image_name = $_FILES['product_image']['name'];
                            $image_tmp = $_FILES['product_image']['tmp_name'];
                            $image_type = $_FILES['product_image']['type'];

                            $allowed_extensions = array("image/jpeg", "image/jpg", "image/png");
                            // Check if the product name exists 
                            $checkNameexiss = mysqli_query($server,"SELECT * from products
                                WHERE product_name = '$name' 
                                AND product_status = 'On-sale'
                            ");
                            if (mysqli_num_rows($checkNameexiss) > 0) {
                                ?>
                                <p class="alert alert-danger">
                                    Product already exists
                                </p>
                                <?php
                            }
                            elseif (in_array($image_type, $allowed_extensions)) {
                                $image_path = "images/products/" . $image_name;
                                move_uploaded_file($image_tmp, $image_path);

                                // Database Query to Store Image Name
                                $save = mysqli_query($server, "INSERT INTO products 
                                                              VALUES (null, '$name', '$image_name', '$description', '$price', '0', 'On-sale')");
                                
                                if (!$save) {
                                    echo '<p class="alert alert-danger">Product not saved!</p>';
                                } else {
                                    echo '<p class="alert alert-success">Product is saved successfully.</p>';
                                }
                            } else {
                                echo '<p class="alert alert-danger">Only JPEG, JPG, and PNG images are allowed.</p>';
                            }
                        }
                    ?>
                    <div class="form-group">
                        <label for="">Product name</label>
                        <input type="text" name="name" placeholder="Type..." class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Product description</label>
                        <textarea name="descr" placeholder="Type..." class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Product price</label>
                        <input type="number" name="price" placeholder="Type..." class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Product image</label>
                        <input type="file" name="product_image" accept="image/*" class="form-control-file" required>
                    </div>
                    <button type="submit" name="save_productBTN" class="btn btn-success">
                        <i class="fa fa-save"></i> Save
                    </button>
                </form>
            </div>
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
