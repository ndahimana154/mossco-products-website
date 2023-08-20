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
            <h2>Import product</h2>
            <div class="">
                <div class="p-2">
                    <a href="admin-products.php" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> back
                    </a>
                </div>
                <?php
                    if (!isset($_GET['import-product'])) {
                        ?>
                        <p class="alert alert-danger">
                            No product sent to the server
                        </p>
                        <?php
                    }
                    else {
                        $product = $_GET['import-product'];
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
                            $current_quantity =(int) $data_product['product_quantity'];
                            ?>
                            <form action="" method="post">
                                <?php
                                    if (isset($_POST['save_product_import_BTN'])) {
                                        $Product_id = $product;
                                        $quantity =(int) $_POST['qua'];
                                        $price =(int) $_POST['pri'];
                                        $new_quantity = $current_quantity + $quantity;
                                        if ($quantity == 0) {
                                            ?>
                                            <p class="alert alert-danger">
                                                Zero import is not allowed
                                            </p>
                                            <?php
                                        }
                                        else {
                                            $save = mysqli_query($server,"INSERT into product_inventory VALUES(null,'$product','IN','$price','$quantity',now(),'Performed','$acting_admin_id')");
                                            if (!$save) {
                                                ?>
                                                <p class="alert alert-danger">
                                                    Inventory is not saved.
                                                </p>
                                                <?php
                                            }
                                            else {
                                                $update = mysqli_query($server,"UPDATE products set 
                                                    product_quantity = '$new_quantity'
                                                    -- product_price = ''
                                                    WHERE id = '$Product_id'
                                                ");
                                                if (!$update) {
                                                    ?>
                                                    <p class="alert alert-danger">
                                                        Updating product quantity failed.
                                                    </p>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <p class="alert alert-success">
                                                        Product quantity is imported successfully. The new quantity is <b><?php echo $new_quantity; ?></b>
                                                    </p>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <label for="">
                                        Product name
                                    </label>
                                    <input type="text" name="name" value="<?php echo $data_product['product_name']; ?>" placeholder="Type..." class="form-control" readonly>
                                </div>
                               
                                <div class="form-group">
                                    <label for="">
                                        Import Price
                                    </label>
                                    <input type="number" name="pri" value="<?php echo $data_product['product_price']; ?>" placeholder="Type..." class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">
                                        Import Quantity
                                    </label>
                                    <input type="number" name="qua" placeholder="Type..." class="form-control" required>
                                </div>
                                <button type="submit" name="save_product_import_BTN" class="btn btn-success">
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
