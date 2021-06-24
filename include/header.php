<?php
session_start();
include "database/connect.php";
include "database/function.php";

$contact_a = mysqli_query($conn, "SELECT * FROM contact_page");
$contact = mysqli_fetch_array($contact_a);

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    $_SESSION['userid'] = $userid;
    $user = mysqli_query($conn, "SELECT * FROM singup WHERE email='".$_SESSION['userid']."'");
    $user_a = mysqli_fetch_array($user);
    $user_id=$user_a['id'];
    $_SESSION['user_id'] = $user_id;
}
// else{
//   header("Location:index");
//   die();
// }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APSDP</title>

    <!-- Google Font -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet"> -->

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" media="all" href="css/stellarnav.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
#popup_this {
    top: 50%;
    left: 50%;
    text-align:center;
    margin-top: 30px;
    margin-left: -100px;
    position: fixed;
    background: #fff;
    padding: 30px;
    height: 87%;
}
.b-close {
    position: absolute;
    right: 0;
    top: 0;
    cursor: pointer;
    color: #fff;
    background: #ff0000;
    padding: 5px 10px;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>

</head>

<body>

<!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo1.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <a href="login"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index">Home</a></li>
                <li><a href="./shop-grid">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details">Shop Details</a></li>
                        <li><a href="./shoping-cart">Shoping Cart</a></li>
                        <li><a href="./checkout">Check Out</a></li>
                        <li><a href="./blog-details">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog">Blog</a></li>
                <li><a href="./contact">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> <?php echo $contact['email']?></li>
                <!-- <li>Free Shipping for all Order of $99</li> -->
            </ul>
        </div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> <?php echo $contact['email']?></li>
                                <!-- <li>Free Shipping for all Order of $99</li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
<?php
    if (isset($_SESSION['userid'])) {
        echo '<a href="">'.$user_a['name'].'</a>&#x00A0;&#x00A0;&#x00A0;';
    }
?>
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <div class="header__top__right__auth">
<?php
    if (isset($_SESSION['userid'])) {
        echo '<a href="database/logout"><i class="fa fa-user"></i> Logout</a>';
    }
    else{
        echo '<a href="login"><i class="fa fa-user"></i> Login</a>';
    }
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="./index"><img src="img/logo1.png" alt=""></a><br/>
                        <span style="font-size: 18px;">Get whatever you want</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="index">Home</a></li>
                            <li><a href="about">About Us</a></li>
                            <!-- <li><a href="product">Products</a></li> -->
                            <!-- <li><a href="#">Products</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details">Shop Details</a></li>
                                    <li><a href="./shoping-cart">Shoping Cart</a></li>
                                    <li><a href="./checkout">Check Out</a></li>
                                    <li><a href="./blog-details">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <li><a href="contact">Contact Us</a></li>
                            <?php
                                if (isset($_SESSION['userid'])) {
                                    echo '<li><a href="shoping-cart">Your Order</a></li>
                                    <li><a href="order-history">Order History</a></li>';
                                }
                            ?>

                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                        <?php
                            if (isset($_SESSION['userid'])) {
                        ?>
                            <ul>
                                <li><a href="shoping-cart"><i class="fa fa-shopping-bag"></i>
<?php
$count=0;
$shop = mysqli_query($conn, "SELECT select_product.id,select_product.userid,select_product.pdct_id,select_product.quantity,select_product.sub_total,select_product.status,single_product.id as spid,single_product.img,single_product.s_prdct_name,single_product.price FROM select_product INNER JOIN single_product ON select_product.pdct_id=single_product.id WHERE select_product.userid='$user_id' && select_product.status=0");
while ($shop_a = mysqli_fetch_array($shop)) {
    $count++;
?>
                                    <span><?php echo $count;?></span>
<?php
    }
?>
                                </a></li>
                            </ul>
<?php
$counts=0;
$shop_count = mysqli_query($conn, "SELECT * FROM select_product WHERE userid='$user_id' && status='0'");
while ($shop_count_a = mysqli_fetch_array($shop_count)) {
    $counts = $shop_count_a['sub_total']+$counts;
}
?>
                            <div class="header__cart__price">Price : <span><?php echo $counts;?></span></div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
<div class="stellarnav">
    <ul style="z-index: 9999;">
        <li><a href="#"><i class="fa fa-bars"></i> &#x00A0; All Products</a>
            <ul>
<?php
$n=0;
$select_ctg_a = mysqli_query($conn,"SELECT * FROM product");
while ($select_ctg = mysqli_fetch_array($select_ctg_a)) {
    $n++;
?>
                <li class="menu_a"><a href="#"><?php echo $select_ctg['name'];?></a>
                    <ul>
<?php
$select_s_ctg_a = mysqli_query($conn,"SELECT * FROM sub_product WHERE pdct_id='".$select_ctg['id']."'");
while ($select_s_ctg = mysqli_fetch_array($select_s_ctg_a)) {
?>
                        <li class="menu_b"><a href="product?p_id=<?php echo $select_s_ctg['id'];?>"><?php echo $select_s_ctg['name'];?></a></li>
<?php
    }
?>
                    </ul>
                </li>
<?php
    }
?>
            </ul>
        </li>
    </ul>
</div>                    
                    
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <a href="tel:<?php echo $contact['mobile']?>"><h5>+91 <?php echo $contact['mobile']?></h5></a>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>