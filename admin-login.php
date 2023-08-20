<?php
    SESSION_START();
    include("php/server.php");
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
        include("php/out-nav.php");
    ?>

    <!-- Login Form -->
    <div class="container mt-5" style="height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-3">
                <h2>
                    Log in as admin
                </h2>
                <form action="" method="POST">
                    <?php
                        if (isset($_POST['loginBTN'])) {
                            $un = $_POST['username'];
                            $pw = $_POST['password'];
                            $check_un = mysqli_query($server,"SELECT * from admin WHERE user_name = '$un'");
                            if (mysqli_num_rows($check_un) !=1) {
                                ?>
                                <p class="alert alert-danger">
                                    Username not found!
                                </p>
                                <?php
                            }
                            else {
                                $check_pw_match = mysqli_query($server,"SELECT * from admin WHERE user_name = '$un'
                                    AND password = '$pw'
                                ");
                                if (mysqli_num_rows($check_pw_match) !=1) {
                                    ?>
                                    <p class="alert alert-danger">
                                        Password doesn't match with Username
                                    </p>
                                    <?php
                                }
                                else {
                                    $data_userid = mysqli_fetch_array($check_pw_match);
                                    $userid = $data_userid['user_id'];
                                    $_SESSION['acting_user_id'] = $userid;
                                    header("location: admin-home.php");
                                }
                            }
                        }
                    ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Type..." required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Type..." required>
                    </div>
                    <button type="submit" name="loginBTN" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
        include("php/footer.php");
    ?>

    <!-- Add Bootstrap JS script link here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
