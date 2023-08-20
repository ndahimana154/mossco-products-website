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
            <h2 class="mt-2">Settings || <?php echo $acting_admin_username; ?></h2>
            <div class="p-3">
                <?php
                    if (isset($_POST['savCONameBTN'])) {
                        $co_name = $_POST['co_name'];
                        $co_name = mysqli_real_escape_string($server,$co_name);
                        $update = mysqli_query($server,"UPDATE company_name
                            SET name = '$co_name'
                        ");
                        if (!$update) {
                            ?>
                            <p class="alert alert-danger">
                                Company name is not updated
                            </p>
                            <?php
                        }
                        else {
                            ?>
                            <p class="alert alert-success">
                                Company name is changed successfully.
                            </p>
                            <?php
                        }
                    }
                    if (isset($_POST['saveNewUNameBTN'])) {
                        $newusername = $_POST['newusername'];
                        $password = $_POST['password'];
                        $checkusername = mysqli_query($server,"SELECT * from admin 
                            WHERE user_name = '$newusername'
                        ");
                        if (mysqli_num_rows($checkusername) > 0) {
                            ?>
                            <p class="alert alert-danger">
                                Username already exists
                            </p>
                            <?php
                        }
                        else {
                            $check_password = mysqli_query($server,"SELECT * from admin
                                WHERE user_name = '$acting_admin_username'
                                AND password = '$password'
                            ");
                            if (mysqli_num_rows($check_password) !=1) {
                                ?>
                                <p class="alert alert-danger">
                                    Password is incorrect
                                </p>
                                <?php
                            }
                            else {
                                $update = mysqli_query($server,"UPDATE admin set 
                                    user_name = '$newusername'
                                    WHERE user_id = '$acting_admin_id'
                                ");
                                session_destroy();
                                ?>
                                <p class="alert alert-success">
                                    Username is updated successfully.
                                </p>
                                <?php
                            }
                        }
                    }
                    if (isset($_POST['saveNewpasswdBTN'])) {
                        $Oldpass = $_POST['oldp'];
                        $newpaas = $_POST['newp'];
                        $retp = $_POST['rtp'];
                        if ($newpaas != $retp) {
                            ?>
                            <p class="alert alert-danger">
                                Passwords doesn't match.
                            </p>
                            <?php
                        }
                        else {
                            // CHecki if old password is correct
                            $checkoldpass = mysqli_query($server,"SELECT * from admin
                                WHERE user_id = '$acting_admin_id'
                                AND password = '$Oldpass'
                            ");
                            if (mysqli_num_rows($checkoldpass) !=1) {
                                ?>
                                <p class="alert alert-danger">
                                    Old password is incorrect.
                                </p>
                                <?php
                            }
                            else {
                                $update_password = mysqli_query($server,"UPDATE admin set
                                    password = '$newpaas'
                                    WHERE user_id = '$acting_admin_id'
                                ");
                                if ($update_password) {
                                    session_destroy();
                                    ?>
                                    <p class="alert alert-success">
                                        Password is changed successfully.
                                    </p>
                                    <?php
                                }
                                else {
                                    ?>
                                    <p class="alert alert-danger">
                                        Password change failed.
                                    </p>
                                    <?php
                                }
                            }
                        }
                    }
                ?>
            </div>
            <div class="p-3">
                <h4 class="text-primary">
                    1. Company names
                </h4>
                <form action="" method="POST">
                    <div class="form-group col-md-4">
                        <label for="">
                            Company name
                        </label>
                        <input type="text" name="co_name" placeholder="Type.."  value="<?php echo $company_name; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" name="savCONameBTN" class="btn btn-success">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
            <div class="p-3">
                <h4 class="text-primary">
                    2. Set Username
                </h4>
                <form action="" method="POST">
                    <div class="form-group col-md-4">
                        <label for="">
                            New username
                        </label>
                        <input type="text" name="newusername" placeholder="Type.."  value="<?php echo $company_name; ?>" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">
                            Password
                        </label>
                        <input type="password" name="password" placeholder="Type.."  value="<?php echo $company_name; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" name="saveNewUNameBTN" class="btn btn-success">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
            <div class="p-3">
                <h4 class="text-primary">
                    3. Change password
                </h4>
                <form action="" method="POST">
                    <div class="form-group col-md-4">
                        <label for="">
                            Old password
                        </label>
                        <input type="password" name="oldp" placeholder="Type.."  value="<?php echo $company_name; ?>" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">
                            New password
                        </label>
                        <input type="password" name="newp" placeholder="Type.."  value="<?php echo $company_name; ?>" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">
                            Retype password
                        </label>
                        <input type="password" name="rtp" placeholder="Type.."  value="<?php echo $company_name; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" name="saveNewpasswdBTN" class="btn btn-success">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
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
