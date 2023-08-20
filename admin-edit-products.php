<?php
    session_start();
    include("php/server.php");
    include("php/admin-sessions.php");
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
            <h2>Edit product</h2>
            <div class="">
                <div class="p-2">
                    <a href="admin-products.php" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> back
                    </a>
                </div>
                <?php
                    if (!isset($_GET['edit-product'])) {
                        ?>
                        <p class="alert alert-danger">
                            No product sent to the server
                        </p>
                        <?php
                    }
                    else {
                        $product = $_GET['edit-product'];
                        $get_product = mysqli_query($server,"SELECT * from products WHERE id = '$product'");
                        if (mysqli_num_rows($get_product) < 1) {
                            ?>
                            <p class="alert alert-danger">
                                Product not found!
                            </p>
                            <?php
                        }
                        else {
                            $data_product = mysqli_fetch_array($get_product);
                            ?>
                            <form action="" method="post">
                            <?php
                                    if (isset($_POST['Edit_productBTN'])) {
                                        $name = $_POST['name'];
                                        $name = mysqli_real_escape_string($server,$name);
                                        $description = $_POST['descr'];
                                        $description = mysqli_real_escape_string($server,$description);
                                        $price = $_POST['price'];
                                        // Check the product doesn't exists
                                        $check_product = mysqli_query($server,"SELECT * from products 
                                            WHERE product_name = '$name' 
                                            AND id != '$product'
                                            AND product_status = 'On-sale'
                                        ");
                                        if (mysqli_num_rows($check_product) > 0) {
                                            ?>
                                            <p class="alert alert-danger">
                                                Product already exists
                                            </p>
                                            <?php
                                        }
                                        else {
                                            $update = mysqli_query($server,"UPDATE products set 
                                                product_name = '$name',
                                                product_price = '$price',
                                                product_description = '$description'
                                                WHERE id = '$product'
                                            ");
                                            if (!$update) {
                                                ?>
                                                <p class="alert alert-danger">
                                                    Updating product failed.
                                                </p>
                                                <?php
                                            }
                                            else {
                                                ?>
                                                <p class="alert alert-success">
                                                    Product is updated successfully.
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
                                    <input type="text" name="name" placeholder="Type..." class="form-control" value="<?php echo $data_product['product_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">
                                        Product description
                                    </label>
                                    <textarea name="descr" placeholder="Type..." class="form-control" required><?php echo $data_product['product_description']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">
                                        Product price
                                    </label>
                                    <input type="number" name="price" placeholder="Type..." class="form-control" value="<?php echo $data_product['product_price']; ?>" required>
                                </div>
                                <button type="submit" name="Edit_productBTN" class="btn btn-success">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </form>
                            <?php
                        }
                    }
                ?>
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
