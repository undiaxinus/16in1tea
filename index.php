<?php

include_once("conn/conn.php");
include_once "countdown.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Foody - Organic Food Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<?php
if (isset($_GET['userID']) && $_GET['userID'] !== null) {
    $userID = $_GET['userID'];

} else {
    $userID = uniqid();

}
?>

<body style="background-color: yellow;">
     <style>
   


    .msg {
      position: fixed;
      top: 90px;
      left: 50%;
      padding: 10px 20px;
      border-radius: 5px;
      color: white;
      font-size: 14px;
      font-weight: 800;
      box-shadow: 0 0 14px rgba(0, 0, 0, 0.05);
      opacity: 0;
      transform: translateY(-100%) translateX(-50%);
      transition: all 1s;
       z-index: 999;
    }

    .msg-success {
      background-color: #28a745;
    }

    .msg-danger {
      background-color: #dc3545;
    }

    .msg-warning {
      background-color: #ffc107;
    }

    .msg-info {
      background-color: #17a2b8;
    }

    .msg.active {
      opacity: 1;
      transform: translateX(-50%) translateY(-50%);
    }
  </style>
<!-- message -->
<div class="msg"></div>
<!-- end message -->

<div>
  <!-- Removed the buttons for automatic popup -->
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  (function () {
    // data
    var clear;
    var msgDuration = 2000; // 2 seconds
    var messages = [
      "Annette Flores: Successfully Ordered! 10 packs",
      "Arlene Navaro: Successfully Ordered! 2 packs",
      "Daisy Balasta: Successfully Ordered! 7 packs",
      "Emma Diaz: Successfully Ordered! 15 packs",
      "Evelyn Navaro: Successfully Ordered! 11 packs",
      "Gladys Villar: Successfully Ordered! 19 packs",
      "Judith Banquiles: Successfully Ordered! 9 packs",
      "Norma Lotino: Successfully Ordered! 2 packs",
      "Carlo Lopera: Successfully Ordered! 1 packs",
      "Stella Flores: Successfully Ordered! 5 packs",
      "Edison Ronda: Successfully Ordered! 9 packs",
      "John Joel Balderam: Successfully Ordered! 2 packs",
      "Ruth Balasta: Successfully Ordered! 8 packs",
      "Joseph Anonuevo: Successfully Ordered! 10 packs",
      "Lucas Le: Successfully Ordered! 10 packs",
      "Oscar Dela Cruz: Successfully Ordered! 10 packs",
      "Samuel Bercasio: Successfully Ordered! 12 packs"
    ];

    // cache DOM
    var $msg = $(".msg");

    // render message
    function render(message) {
      hide();
      $msg.addClass("msg-success active").text(message);
    }

    function timer() {
      clearTimeout(clear);
      clear = setTimeout(function () {
        hide();
      }, msgDuration);
    }

    function hide() {
      $msg.removeClass("msg-success msg-danger msg-warning msg-info active");
    }

    // Automatically trigger a different message every 5 seconds
    setInterval(function() {
      var randomIndex = Math.floor(Math.random() * messages.length);
      render(messages[randomIndex]);
    }, 15 * 1000); // 5 seconds in milliseconds

    $msg.on("transitionend", timer);
  })();
