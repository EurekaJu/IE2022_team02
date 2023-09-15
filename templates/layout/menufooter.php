<?php
use Cake\Core\Configure;

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- <meta charset="utf-8"> -->
    <?= $this->Html->charset() ?>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Margalya Press</title>
    <meta name="description" content="">
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
    <?= $this->Html->css('icofont.css') ?>

    <?= $this->Html->script('/vendor/modernizr-3.11.7.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>



    <!-- for dataTables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    .example {background-color: #008080 !important; }

    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #686868;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        z-index: 9999;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 20px;
        color: #f1f1f1;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #818181;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }
</style>
<body>
    <!-- header start -->
    <header class="res-header-sm">
        <div class="header-top-wrapper theme-bg-2">
    <div class="example">
            <div class="container">
                <div class="header-top">
                    <?php  $session = $this->request->getSession();
                    $userRole = $session->read('userRole');
                    if($userRole == 'absolute' || $userRole =='editor' || $userRole =='admin') { ?>
                        <div id="mySidenav" class="sidenav" style="alignment: left">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" >&times;</a>
                            <?php
                            $session = $this->request->getSession();
                            $userRole = $session->read('userRole');
                            $userId = $session->read('userId');
                            if ($userRole == 'absolute') { ?>
                                <?= $this->Html->link(__('Add New User'), ['controller' => 'users' , 'action' => 'adminadd']) ?>
                                <?php
                            }
                            else { ?>
                                <?= $this->Html->link(__('Add New User'), ['controller' => 'users' , 'action' => 'add']) ?>
                                <?php
                            }
                            ?>
                            <?= $this->Html->link('Articles', ['controller' => 'articles', 'action' => 'index']) ?>
                            <?= $this->Html->link('Books', ['controller' => 'books', 'index']) ?>
                            <?= $this->Html->link('Book Images', ['controller' => 'bookImages', 'action' => 'index']) ?>
                            <?= $this->Html->link('Book Submissions', ['controller' => 'bookSubmissions', 'action' => 'index']) ?>
                            <?= $this->Html->link('Edit Home page images', ['controller' => 'homeImages']) ?>
                            <?= $this->Html->link('Edit My Profile', ['controller' => 'users', 'action' => 'customeredit', $userId]) ?>
                            <?= $this->Html->link(__('Enquiries'), ['controller' => 'enquiries', 'action' => 'index']) ?>
                            <?= $this->Html->link('Footer Page', ['controller' => 'footers']) ?>
                            <?= $this->Html->link(__('Interests'), ['controller' => 'interests', 'action' => 'index']) ?>
                            <?= $this->Html->link('Orders', ['controller' => 'orders', 'action' => 'index']) ?>
                        </div>
                        <a><span style="font-size:15px;cursor:pointer;color: #f1f1f1"  onclick="openNav()">&#9776; Staff Menu</span></a>
                        <script>
                            function openNav() {
                                document.getElementById("mySidenav").style.width = "250px";
                            }

                            function closeNav() {
                                document.getElementById("mySidenav").style.width = "0";
                            }
                        </script>
                    <?php  }

                    ?>

                    <div class="header-info">
                        <!-- <span>Contact us - 00 221 225 123-30  or  <a href="#">info@domain.com</a></span> -->
                    </div>
                    <div class="book-login-register">
                        <ul>
                            <?php
                            $session = $this->request->getSession();
                            if($session->read('userRole')) {
                                // user is logged in, show logout.user menu etc
                            ?>
                                <li><a href="<?= $this->Url->build('/users/logout') ?>"></i>logout</a></li>
                                <?php
                                    $session = $this->request->getSession();
                                    $userRole = $session->read('userRole');
                                    $userId = $session->read('userId');
                                    if ($session->read('userRole')) {
                                        if ($userRole == 'customer') { ?>
                                            <li><a
                                                    href="<?= $this->Url->build('/users/view/' . $userId) ?>"><i class="ti-user"></i>My
                                                    Profile</a>
                                            </li>
                                        <?php } elseif ($userRole == 'absolute' || $userRole =='editor' || $userRole =='admin') {  ?>

                                              <li><a      href="<?= $this->Url->build('/users') ?>"><i class="ti-user"></i>Admin
                                                      Portal</></a>
                                            </li>
                                            <?php
                                        }
                                    } else {
                                    }
                            } else {
                                // the user is not logged in
                            ?>
                                <li><a href="<?= $this->Url->build('/users/login') ?>"><i class="ti-user"></i>login</a></li>
                                <li><a href="<?= $this->Url->build('/users/add') ?>">Sign up</a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
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
                                <li><a href="<?= $this->Url->build('/books/about') ?>">About</a>
                                </li>
                                <li><a href="<?= $this->Url->build('/books/shoplist') ?>">Books</a>
                                    <ul class="single-dropdown">
                                        <li><a href="<?= $this->Url->build('/books/shoplist') ?>">Shop Books</a></li>
                                        <?php if($session->read('bookStatus') == 'interest') { ?>
                                            <li><a href="<?= $this->Url->build('/interests/add') ?>">Register interest for the TIQQUNEI HA-ZOHAR</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li><a href="<?= $this->Url->build('/articles/home') ?>">News</a>
                                </li>
                                <li><a href="<?= $this->Url->build('/enquiries/add') ?>">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Start Add back in for It2 -->
                    <a class="icon-cart-furniture" href="<?= $this->Url->build('/books/cart') ?>">
                        <i class="ti-shopping-cart" style="margin-right: 10px"></i><br>
                        <?php
                        $sessioncart = $session->read('cart');
                        $count = 0;
                        if($sessioncart > 0){
                        foreach($sessioncart as $c) {
                            $count += $c['quan'];
                        }}
                        ?>
                        <br><span class="shop-count-furniture green"><?= $count ?></span><br>
                    </a>
                    <!-- End Add back in for It2 -->
                </div>
                <div class="row">
                    <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                        <div class="mobile-menu">
                            <nav id="mobile-menu-active">
                                <ul class="menu-overflow">
                                    <li><a href="<?= $this->Url->build('/books/home') ?>">home</a>
                                    <li><a href="<?= $this->Url->build('/books/about') ?>">About</a>
                                </li>
                                <li><a href="<?= $this->Url->build('/books/shoplist') ?>">Books</a>
                                    <ul>
                                        <li><a href="<?= $this->Url->build('/books/shoplist') ?>">Shop Books</a></li>
                                        <!-- <?php if($session->read('bookStatus') == 'interest') { ?>
                                            <li><a href="<?= $this->Url->build('/interests/add') ?>">Register interest for the TIQQUNEI HA-ZOHAR</a></li>
                                        <?php } ?> -->
                                    </ul>
                                </li>
                                <li><a href="<?= $this->Url->build('/articles/home') ?>">News</a>
                                </li>
                                <li><a href="<?= $this->Url->build('/enquiries/add') ?>">Contact</a>
                                </li>
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
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title-2">Contact Us</h3>
                            <div class="footer-widget-content-2">

                                <ul>
                                <li><a href="<?= $this->Url->build('/enquiries/add') ?>">Submit an enquiry</a></li>
                                <li><a href="<?= $this->Url->build('/bookSubmissions/add') ?>">Pitch an idea</a></li>
                                    <div class="product-share">
                                        <ul>
                                            <li class="categories-title">Social Media :</li>
                                            <li>
                                                <a href="https://www.facebook.com/MargalyaPress" target="_blank">
                                                    <i class="icofont icofont-social-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.linkedin.com/company/margalya-press/" target="_blank">
                                                    <i class="icofont icofont-social-linkedin"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.instagram.com/margalyapress/?igshid=YmMyMTA2M2Y%3D" target="_blank">
                                                    <i class="icofont icofont-social-instagram"></i>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget mb-40 pl-70">
                            <h3 class="footer-widget-title-2">Useful Links</h3>
                            <div class="footer-widget-content-2">
                                <ul>
                                    <?php
                                    $var = Configure::read('footerpages');
                                    foreach($var as $v) { ?>
                                        <li><a><?= $this->Html->link($v->title, ['controller' => 'Footers', 'action'=>'view', $v->id]) ?></a></li>
                                    <?php }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-widget mb-40 pl-70">
                            <h3 class="footer-widget-title-2">About</h3>
                            <div class="footer-widget-content-2">
                                <ul>
                                    <li><a href="<?= $this->Url->build('/books/about') ?>">About</a></li>
                                    <li><a href="<?= $this->Url->build('/articles/home') ?>">News</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget mb-40 pl-70">
                            <h3 class="footer-widget-title-2">Sign up</h3>
                            <div class="footer-widget-content-2">
                                <ul>
                                    <!-- <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Returns</a></li> -->
                                    <?php
                                    $session = $this->request->getSession();
                                    if($session->read('userRole')) {
                                        // user is logged in, show logout..user menu etc
                                        ?>
                                        <li><a href="<?= $this->Url->build('/Users/logout') ?>">Logout</a></li>
                                        <?php
                                    } else {
                                        // the user is not logged in
                                        ?>
                                        <li><a href="<?= $this->Url->build('/users/login') ?>">Login</a></li>
                                        <li><a href="<?= $this->Url->build('/users/add') ?>">Sign up</a></li>
                                        <?php
                                    }
                                    ?>
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
                                <a>Margalya Press</a> <?= date('Y') ?> . All Rights Reserved.
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
    <?= $this->fetch('script') ?>
</body>

</html>
