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
            <h2>FILTER INVENTORY</h2>
            <div class="p-3">
                <h3 class="text-primary">
                    Filter by date
                </h3>
                <form action="admin-inventory-filter-by-date.php" method="get" target="_blank" class="row">
                    <div class="form-group col-md-4">
                    <label for="">
                            From
                        </label>
                        <input type="date" name="from"  class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">
                            Until
                        </label>
                        <input type="date" name="until" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">
                            ...
                        </label>
                        <button name="filter_by_dateBTN" type="submit" class="btn btn-success form-control">
                            <i class="fa fa-filter"></i>
                            Filter
                        </button>
                    </div>
                    
                </form>
            </div>
            <div class="p-3">
                <h3 class="text-primary">
                    Filter by type
                </h3>
                <form action="admin-inventory-filter-by-type.php" method="get" target="_blank" class="row">
                    <div class="form-group col-md-4">
                    <label for="">
                            Inventory type
                        </label>
                        <select name="type" id="" class="form-control" required>
                            <option value="Select type...">
                                Select type...
                            </option>
                            <option value="Imports">
                            Imports
                            </option>
                            <option value="Exports">
                                Exports
                            </option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">
                            ...
                        </label>
                        <button name="filter_by_typeBTN" type="submit" class="btn btn-success form-control">
                            <i class="fa fa-filter"></i>
                            Filter
                        </button>
                    </div>
                    
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
