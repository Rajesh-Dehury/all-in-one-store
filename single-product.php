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
</head>

<body>

    <?php include "include/header.php"?>
<?php
    $s_p_id = $_GET['s_p_id'];
?>

<?php
$select_s_ctg_a = mysqli_query($conn,"SELECT single_product.id,single_product.prdct_id,single_product.sprdct_id,single_product.img,single_product.s_prdct_name,single_product.price,single_product.ratting,single_product.description,single_product.availability,single_product.shipping,single_product.entry_time,sub_product.id as subpdct_id,sub_product.pdct_id,sub_product.name,sub_product.entry_time as s_p_time,product.id as pdct_id,product.name as pdct_name FROM single_product INNER JOIN sub_product ON single_product.sprdct_id=sub_product.id INNER JOIN product ON single_product.prdct_id=product.id WHERE single_product.id='$s_p_id'");
$select_s_ctg = mysqli_fetch_array($select_s_ctg_a);
?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <?php
                            if (isset($select_s_ctg['name'])) {
                                echo '<h2>'.$select_s_ctg['name'].'</h2>';
                            }
                            else{
                                echo '<h2>Single Package</h2>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<!-- <input type="" name="" value="<?php echo $s_p_id;?>"> -->
    <!-- Product Details Section Begin -->



    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="img/product/<?php echo $select_s_ctg['img']?>" alt="" style="height: 350px;">
                        </div>
                        <!-- <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/products/2.jpg"
                                src="img/products/2.jpg" alt="" style="height: 100px;">
                            <img data-imgbigurl="img/products/3.jpg"
                                src="img/products/3.jpg" alt="" style="height: 100px;">
                            <img data-imgbigurl="img/products/4.jpg"
                                src="img/products/4.jpg" alt="" style="height: 100px;">
                            <img data-imgbigurl="img/products/5.jfif"
                                src="img/products/5.jfif" alt="" style="height: 100px;">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <form class="" method="post" enctype="multipart/form-data">
                        <input type="text" name="s_p_id" style="display: none;" value="<?php echo $s_p_id;?>">
                        <input type="text" name="pdct_price" style="display: none;" value="<?php echo $select_s_ctg['price']?>">
                    <div class="product__details__text">
                        <h3><?php echo $select_s_ctg['s_prdct_name']?></h3>
                        <div class="product__details__rating">
                        <?php
                            $rating=$select_s_ctg['ratting'];
                            for ($i=0; $i < $rating; $i++) { 
                                echo '<i class="fa fa-star" style="font-size:12px; color:#f17307;"></i> ';
                            }
                        ?>
                            <!-- <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i> -->
                            <!-- <span>(18 reviews)</span> -->
                        </div>
                        <div class="product__details__price"><span style="color: #000; font-size: 18px;">Rs.</span> <?php echo $select_s_ctg['price']?></div>
                        <p><?php echo $select_s_ctg['description']?></p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" name="quantity_count">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="quantity_submit" class="primary-btn" style="border:0px;">ADD TO CARD</button>
                        <!-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                        <ul>
                            <li><b>Availability</b> <span><?php echo $select_s_ctg['availability']?></span></li>
                            <li><b>Shipping</b> <span><?php echo $select_s_ctg['shipping']?> <!-- <samp>Free pickup today</samp> --></span></li>
                            <!-- <li><b>Weight</b> <span>0.5 kg</span></li> -->
                            <!-- <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <?php include "include/footer.php"?>