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
    <!-- Js files -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="js\jquery-3.6.0.js"></script>
    <script src="js\admin-print-inventory-filter-by-date.js"></script>
</head>
<body data-spy="scroll" data-target="#navbar" data-offset="100">
    
    <div class="container m-3">
        <div class="">
            <button class="btn btn-primary" id="print_filterBYDATEBTN">
                <i class="fa fa-file-pdf"></i>
                PDF
            </button>
        </div>
        <div id="filter_Bydate_print">
            <h1>
                <?php
                    echo $company_name;
                ?>
            </h1>
            <?php
                if (isset($_GET['filter_by_dateBTN'])) {
                    $startdate = $_GET['from'];
                    $enddate = $_GET['until'];
                    $today = date('Y-m-d');
                    ?>
                    <h3 class="text-primary">
                        Inventory status "<b><?php echo $startdate." - ".$enddate; ?></b>"
                    </h3>
                    <?php
                    if (empty($startdate) || empty($enddate)) {
                        ?>
                        <p class="alert alert-danger">
                            Empty values not allowed
                        </p>
                        <?php
                    }
                    if ($enddate < $startdate) {
                        ?>
                        <p class="alert alert-danger">
                            Enddate can't be less than start date
                        </p>
                        <?php
                    }
                    elseif ($startdate > $today) {
                        ?>
                        Start date can't exceed today.
                        <?php
                    }
                    else {
                        ?>
                        <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date & time</th>
                                <th>Product</th>
                                <th>Action type</th>
                                <th>Action quantity</th>
                                <th>Unit price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $count=1;
                                $get_products = mysqli_query($server,"SELECT * from
                                    product_inventory,products
                                    WHERE product_inventory.product = products.id
                                    AND datetime >= '$startdate' 
                                    AND datetime <= '$enddate'
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
                                    
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                        <?php
                        include("php/admin-print-footer.php");
                    }
                }
                else {
                    ?>
                    <p class="alert alert-danger m-3">
                        No data sent to server
                    </p>
                    <?php
                }
            ?>
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
