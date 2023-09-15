<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- <meta charset="utf-8"> -->
    <?= $this->Html->charset() ?>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Margalya Press -  Contact us</title>
    <meta name="description" content="Contact Margalya Press for any enquiries and questions. We are always happy to hear from you for any suggestions or requirements.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <?= $this->Html->meta('icon') ?>

    <!-- all css here -->
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="assets/css/bundle.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/vendor/modernizr-3.11.7.min.js"></script> -->

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('magnific-popup.css') ?>
    <?= $this->Html->css('animate.css') ?>
    <?= $this->Html->css('owl.carousel.min.css') ?>
    <?= $this->Html->css('themify-icons.css') ?>
    <?= $this->Html->css('pe-icon-7-stroke.css') ?>
    <?= $this->Html->css('meanmenu.min.css') ?>
    <?= $this->Html->css('bundle.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('responsive.css') ?>

    <?= $this->Html->script('/vendor/modernizr-3.11.7.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>

<body>
    <!-- header start -->
    <header class="res-header-sm">
        <div class="header-top-wrapper theme-bg-2">
            <div class="container">
                <div class="header-top">
                    <div class="header-info">
                        <span>Contact us - 00 221 225 123-30  or  <a href="#">info@domain.com</a></span>
                    </div>
                    <div class="book-login-register">
                        <ul>
                            <li><a href="<?= $this->Url->build('/login') ?>"><i class="ti-user"></i>login</a></li>
                            <li><a href="<?= $this->Url->build('/users/add') ?>"></i>Sign up</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom clearfix">
            <div class="container">
                <div class="header-bottom-wrapper">
                    <div class="logo-2 ptb-5">
                        <?= $this->Html->image("/img/logo/margalyapresslogo.png", ['alt' => 'Logo', 'url' => ['controller' => 'Books', 'action' => 'home']]);?>
                        <a href="#" class="menu-trigger">
                        <span></span>
                        </a>
                        <!-- <a href="index.html"><img src="assets/img/logo/2.png" alt=""></a> -->
                    </div>
                    <div class="menu-style-2 book-menu menu-hover">
                        <nav>
                            <ul>
                                <li><a href="<?= $this->Url->build('/books/home') ?>">home</a>
                                    <ul class="single-dropdown">
                                        <li><a href="index.html">My Profile</a></li>
                                        <li><a href="index-fashion-2.html">Admin Portal</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= $this->Url->build('/enquiries/add') ?>">Make an enquiry</a>
                                    <ul class="single-dropdown">
                                        <li><a href="<?= $this->Url->build('/enquiries/add') ?>">Enquire</a></li>
                                        <li><a href="<?= $this->Url->build('/interests/add') ?>">Register your interest</a></li>
                                    </ul>
                                </li>
                                <!-- <li><a href="#">Shop</a>
                                    <ul class="single-dropdown">
                                        <li><a href="about-us.html">Shopping Cart</a></li>
                                        <li><a href="about-us.html">Checkout</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">News</a>
                                </li>
                                <li><a href="contact.html">About</a></li> -->
                            </ul>
                        </nav>
                    </div>
                    <!-- <div class="header-cart-2">
                        <a class="icon-cart" href="#">
                            <i class="ti-shopping-cart"></i>
                            <span class="shop-count book-count">02</span>
                        </a> -->
                        <!-- <ul class="cart-dropdown">
                            <li class="single-product-cart">
                                <div class="cart-img">
                                    <a href="#"><img src="assets/img/cart/1.jpg" alt=""></a>
                                </div>
                                <div class="cart-title">
                                    <h5><a href="#"> Bits Headphone</a></h5>
                                    <h6><a href="#">Black</a></h6>
                                    <span>$80.00 x 1</span>
                                </div>
                                <div class="cart-delete">
                                    <a href="#"><i class="ti-trash"></i></a>
                                </div>
                            </li>
                            <li class="cart-space">
                                <div class="cart-sub">
                                    <h4>Subtotal</h4>
                                </div>
                                <div class="cart-price">
                                    <h4>$240.00</h4>
                                </div>
                            </li>
                            <li class="cart-btn-wrapper">
                                <a class="cart-btn btn-hover" href="#">view cart</a>
                                <a class="cart-btn btn-hover" href="#">checkout</a>
                            </li>
                        </ul> -->
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                        <div class="mobile-menu">
                            <nav id="mobile-menu-active">
                                <ul class="menu-overflow">
                                    <li><a href="#">HOME</a>
                                        <ul>
                                        <li><a href="index.html">My Profile</a></li>
                                        <li><a href="index-fashion-2.html">Admin Portal</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Make an Enquiry</a>
                                        <ul>
                                        <li><a href="about-us.html">Enquire</a></li>
                                        <li><a href="about-us.html">Register your interest</a></li>
                                        </ul>
                                    </li>
                                    <!-- <li><a href="#">shop</a>
                                        <ul>
                                        <li><a href="about-us.html">Shopping Cart</a></li>
                                        <li><a href="about-us.html">Checkout</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">News</a>
                                    </li>
                                    <li><a href="contact.html"> About  </a></li> -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- banner area start -->

    <!-- banner area end -->
    <!-- best product area start -->

    <!-- best product area end -->

    <!-- blog area start -->

    <!-- blog area end -->
    <!-- subscribe area start -->

    <!-- subscribe area end -->

    <!-- CONTENT FETCH -->
    <?= $this->Flash->render() ?>
    <?= $this-> fetch('content') ?> 

    <footer class="footer-area">
        <div class="footer-top-area gray-bg-5 pt-20 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title-2">About</h3>
                            <div class="footer-info-wrapper">
                                <div class="footer-address">
                                    <div class="footer-info-icon">
                                        <i class="ti-location-pin"></i>
                                    </div>
                                    <div class="footer-info-content">
                                        <p>77 Seventh Streeth, Banasree.
                                            <br>USA -215568</p>
                                    </div>
                                </div>
                                <div class="footer-address">
                                    <div class="footer-info-icon">
                                        <i class="ti-headphone-alt"></i>
                                    </div>
                                    <div class="footer-info-content">
                                        <p>+880 1124 22365 2223
                                            <br>+880 1124 22365 5455</p>
                                    </div>
                                </div>
                                <div class="footer-address">
                                    <div class="footer-info-icon">
                                        <i class="ti-email"></i>
                                    </div>
                                    <div class="footer-info-content">
                                        <p><a href="#">domain@company.com</a>
                                            <br><a href="#">company@domain.info</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget mb-40 pl-70">
                            <h3 class="footer-widget-title-2">Other Links</h3>
                            <div class="footer-widget-content-2">
                                <ul>
                                    <!-- <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Returns</a></li> -->
                                    <li><a href="<?= $this->Url->build('/Enquiries/add') ?>">Enquire</a></li>
                                    <li><a href="<?= $this->Url->build('/login') ?>">Login</a></li>
                                    <li><a href="<?= $this->Url->build('/users/add') ?>">Sign Up</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4 col-md-6">
                        <div class="footer-widget mb-40 pl-30">

                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="footer-bottom ptb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright-2">
                            <p>
                                Copyright ©
                                <a>Margalya Press</a> 2022 . All Rights Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>










    <!-- all js here -->
    <!-- <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/ajax-mail.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script> -->

    <?= $this->Html->script('jquery-1.12.4.min.js') ?>
    <?= $this->Html->script('popper.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('jquery.magnific-popup.min.js') ?>
    <?= $this->Html->script('isotope.pkgd.min.js') ?>
    <?= $this->Html->script('imagesloaded.pkgd.min.js') ?>
    <?= $this->Html->script('jquery.counterup.min.js') ?>
    <?= $this->Html->script('waypoints.min.js') ?>
    <?= $this->Html->script('ajax-mail.js') ?>
    <?= $this->Html->script('owl.carousel.min.js') ?>
    <?= $this->Html->script('plugins.js') ?>
    <?= $this->Html->script('main.js') ?>
</body>

</html>