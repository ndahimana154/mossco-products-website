<?php
    session_start();
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

        <!-- About Us Section -->
        <section id="about" class="container" style="margin-top: 50px;">
            <!-- <h2 class="p-3">About Us</h2> -->
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-6">
                    <img src="images/about-image.jpg" class="img-fluid p-3" style="border-radius: 5px;">
                </div>
                <div class="col-md-6 p-2">
                    <p style="font-size: 20px; p-3">
                        Hello, I am Nsabimana Laurent Wilson and I am representing Moss.Co and I would like to introduce 
                        you to IRISH MOSS popularly known as CHONDRUS CRISPUS. This is a seaweed from Ireland, rich in 
                        various nutrients, and useful for your whole family. Send me a text message if you want 
                        to protect yourself and your family with CHONDRUS CRISPUS.
                    </p>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section id="products" class="container-fluid bg-light py-5">
            <div class="container">
                <h2 class="text-center">Our Products</h2>
                <div class="row">
                    <!-- Product Box 1 -->
                    <div class="col-md-12 mb-4">
                        <?php
                            $get_products = mysqli_query($server,"SELECT * from products 
                                WHERE product_quantity > 0
                                AND product_status='On-sale'
                                ORDER BY product_quantity DESC
                            ");
                            if (mysqli_num_rows($get_products) < 1) {
                                ?>
                                <p class="alert alert-danger">
                                    No products found!
                                </p>
                                <?php
                            }
                            while ($data_products = mysqli_fetch_array($get_products)) {
                                ?>
                                <div class="card-body bg-white m-2 shadow-3">
                                    <h4 class="card-title">
                                        <?php
                                            echo $data_products['product_name'];
                                        ?>
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="images/products/<?php echo $data_products['product_image'] ?>" class="img-fluid" alt="Image for <?php echo $data_products['product_name'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <p class="card-text p-2">
                                                <?php echo $data_products['product_description']; ?>
                                            </p>
                                            <div class="row" style="text-align: center;justify-content: center;">
                                            <a href="https://wa.me/250788923011?text=Hello? I would like to get more informations about the product called '<?php echo $data_products['product_name'];?>' and if i can order it after." target="_blank"
                                                class="btn btn-success">
                                                <i class="fab fa-whatsapp"></i> Order on WhatsApp
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                    <!-- Repeat for more products -->
                </div>
            </div>
        </section>



        <!-- Footer -->
        <?php
            include("php/footer.php");
        ?>

    <!-- Add Bootstrap JS script link here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