</script>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-map-marker-alt me-2"></i><a href="https://www.google.com/maps/place/Legazpi+City,+Albay/@13.1211932,123.6083565,11z/data=!4m15!1m8!3m7!1s0x33a101687e9bf8a7:0x305252e78d14537a!2sLegazpi+City,+Albay!3b1!8m2!3d13.1390621!4d123.7437995!16zL20vMDFfNmh3!3m5!1s0x33a101687e9bf8a7:0x305252e78d14537a!8m2!3d13.1390621!4d123.7437995!16zL20vMDFfNmh3?entry=ttu" style="color: #555;">Legazpi city</a></small>
                <small class="ms-4"><i class="fa fa-envelope me-2"></i><a href="mailto:emails@gmail.com" style="color: #555;">undiaxinus@gmail.com</a></small>
                <small class="ms-4"><b>USER ID:</b> <?php echo $userID ?></small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">F<span class="text-secondary">oo</span>dy</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php?userID=<?php echo $userID ?>" class="nav-item nav-link active">Home</a>
                    <a href="about.php?userID=<?php echo $userID ?>" class="nav-item nav-link">About Us</a>
                    <a href="product.php?userID=<?php echo $userID ?>" class="nav-item nav-link">Products</a>
                    <a href="contact.php?userID=<?php echo $userID ?>" class="nav-item nav-link">Contact Us</a>
                </div>
                <div class="d-none d-lg-flex ms-2">
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                        <small class="fa fa-search text-body"></small>
                    </a>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                        <small class="fa fa-user text-body" title="<?php echo $userID ?>"></small>
                    </a>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                        <small class="fa fa-shopping-bag text-body"></small>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7">
                                    <h1 class="display-2 mb-5 animated slideInDown">Organic Food Is Good For Health</h1>
                                    <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Products</a>
                                    <a href="" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7">
                                    <h1 class="display-2 mb-5 animated slideInDown">Natural Food Is Always Healthy</h1>
                                    <a href="" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Products</a>
                                    <a href="" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Product Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h1 class="display-5 mb-3">Our Products</h1>
                        <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2 active" data-bs-toggle="pill" href="#tab-1">Herbal Roots</a>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <?php
                            $result = mysqli_query($conn,"SELECT name, price, picture FROM product");
                            while($row = mysqli_fetch_assoc($result)){
                                $formattedPrice = number_format($row['price'], 2, '.', ',');
                            ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="product-item bg-light" >
                                 <form method="post" action="cart.php">
                                <div class="position-relative bg-light overflow-hidden">
                                    <input type="hidden" name="userID" value="<?php echo $userID ?>">
                                        <input type="hidden" name="picture" value="<?php echo $row['picture']; ?>">
                        <input type="hidden" name="name" value="<?php echo $row['name']; ?>">               
                        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                        
                        <button type="submit" class="text-body border-0 bg-transparent">
                                    <img class="img-fluid w-100" src="img/<?php echo $row['picture']; ?>" alt="<?php echo $row['name']; ?>">
                                    <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Buy now!</div>
                                </button>
                                </div>
                            
                                <div class="text-center p-4">
                                    <p class="d-block h5 mb-2" href=""><?php echo $row['name']; ?></p>
                                    <span class="text-primary me-1">₱ <?php echo $formattedPrice; ?>   </span>

                                    
                                    <div class="quantity-input d-flex align-items-center justify-content-center">
                                        <b><p>QUANTITY:</p></b>&nbsp
                                   
                                   <select name="quantity" style="max-width: 100px;">
                                       <option hidden>1</option>
                                        <option>2</option>
                                       <option>3</option>
                                       <option>4</option>
                                       <option>5</option>
                                       <option>6</option>
                                       <option>7</option>
                                       <option>8</option>
                                       <option>9</option>
                                       <option>10</option>

                                   </select>
                        </div>
                                    
                                </div>
                                <div class="d-flex border-top">
                                    <small class="w-50 text-center border-end py-2">
                                        <a class="text-body" href="form.php?userID=<?php echo $userID ?>"><i class="fa fa-eye text-primary me-2"></i>CART</a>
                                    </small>
                                    <small class="w-50 text-center py-2">
                                        <input type="hidden" name="userID" value="<?php echo $userID ?>">
                                        <input type="hidden" name="picture" value="<?php echo $row['picture']; ?>">
                        <input type="hidden" name="name" value="<?php echo $row['name']; ?>">               
                        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                        <button type="submit" class="text-body border-0 bg-transparent"><i class="fa fa-shopping-bag text-primary me-2"></i>ADD TO CART</button>
                    
                                    </small>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                        <div class="col-12 text-center">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="">Browse More Products</a>
                        </div>
                    </div>
                </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="img/about.jpg">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-5 mb-4">Best Organic Fruits And Vegetables</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Testimonial Start -->
    <div class="container-fluid bg-light bg-icon py-6 mb-5">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Customer Review</h1>
                <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 rounded-circle" src="img/testimonial-1.jpg" alt="">
                        <div class="ms-3">
                            <h5 class="mb-1">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 rounded-circle" src="img/testimonial-2.jpg" alt="">
                        <div class="ms-3">
                            <h5 class="mb-1">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 rounded-circle" src="img/testimonial-3.jpg" alt="">
                        <div class="ms-3">
                            <h5 class="mb-1">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 rounded-circle" src="img/testimonial-4.jpg" alt="">
                        <div class="ms-3">
                            <h5 class="mb-1">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Customer's Feedback</h1>
                <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid" src="img/blog-1.jpg" alt="">
                    <div class="bg-light p-4">
                        <a class="d-block h5 lh-base mb-4" href="">How to cultivate organic fruits and vegetables in own firm</a>
                        <div class="text-muted border-top pt-4">
                            <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                            <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <img class="img-fluid" src="img/blog-2.jpg" alt="">
                    <div class="bg-light p-4">
                        <a class="d-block h5 lh-base mb-4" href="">How to cultivate organic fruits and vegetables in own firm</a>
                        <div class="text-muted border-top pt-4">
                            <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                            <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="img-fluid" src="img/blog-3.jpg" alt="">
                    <div class="bg-light p-4">
                        <a class="d-block h5 lh-base mb-4" href="">How to cultivate organic fruits and vegetables in own firm</a>
                        <div class="text-muted border-top pt-4">
                            <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                            <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->

<?php
include_once('footer.php');
?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>
