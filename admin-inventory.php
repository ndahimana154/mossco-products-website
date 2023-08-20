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
            <h2>Inventory Management</h2>
            <div class="">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date & time</th>
                            <th>Product</th>
                            <th>Action type</th>
                            <th>Action quantity</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count=1;
                            $get_products = mysqli_query($server,"SELECT * from
                                product_inventory,products
                                WHERE product_inventory.product = products.id
                                ORDER BY datetime DESC
                            ");
                            if (mysqli_num_rows($get_products) < 1) {
                                ?>
                                <tr>
                                    <td>
                                        No values found!
                                    </td>
                                </tr>
                                <?php
                            }
                            while ($data_products = mysqli_fetch_array($get_products)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $count++; ?>
                                    </td>
                                    <td>
                                        <?php echo $data_products['datetime']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data_products['product_name']; ?>
                                    </td>
                                    <td>
                                        <?php $act_type = $data_products['type'];
                                            if ($act_type == 'IN') {
                                                echo "Import";
                                            }
                                            elseif ($act_type == 'OUT') {
                                                echo "Export";
                                            }
                                            else {
                                                echo "No category";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $data_products['action_quantity']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data_products['price']."RWF"; ?>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
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
